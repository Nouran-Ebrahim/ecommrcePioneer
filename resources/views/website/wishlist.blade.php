@extends('layouts.website.app')
@section('title', __('dashboard.wishlist'))
@section('content')
    <section class="blog about-blog">
        <div class="container">
            <div class="blog-bradcrum">
                <span><a href="{{ route('website.home') }}">Home</a></span>
                <span class="devider">/</span>
                <span><a href="javascript:;">@lang('dashboard.wishlist')</a></span>
            </div>
            <div class="blog-heading about-heading">
                <h1 class="heading">@lang('dashboard.wishlist')</h1>
            </div>
        </div>
    </section>

    <section class="cart product wishlist footer-padding" data-aos="fade-up">
        @livewire('website.wishlist-table')
    </section>




@endsection
@push('script')
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('remove-wishlist', (event) => {
                Swal.fire({
                    position: "top-center",
                    icon: "success",
                    title: "@lang('dashboard.success')",
                    text: event,
                    showConfirmButton: false,
                    timer: 1500
                });
            });
        });
    </script>
@endpush
