@extends('layouts.dashboard.app')
@section('title')
    @lang('dashboard.edit_roles')
@endsection
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    {{-- <h3 class="content-header-title mb-0 d-inline-block">Basic Forms</h3> --}}
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a
                                        href="{{ route('dashboard.home') }}">{{ __('dashboard.dashboard') }}</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('dashboard.roles.index') }}">@lang('dashboard.roles')</a>
                                </li>
                                <li class="breadcrumb-item active">@lang('dashboard.edit_roles')
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" id="basic-layout-colored-form-control">{{$role->role}}</h4>
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
                    <div class="card-content collapse show">
                        <div class="card-body">
                            @include('dashboard.includes.validations-errors')
                            <form class="form" action="{{ route('dashboard.roles.update' , $role->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-body">

                                    <input  name="id"  hidden value="{{$role->id}}">
                                    <h4 class="form-section"><i class="la la-new"></i>@lang('dashboard.edit_roles')</h4>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="userinput1">@lang('dashboard.name_en')</label>
                                                <input type="text" id="userinput1" class="form-control border-primary"
                                                value="{{$role->getTranslation('role' , 'en')}}"    placeholder="@lang('dashboard.name_en')" name="role[en]">
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="userinput1"> @lang('dashboard.name_ar')</label>
                                                <input type="text" id="userinput1" class="form-control border-primary"
                                                   value="{{$role->getTranslation('role' , 'ar')}}"  placeholder="@lang('dashboard.name_ar')" name="role[ar]">
                                            </div>

                                        </div>

                                    </div>
                                    <div class="row">
                                        @if (Config::get('app.locale') == 'ar')
                                            @foreach (config('permessions_ar') as $key => $value)
                                                <div class="col-md-2">
                                                    <input value="{{ $key }}" type="checkbox" name="permessions[]"
                                                        class="checkbox"  @checked(in_array($key, $role->permessions))>
                                                    <lable>{{ $value }}</lable>
                                                </div>
                                            @endforeach
                                        @else
                                            @foreach (config('permessions_en') as $key => $value)
                                                <div class="col-md-2">
                                                    <input value="{{ $key }}" type="checkbox" name="permessions[]"
                                                        class="checkbox"  @checked(in_array($key, $role->permessions))>
                                                    <lable>{{ $value }}</lable>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                                <div class="form-actions right">
                                    <button type="button" class="btn btn-warning mr-1">
                                        <i class="ft-x"></i> @lang('dashboard.cancel')
                                    </button>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="la la-check-square-o"></i> @lang('dashboard.save')
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
