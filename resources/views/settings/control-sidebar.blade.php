{{ html() -> form() -> open() }}

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">
                {{ trans('cruds.permission.title') }} Filter
            </h3>

            <div class="card-tools">
                {{-- <ul class="pagination pagination-sm float-right"> --}}
            </div>
        </div><!-- /.card-header -->

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <x-index-row th>
                            <th>ID</th>
                            <th>Title</th>
                        </x-index-row>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div><!-- /.card-body -->
    </div>


{{ html() -> form() -> close() }}
