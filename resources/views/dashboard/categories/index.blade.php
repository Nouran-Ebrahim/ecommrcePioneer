@extends('layouts.dashboard.app')
@section('title')
    @lang('dashboard.brands')
@endsection
@push('style')
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/3.2.0/css/buttons.dataTables.min.css">
@endpush
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">{{ __('dashboard.categories') }}</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a
                                        href="{{ route('dashboard.home') }}">{{ __('dashboard.dashboard') }}</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.categories.index') }}">
                                        {{ __('dashboard.categories') }}</a>
                                </li>


                            </ol>
                        </div>
                    </div>
                </div>
                {{-- @include('dashboard.includes.button-header') --}}
            </div>
            <div class="content-body">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="basic-layout-colored-form-control">{{ __('dashboard.categories') }}
                        </h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                            <ul class="list-inline mb-0">
                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                <li><a data-action="close"><i class="ft-x"></i></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="card-content">
                        <div class="card-body">
                            {{-- alert --}}
                            @include('dashboard.includes.tostar-success')
                            @include('dashboard.includes.tostar-error')
                            <p class="card-text">As well as being able to pass language information to DataTables
                                through the language initialization option, you can also store
                                the language information in a file, which DataTables can load
                                by Ajax using the language.url option.</p>
                            <table id="yajraTable" class="table table-striped table-bordered language-file">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>@lang('dashboard.name')</th>
                                        <th>@lang('dashboard.status')</th>
                                        <th>@lang('dashboard.created_at')</th>
                                        <th>@lang('dashboard.actions')</th>
                                    </tr>
                                </thead>

                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>@lang('dashboard.name')</th>
                                        <th>@lang('dashboard.status')</th>
                                        <th>@lang('dashboard.created_at')</th>
                                        <th>@lang('dashboard.actions')</th>

                                    </tr>
                                </tfoot>
                            </table>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="//cdn.datatables.net/2.1.8/js/dataTables.min.js" type="text/javascript"></script>

    <script src="https://cdn.datatables.net/buttons/3.2.0/js/dataTables.buttons.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.colVis.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.html5.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.0/js/buttons.print.min.js" type="text/javascript"></script>
    <script src="{{asset('vendor/dataTables/excel/jszip.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('vendor/dataTables/pdf/pdfmake.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('vendor/dataTables/pdf/vfs_fonts.js')}}" type="text/javascript"></script>

    <script>
        var lang = "{{ app()->getLocale() }}"
        $('#yajraTable').DataTable({
            processing: true,
            serverSide: true,
            language: lang == 'ar' ? {
                url: '//cdn.datatables.net/plug-ins/2.1.8/i18n/ar.json',
            } : {},
            layout: {
                topStart: {
                    buttons: ['colvis','copy','print','excel','pdf']
                }
            },
            ajax: "{{ route('dashboard.categories.all') }}",
            columns: [{
                    data: 'DT_RowIndex', // as we add addIndexColumn for ordering
                    name: 'DT_RowIndex',
                    orderable: false, // make this row non-orderable
                    searchable: false // make this row non-searchable
                },
                {
                    data: 'name', //data is column name form database
                    name: 'name'
                },

                {
                    data: 'status_name',
                    name: 'status_name'
                },
                {
                    data: 'created_at',
                    name: 'created_at' // same name in database also used for relation search
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false, // make this row non-orderable
                    searchable: false // make this row non-searchable
                }

            ],


        });
    </script>
@endpush
