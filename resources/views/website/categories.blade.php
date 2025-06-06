@extends('layouts.website.app')
@section('title', __('dashboard.categories'))
@section('content')
    <section class="blog about-blog">
        <div class="container">
            <div class="blog-bradcrum">
                <span><a href="{{route('website.home')}}">Home</a></span>
                <span class="devider">/</span>
                <span><a href="javascript:;">@lang('dashboard.categories')</a></span>
            </div>
            <div class="blog-heading about-heading">
                <h1 class="heading">@lang('dashboard.categories')</h1>
            </div>
        </div>
    </section>
    <section class="product-category" >
        <div class="container">

            <div style="margin-bottom: 90px" class="category-section">
                @foreach ($categories as $category)
                    <div class="product-wrapper" data-aos="fade-right" data-aos-duration="100">
                        <div class="wrapper-img">
                            <img src="{{ asset($category->icon) }}" alt="dress">
                        </div>
                        <div class="wrapper-info">
                            <a href="{{ route('website.categories.products',$category->slug) }}" class="wrapper-details">{{ $category->name }}</a>
                        </div>
                    </div>
                @endforeach



            </div>
        </div>
    </section>


@endsection
