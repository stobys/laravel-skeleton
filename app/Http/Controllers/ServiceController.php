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
			'name'			=> 'do-something-that-cannot-be-done-via-gui',
			'description'	=> 'Opis Funkcji Serwisowej',
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
            case 'do-something-that-cannot-be-done-via-gui':
                $results = $this -> doSomethingThatCannotBeDoneViaGUI();
            break;
        }

    	return view('service.summary', [
            'function'  => $function,
            'results'   => $results ?? []
        ]);
    }

    public function doSomethingThatCannotBeDoneViaGUI()
    {
        $results = [
            'some'  => 'results'
        ];

        return $results;
    }
}
