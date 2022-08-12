<div class="card filter-form">
    <div class="card-header p-0">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    @switch( request()->get('sort', null) )
                        @case('ip,asc')
                            <x-icon fw icon="sort-numeric-down" />
                        @break

                        @case('ip,desc')
                            <x-icon fw icon="sort-numeric-down-alt" />
                        @break

                        @case('user,asc')
                            <x-icon fw icon="sort-alpha-down" />
                        @break

                        @case('user,desc')
                            <x-icon fw icon="sort-alpha-down-alt" />
                        @break

                        @default
                            <x-icon fw icon="sort-numeric-down" />
                    @endswitch
                </span>
            </div>
            {{
                html() -> select('sort-by', $sortOptions ?? [], request()->get('sort', null))
                    -> attribute('form', 'filterForm')
                    -> attribute('@change', 'setSortOrder')
                    -> class('form-control form-control-lg')
            }}
        </div>
    </div><!-- /.card-header -->
</div>