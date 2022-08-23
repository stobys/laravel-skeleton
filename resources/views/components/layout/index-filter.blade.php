@props([
    'advanced'  => false,
    'query'     => '',
    'sortOptions'    => ['puste'],
])

<x-form id="filterForm" method="POST">
    <div class="row">
        <div class="col-9">
            <div class="card filter-form">
                <div class="card-header p-0">
                    <div class="input-group">
                        <div class="input-group-prepend {{ $advanced ? 'clickable' : '' }}"
                            @if( $advanced )
                                @click="toggleFilterContent"
                            @endif
                            data-filter-show-icon="fa-chevron-down"
                            data-filter-hide-icon="fa-chevron-up"
                        >
                            <span class="input-group-text">
                                @if( $advanced )
                                    @if( session()->get('filters.'. controllerName() .'.isFiltered', false) )
                                        <i class="mx-2 fas fa-fw fa-chevron-up toggle-icon"></i>
                                    @else
                                        <i class="mx-2 fas fa-fw fa-chevron-down toggle-icon"></i>
                                    @endif
                                @else
                                    <i class="mx-2 fas fa-fw fa-chevron-right toggle-icon"></i>
                                @endif
                            </span>
                        </div>
        
                        <input type="text" name="default_query_string" class="form-control form-control-lg"
                            value="{{ $query }}">
        
                        <span class="input-group-append">
                            <button type="button" class="btn btn-default btn-lg" @click="clearFilterForm">
                                <i class="fas fa-fw fa-broom"></i>
                            </button>
                        </span>
        
                        <span class="input-group-append">
                            <button type="submit" class="btn btn-default btn-lg" @click="submitFilterForm">
                                <i class="fas fa-fw fa-search"></i>
                            </button>
                        </span>
                    </div>
                </div><!-- /.card-header -->

                @if( $advanced )
                <div class="card-body"
                    style="@unless( session()->get('filters.'. controllerName() .'.isFiltered', false) ) display:none @endunless">
                    {{ $slot }}
                </div><!-- /.card-body -->
        
                <div class="card-footer text-right"
                    style="@unless( session()->get('filters.'. controllerName() .'.isFiltered', false) ) display:none @endunless"
                >
                    <button type="button" class="btn btn-secondary" @click="clearFilterForm">
                        <i class="fas fa-eraser"></i> &nbsp; Wyczyść
                    </button>
                    <button type="submit" class="btn btn-primary" @click="submitFilterForm">
                        <i class="fas fa-search"></i> &nbsp; Filtruj
                    </button>
                </div><!-- /.card-body -->
                @endif
            </div>
        </div>

        <div class="col-3">
            @includeIf(controllerName() .'.index-sort')
        </div>
    </div>
</x-form>
