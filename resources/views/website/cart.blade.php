@extends('layouts.website.app')
@section('title', __('dashboard.show'))
@section('content')

    <section class="blog about-blog">
        <div class="container">
            <div class="blog-bradcrum">
                <span><a href="{{ route('website.home') }}">Home</a></span>
                <span class="devider">/</span>
                <span><a href="javascript:;">@lang('dashboard.cart')</a></span>
            </div>
            <div class="blog-heading about-heading">
                <h1 class="heading">@lang('dashboard.cart')</h1>
            </div>
        </div>
    </section>


    <section class="product-cart product footer-padding">
        @livewire('website.cart.cart-table')
    </section>

@endsection
@push('script')
@endpush
