@extends('layouts.website.app')
@section('title', __('dashboard.register'))
@section('content')
    <section class="login account footer-padding">
        <div class="container">
            <form id="registerForm" method="post" action="{{ route('website.register.post') }}"
                class="login-section account-section">
                @csrf
                <div class="review-form">
                    <h5 class="comment-title">Create Account</h5>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>

                    @endif
                    <div class=" account-inner-form">
                        <div class="review-form-name">
                            <label for="fname" class="form-label">
                                Name*</label>
                            <input name="name" type="text" id="fname" class="form-control" placeholder="Name">
                        </div>

                    </div>
                    <div class=" account-inner-form">
                        <div class="review-form-name">
                            <label for="email" class="form-label">Email*</label>
                            <input name="email" type="email" id="email" class="form-control"
                                placeholder="user@gmail.com">
                        </div>

                    </div>
                    <div class="review-form-name">
                        @livewire('general.address-drop-down-dependent')

                    </div>

                    <div class=" account-inner-form">
                        <div class="review-form-name">
                            <label for="password" class="form-label">password*</label>
                            <input name="password" type="password" id="password" class="form-control" placeholder="******">
                        </div>

                    </div>

                    <div class="review-form-name checkbox">
                        <div class="checkbox-item">
                            <input name="terms" type="checkbox">
                            <p class="remember">
                                I agree all terms and condition in <span class="inner-text">ShopUs.</span></p>
                        </div>
                    </div>
                    <div class="login-btn text-center">
                        <button type="submit" class="shop-btn">Create an Account</button>
                        <span class="shop-account">Already have an account
                            ?<a href="{{ route('website.login.get') }}">Log In</a></span>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
