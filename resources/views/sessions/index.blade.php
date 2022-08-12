<x-layout.app heading="Sessions" x-data="alpineSessions">
    @section('content-header')
        <x-layout.content-header 
            heading="{{ __('Sesje Użytkowników') }}!"
            module_text="module"

            action_text="index"
            action_link="indexLink"
        ></x-layout.content-header>
    @endsection

    @section('index-filter')
        <x-layout.index-filter advanced query="{{ session('filters.'. controllerName() .'.default_query_string') }}"
            :sortOptions="$sortOptions"
        >
            @includeIf('sessions._advanced-filter')
        </x-layout.index-filter>
    @endsection
    
    <x-layout.index-content :models="$sessions">
        <div class="row">
            <div class="col-12 col-sm-12">
                <x-form id="destroyForm" onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                    action="{{ route('sessions.bulkDestroy') }}" method="DELETE">
                    <div class="card">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    @if( $sessions->count() )
                                    <thead class="bg-light uppercase">
                                        @includeIf('sessions._index-row-th')
                                    </thead>
                                    @endif

                                    <tbody>
                                        @forelse($sessions as $session)
                                            @includeIf('sessions._index-row', ['model' => $session])
                                        @empty
                                            @includeFirst([
                                                'sessions._index-no-rows',
                                                'layouts._module-no-rows',
                                            ])
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div><!-- /.card-body -->

                        @if( $sessions->count() )
                        <div class="card-footer">
                            <div class="m-2 text-center">
                                {{-- {!! $sessions->links('partials._paginator') !!} --}}
                            </div>
                        </div>
                        @endif
                    </div><!-- /.card -->
                </x-form>
            </div>
        </div>
    </x-layout.index-content>
</x-layout.app>