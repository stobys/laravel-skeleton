<?php

namespace App\Http\Controllers;

use App\Models\Quiz;

use App\Models\Answer;
use App\Models\BookQS;
use App\Models\Result;
use App\Models\Question;
use App\Models\Inventory;
use App\Models\NullModel;
use Illuminate\Support\Str;
use App\Enums\ContainerType;
use App\Models\QuestionPool;
use App\Models\InventoryDictLid;
use App\Models\InventoryVoucher;
use App\Models\InventoryDocument;
use App\Models\InventoryContainer;
use App\Models\InventoryDictPallet;
use App\Models\InventoryDocumentItem;
use App\Models\InventoryContainerItem;
use App\Models\InventoryDictContainer;
use App\Http\Requests\ServiceControllerRequest;

class ServiceController extends Controller
{
    protected $results = [];

	protected $functions = [
		[
			'name'			=> 'set-date-time-indexes-in-bookings-table',
			'description'	=> 'Ustawia pola year, week_of_year, day_of_year itp w tabeli księgowań',
		],
		[
			'name'			=> 'link-production-vouchers-with-new-documents',
			'description'	=> 'Powiąż błędnie przypisane vouchery produkcyjne, z nowo dodanymi paczkami',
		],
        [
            'name'            => 'copy-erp-booking-number-from-documents-to-related-vouchers',
            'description'    => 'Skopiuj numery księgowania z Paczki do powiązanych voucherów bez numeru księgowania',
        ],
        [
            'name'            => 'programmatically-scan-vouchers',
            'description'    => 'Programowe skanowanie voucherów',
        ],
        [
            'name'            => 'set-missing-part-types-containers-items',
            'description'    => 'Uzupełnij brakujące typy w poskanowanych pojemnikach',
        ],
        [
            'name'            => 'add-missing-containers-items-based-on-vouchers',
            'description'    => 'Uzupełnij brakujące itemy pojemników na podstawie voucherów',
        ],
	];

    public function index(ServiceControllerRequest $request)
    {
    	$functions = $this -> functions;

		return view('service.index', compact('functions'));
    }

    public function launch(ServiceControllerRequest $request, $function)
    {
    	return view('service.launch', compact('function'));
    }

    public function execute(ServiceControllerRequest $request, $function)
    {
        switch($function)
        {
            case 'set-date-time-indexes-in-bookings-table':
                $results = $this -> setDateTimeIndexesInBookingsTable();
            break;
            case 'link-production-vouchers-with-new-documents':
                $results = $this -> linkProductionVouchesWithNewDocuments();
            break;
            case 'copy-erp-booking-number-from-documents-to-related-vouchers':
                $results = $this -> copyErpBookingNumberFromDocumentsToRelatedVouchers();
            break;
            case 'programmatically-scan-vouchers':
                $results = $this -> programmaticallyScanVouchers();
            break;
            case 'set-missing-part-types-containers-items':
                $results = $this -> setMissingPartTypesContainersItems();
            break;
            case 'add-missing-containers-items-based-on-vouchers':
                $results = $this -> addMissingContainersItemsBasedOnVouchers();
            break;

                
        }

    	return view('service.summary', [
            'function'  => $function,
            'results'   => $results ?? []
        ]);
    }

    public function setDateTimeIndexesInBookingsTable()
    {
        $results = BookQS::all()->map(function( $qs ){
            $yearWeek           = $qs->booked_at->year . $qs->booked_at->weekOfYearLeadingZeros;
            $yearWeekDay        = $yearWeek . $qs->booked_at->dayOfWeekIso;
            $yearWeekDayShift   = $yearWeekDay . $qs->booked_at->shiftNumber;

            $qs->booking_year            = $qs->booked_at->year;
            $qs->booking_week_of_year    = $qs->booked_at->weekOfYear;
            $qs->booking_day_of_year     = $qs->booked_at->dayOfYear;
            $qs->booking_shift_of_day    = $qs->booked_at->shiftNumber;

            $qs->booking_year_week           = $yearWeek;
            $qs->booking_year_week_day       = $yearWeekDay;
            $qs->booking_year_week_day_shift = $yearWeekDayShift;

            $qs->save();

            return $qs->id;
        });

        return $results->count();
    }

    public function linkProductionVouchesWithNewDocuments()
    {
        $vouchers = InventoryVoucher::whereNull('document_item_id')->get()->mapWithKeys(function($voucher){
            $document_item = InventoryDocumentItem::whereStorageBin($voucher->storage_bin)->first();

            if($document_item)
            {
                if( ! request()->has('pretend') )
                {
                    $voucher->document_item_id = $document_item->id;
                    $voucher->save();
                }

                return [$voucher->vidFormated() => $document_item->document->number . '/' . $document_item->number];
            }

            return [];
        }) -> toArray();

        return $vouchers;
    }

    public function copyErpBookingNumberFromDocumentsToRelatedVouchers()
    {
        $vouchers = InventoryVoucher::whereNotNull('document_item_id')->whereNull('erp_booking_number')->get()->mapWithKeys(function ($voucher) {
            $document_item = InventoryDocumentItem::whereStorageBin($voucher->storage_bin)->first();
            
            if ($document_item && !is_null($document_item->document->erp_booking_number)) {
                if (!request()->has('pretend')) {
                    $voucher->erp_booking_number = $document_item->document->erp_booking_number .'-'. $voucher->consecutive_number;
                    $voucher->erp_booked_at = $document_item->document->erp_booked_at;

                    $voucher->booked_by = $document_item->document->booked_by;
                    $voucher->booked_at = $document_item->document->booked_at;

                    $voucher->save();
                }

                return [$voucher->vidFormated() => $document_item->document->number . '/' . $document_item->number];
            }

            return [];
        })->toArray();

        return $vouchers;
    }

    public function programmaticallyScanVouchers()
    {
        $sub_min = request()->get('sub-minutes-min', 60);
        $sub_max = request()->get('sub-minutes-max', 180);
        $data = request()->get('data', '');

        return Str::of($data)->trim()->explode("\r\n")->map(function($line){
            return Str::of($line)->trim()->explode(';')->mapWithKeys(function($item, $index){
                switch( $index )
                {
                    case 0:
                        return ['consecutive_number' => Str::of($item)->trim()->__toString()];
                    break;

                    case 1:
                        return ['storage_bin' => Str::of($item)->trim()->__toString()];
                    break;

                    case 2:
                        return ['part_number' => Str::of($item)->trim()->__toString()];
                    break;

                    case 3:
                        return ['part_quantity' => (int)Str::of($item)->trim()->__toString()];
                    break;

                }
            })->toArray();
        })->map(function( $model ) use($sub_min, $sub_max) {
            
            $voucher = InventoryVoucher::firstOrCreate([
                'inventory_id'       => Inventory::current('id'),
                'consecutive_number' => $model['consecutive_number']
            ]);

            if ( $voucher -> wasRecentlyCreated )
            {
                $voucher -> update([
                    'storage_bin'       => $model['storage_bin'],
                    'part_number'       => $model['part_number'],
                    'part_quantity'     => $model['part_quantity'],
                    'container_number'  => 'NIEMA',
                    'pallet_number'     => 'NIEMA',
                    'lid_number'        => 'NIEMA',
                    'scanned_by'        => auth()->id(),
                    'scanned_at'        => now()->subMinutes(rand($sub_min, $sub_max))->subSeconds(rand(0, 60)),
                    'saved_by_scan'     => 1,

                ]);

                return $voucher -> vidFormated();
            }
        }) -> toArray();



        // $data = collect($request->all())
        //     ->filter()
        //     ->except('_token')
        //     ->toArray();

        // if (!InventoryDictMaterial::whereNumber($data['part_number'])->exists()) {
        //     $data['part_number'] = InventoryDictAlias::whereAlias($data['part_number'])
        //     ->firstOrFail()
        //         ->value;
        // }

        // if (strtoupper($data['part_number']) == 'NIEMA') {
        //     $data['part_quantity'] = null;
        // }

        // if (strtoupper($data['container_number']) == 'NIEMA') {
        //     $data['container_quantity'] = null;
        // }

        // if (strtoupper($data['lid_number']) == 'NIEMA') {
        //     $data['lid_quantity'] = null;
        // }
        // if (strtoupper($data['pallet_number']) == 'NIEMA') {
        //     $data['pallet_quantity'] = null;
        // }

        // $data += [
        //     'scanned_by'    => auth()->id(),
        //     'scanned_at'    => now(),
        //     'saved_by_scan' => 1,
        // ];

        // dd( request()->all() );
    }

    public function setMissingPartTypesContainersItems()
    {
        InventoryContainerItem::whereNull('part_type')->get()->map(function($item){
            // -- check if it's a lid
            if ( InventoryDictLid::whereNumber($item->part_number)->exists() )
            {
                $item->update(['part_type' => ContainerType::LID]);
            }

            // -- check if it's a pallet
            if ( InventoryDictPallet::whereNumber($item->part_number)->exists() )
            {
                $item->update(['part_type' => ContainerType::PALLET]);
            }

            // -- check if it's a container
            if( InventoryDictContainer::whereNumber($item->part_number)->exists() )
            {
                $item->update(['part_type' => ContainerType::CONTAINER]);
            }
        });
    }

    public function addMissingContainersItemsBasedOnVouchers()
    {
        $vCollection = InventoryVoucher::where(function($query){
            $query
                -> whereNotNull('container_number')
                -> orWhereNotNull('pallet_number')
                -> orWhereNotNull('lid_number');
        }) -> get();

        $vouchers = $vCollection -> mapWithKeys(function($voucher){
            return [$voucher->id => $voucher];
        });

        $result = $vCollection -> mapWithKeys(function($voucher){
            $inVoucherCount = collect(array_filter([$voucher->container_number, $voucher->pallet_number, $voucher->lid_number]))->filter(function($value){
                return ! in_array(strtoupper($value), ['NIEMA', null]);
            }) -> count();

            $inContainersCount = $voucher->containersItemsCount();

            if ($inVoucherCount != $inContainersCount)
            {
                return [$voucher -> vidFormated() 
                    => 'IN_V='. $inVoucherCount .' / IN_C='. $inContainersCount
                    .' || '. $voucher->container_number .'|'. $voucher->pallet_number .'|'. $voucher->lid_number
                ];
            }

            return [];
        });

        dd($result);
    }
}
