@extends('layouts.dashboard.app')
@section('title')
    @lang('dashboard.brands')
@endsection
@push('style')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/dashboard') }}/vendors/css/tables/datatable/datatables.min.css">
@endpush
@section('content')
@endsection
@push('script')
    <script src="{{ asset('assets/dashboard') }}/vendors/js/tables/datatable/datatables.min.js"
        type="text/javascript"></script>
    <script src="{{ asset('assets/dashboard') }}/vendors/js/tables/datatable/dataTables.buttons.min.js"
        type="text/javascript"></script>
@endpush
