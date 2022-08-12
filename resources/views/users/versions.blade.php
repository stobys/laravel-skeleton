<x-layout.app :title="config('app.name') .' :: '. __('users.controller')">
    @section('content-header')
    <x-layout.content-header :heading="__('users.controller')" module_name="nazwa modulu" moduleName="nazwa modulu">
    </x-layout.content-header>
    @endsection

    Lista Wersji

    <div class="card card-adient-teal card-outline">
        <div class="card-body">
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="bg-light uppercase">
                                <tr>
                                    <th>Changes Made</th>
                                    <th>Changes By</th>
                                    <th>Changes At</th>
                                </tr>
                            </thead>
                    
                            <tbody>
                                @foreach($model->versions as $version)
                                <tr>
                                    <td>
                                        @foreach($version -> contents as $key => $value)
                                            {{ __('users.fields.'. $key) }} => {{ $value }}
                                            @unless($loop->last) <br /> @endunless
                                        @endforeach
                                    </td>
                                    <td>{{ $version -> user -> username }}</td>
                                    <td>{{ $version -> created_at }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div><!-- /.card-body -->
            </div><!-- /.card -->
        </div>
    </div>

</x-layout.app>