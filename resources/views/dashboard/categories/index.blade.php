@extends('layouts.dashboard.app')
@section('title')
    @lang('dashboard.brands')
@endsection
@push('style')
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
                            <a href="{{ route('dashboard.categories.create') }}" class="btn btn-danger">{{ __('dashboard.create') }}</a><br><br>

                            <table id="yajraTable" class="table table-striped table-bordered language-file">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>@lang('dashboard.name')</th>
                                        <th>@lang('dashboard.status')</th>
                                        <th>{{ __('dashboard.products_count') }}</th>

                                        <th>@lang('dashboard.created_at')</th>
                                        <th>@lang('dashboard.actions')</th>
                                    </tr>
                                </thead>

                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>@lang('dashboard.name')</th>
                                        <th>@lang('dashboard.status')</th>
                                        <th>{{ __('dashboard.products_count') }}</th>

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
    <script>
        var lang = "{{ app()->getLocale() }}"
        let yajraTable = $('#yajraTable').DataTable({
            processing: true,
            serverSide: true,
            language: lang == 'ar' ? {
                url: "{{ asset('vendor/dataTables/languages/ar.json') }}",
            } : {},
            layout: {
                topStart: {
                    buttons: ['colvis', 'copy', 'print', 'excel', 'pdf']
                }
            },
            responsive: {
                details: {
                    display: DataTable.Responsive.display.modal({
                        header: function(row) {
                            var data = row.data();
                            return '@lang('dashboard.Details for') ' + data['name'];
                        }
                    }),
                    renderer: DataTable.Responsive.renderer.tableAll({
                        tableClass: 'table'
                    })
                }
            },
            colReorder: true,
            rowReorder: true,
            select: true,
            fixedHeader: true,
            // scrollCollapse: true,
            // scroller: true,
            // scrollX: 900,
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
                    name: 'status_name',
                    orderable: false, // make this row non-orderable
                    searchable: false // make this row non-searchable
                },
                {
                    data: 'products_count',
                    name: 'products_count',
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
    {{-- change status --}}
    <script>
        $(document).on('change', '.change_status', function() {

            var id = $(this).attr('category-id');
            var url = "{{ route('dashboard.categories.status', ':id') }}";
            url = url.replace(':id', id);
            $.ajax({
                url: url,
                type: 'GET',

                success: function(response) {
                    if (response.status == 'success') {

                        $('.tostar_success').text(response.message).show();

                        // change status
                        yajraTable.ajax.reload();

                    } else {
                        $('.tostar_error').show();
                        $('.tostar_error').text(response.message);
                    }
                    setTimeout(function() {
                        $('.tostar_success').hide();
                    }, 5000);

                }

            });
        });
    </script>
@endpush
