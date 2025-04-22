@extends('layouts.website.app')
@section('title', __('dashboard.brands'))
@section('content')
    <section class="blog about-blog">
        <div class="container">
            <div class="blog-bradcrum">
                <span><a href="{{route('website.home')}}">Home</a></span>
                <span class="devider">/</span>
                <span><a href="javascript:;">@lang('dashboard.brands')</a></span>
            </div>
            <div class="blog-heading about-heading">
                <h1 class="heading">@lang('dashboard.brands')</h1>
            </div>
        </div>
    </section>
    <section class="product brand" data-aos="fade-up">
        <div class="container">

            <div style="margin-bottom: 90px" class="brand-section">
                @forelse ($brands as $brand)
                    <div style="margin: 6px" class="product-wrapper">
                        <div class="wrapper-img">
                            <a href="product-sidebar.html">
                                <img src="{{ $brand->logo }}" alt="{{ $brand->name }}">
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="alert-info">No brands</div>
                @endforelse

            </div>
        </div>
    </section>


@endsection
