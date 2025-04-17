@extends('layouts.dashboard.app')
@section('title', __('dashboard.create'))

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-9 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">{{ __('dashboard.create') }}</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a
                                        href="{{ route('dashboard.home') }}">{{ __('dashboard.dashboard') }}</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.pages.index') }}">
                                        {{ __('dashboard.pages') }}</a>
                                </li>
                                <li class="breadcrumb-item active"><a href="">
                                        {{ __('dashboard.create') }}</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                {{-- @include('dashboard.includes.button-header') --}}
            </div>
            <div class="row" style="display: flex; justify-content: center;">
                <div class="col-md-11">
                    <div class="content-body">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title" id="basic-layout-colored-form-control">
                                    {{ __('dashboard.pages') }}
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
                                    @include('dashboard.includes.validations-errors')

                                    {{-- <a href="{{ route('dashboard.pages.index') }}" class="btn btn-sm btn-primary mb-2">
                                        <i class="la la-arrow-left"></i> {{ __('dashboard.back') }}
                                    </a> --}}

                                    <form class="form" action="{{ route('dashboard.pages.store') }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('POST')


                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="eventRegInput1">{{ __('dashboard.title_en') }}</label>
                                                        <input value="{{ old('title.en') }}" type="text"
                                                            class="form-control"
                                                            placeholder="{{ __('dashboard.title_en') }}" name="title[en]">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="eventRegInput1">{{ __('dashboard.title_ar') }}</label>
                                                        <input value="{{ old('title.ar') }}" id="eventRegInput1"
                                                            type="text" class="form-control"
                                                            placeholder="{{ __('dashboard.title_ar') }}" name="title[ar]">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="content_ar">{{ __('dashboard.content_ar') }}</label>
                                                        <textarea id="content_ar" class="form-control" placeholder="{{ __('dashboard.content_ar') }}" name="content[ar]"></textarea>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="content_en">{{ __('dashboard.content_en') }}</label>
                                                        <textarea id="content_en" class="form-control" placeholder="{{ __('dashboard.content_en') }}" name="content[en]"></textarea>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="form-group">
                                                <label for="image">{{ __('dashboard.img') }}</label>
                                                <input type="file" name="image" class="form-control" id="single-image"
                                                    placeholder="{{ __('dashboard.image') }}">
                                            </div>



                                        </div>
                                        <div class="form-actions left">
                                            <a href="{{ url()->previous() }}" type="button" class="btn btn-warning mr-1">
                                                <i class="ft-x"></i> {{ __('dashboard.cancel') }}
                                            </a>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="la la-check-square-o"></i> {{ __('dashboard.save') }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('script')
    <script>
        $('#content_ar').summernote({
            placeholder: 'اكتب هنا....',
            tabsize: 2,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ],
            height: 300, // set minimum height of editor
        });
        $('#content_en').summernote({
            placeholder: 'write here ...',
            tabsize: 2,
            lang: 'ar-AR',
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['fontname', ['fontname']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ],
            height: 300, // set minimum height of editor
        });
    </script>
@endpush
