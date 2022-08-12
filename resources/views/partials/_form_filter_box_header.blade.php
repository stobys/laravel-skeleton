<div class="box-header with-border">
    <h3 class="box-title">
        <i class="fa fa-fw fa-filter @if( session( $module .'Filtered' ) ) text-yellow @endif"></i>
        {{ trans('app.form.filter') }}
    </h3>
    <div class="box-tools pull-right">
        <button type="submit" class="btn btn-sm btn-labeled btn-adient">
            <span class="btn-label">
                <i class="fa fa-lg fa-filter"></i>
            </span>
            {{ trans('app.form.run-filter') }}
        </button>

        <button type="button" class="btn btn-sm btn-labeled btn-adient" data-js-action="clearFilterForm">
            <span class="btn-label">
                <i class="fa fa-lg fa-times"></i>
            </span>
            {{ trans('app.form.clear') }}
        </button>

        <button class="btn btn-primary btn-sm" type="button" data-widget="collapse">
            @if( session( $module .'Filtered' ) )
                <i class="fa fa-minus"></i>
            @else
                <i class="fa fa-plus"></i>
            @endif
        </button>
    </div>
</div>
