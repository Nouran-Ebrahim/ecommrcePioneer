<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class=" nav-item {{ Request::is('*/home*') ? 'active' : '' }}"><a href="{{ route('dashboard.home') }}"><i
                        class="la la-home"></i><span class="menu-title"
                        data-i18n="nav.disabled_menu.main">@lang('dashboard.dashboard')</span></a>
            </li>
            @can('categories')
                <li class=" nav-item {{ Request::is('*/categories*') ? 'open' : '' }}">
                    <a href="index.html"><i class="la la-home">
                        </i><span class="menu-title" data-i18n="nav.dash.main">@lang('dashboard.categories')</span><span
                            class="badge badge badge-info badge-pill float-right mr-2">{{ $categories_count }}</span></a>
                    <ul class="menu-content">
                        <li class="{{ Request::is('*/categories') ? 'active' : '' }}"><a class="menu-item"
                                href="{{ route('dashboard.categories.index') }}"
                                data-i18n="nav.dash.ecommerce">@lang('dashboard.categories')</a>
                        </li>
                        <li class="{{ Request::is('*/categories/create') ? 'active' : '' }}"><a class="menu-item"
                                href="{{ route('dashboard.categories.create') }}"
                                data-i18n="nav.dash.crypto">@lang('dashboard.add_category')</a>
                        </li>

                    </ul>
                </li>
            @endcan
            @can('brands')
                <li class=" nav-item {{ Request::is('*/brands*') ? 'open' : '' }}">
                    <a href="index.html"><i class="la la-home">
                        </i><span class="menu-title" data-i18n="nav.dash.main">@lang('dashboard.brands')</span><span
                            class="badge badge badge-info badge-pill float-right mr-2">{{ $brands_count }}</span></a>
                    <ul class="menu-content">
                        <li class="{{ Request::is('*/brands') ? 'active' : '' }}"><a class="menu-item"
                                href="{{ route('dashboard.brands.index') }}"
                                data-i18n="nav.dash.ecommerce">@lang('dashboard.brands')</a>
                        </li>


                    </ul>
                </li>
            @endcan
            @can('users')
                <li class=" nav-item"><a href="#"><i class="la la-users"></i><span class="menu-title"
                            data-i18n="nav.templates.main">{{ __('dashboard.users') }}</span><span
                            class="badge badge badge-info badge-pill float-right mr-2">{{ $admins_count }}</span></a>
                    <ul class="menu-content">
                        <li>
                            <a class="menu-item" href="{{ route('dashboard.users.index') }}"
                                data-i18n="">{{ __('dashboard.users') }}</a>
                        </li>
                    </ul>
                </li>
            @endcan
            @can('global_shipping')
                <li class=" nav-item"><a href="#"><i class="la la-ambulance"></i><span class="menu-title"
                            data-i18n="nav.templates.main"> {{ __('dashboard.shipping') }} </span></a>
                    <ul class="menu-content">
                        <li>
                            <a class="menu-item" href="{{ route('dashboard.countries.index') }}"
                                data-i18n="">{{ __('dashboard.shippping') }}</a>
                        </li>

                    </ul>
                </li>
            @endcan
            @can('coupons')
                <li class=" nav-item {{ Request::is('*/coupons*') ? 'open' : '' }}">
                    <a href="index.html"><i class="la la-home">
                        </i><span class="menu-title" data-i18n="nav.dash.main">@lang('dashboard.coupons')</span><span
                            class="badge badge badge-info badge-pill float-right mr-2">{{ $coupons_count }}</span></a>
                    <ul class="menu-content">
                        <li class="{{ Request::is('*/coupons') ? 'active' : '' }}"><a class="menu-item"
                                href="{{ route('dashboard.coupons.index') }}"
                                data-i18n="nav.dash.ecommerce">@lang('dashboard.coupons')</a>
                        </li>


                    </ul>
                </li>
            @endcan
            @can('roles')
                <li class=" nav-item {{ Request::is('*/roles*') ? 'open active' : '' }}"><a href="#"><i
                            class="la la-television"></i><span class="menu-title"
                            data-i18n="nav.templates.main">@lang('dashboard.roles')</span></a>
                    <ul class="menu-content">
                        <li class="{{ Request::is('*/roles*') ? 'is-shown' : '' }}">
                            <a class="menu-item" href="{{ route('dashboard.roles.create') }}"
                                data-i18n="">@lang('dashboard.add_roles')</a>
                        </li>
                        <li class="{{ Request::is('*/roles*') ? 'is-shown' : '' }}">
                            <a class="menu-item" href="{{ route('dashboard.roles.index') }}"
                                data-i18n="">@lang('dashboard.roles')</a>
                        </li>
                    </ul>
                </li>
            @endcan
            @can('admins')
                <li class=" nav-item {{ Request::is('*/admins*') ? 'open active' : '' }}"><a href="#"><i
                            class="la la-television"></i><span class="menu-title"
                            data-i18n="nav.templates.main">@lang('dashboard.admins')</span></a>
                    <ul class="menu-content">
                        <li class="{{ Request::is('*/admins*') ? 'is-shown' : '' }}">
                            <a class="menu-item" href="{{ route('dashboard.admins.create') }}"
                                data-i18n="">@lang('dashboard.add_admin')</a>
                        </li>
                        <li class="{{ Request::is('*/admins*') ? 'is-shown' : '' }}">
                            <a class="menu-item" href="{{ route('dashboard.admins.index') }}"
                                data-i18n="">@lang('dashboard.admins')</a>
                        </li>
                    </ul>
                </li>
            @endcan
            @can('global_shipping')
                <li class=" nav-item {{ Request::is('*/countries*') ? 'open active' : '' }}"><a href="#"><i
                            class="la la-television"></i><span class="menu-title" data-i18n="nav.templates.main">
                            @lang('dashboard.shipping_mangement')
                        </span></a>
                    <ul class="menu-content">
                        <li class="{{ Request::is('*/countries*') ? 'is-shown' : '' }}">
                            <a class="menu-item" href="{{ route('dashboard.countries.index') }}" data-i18n="">
                                @lang('dashboard.shipping_mangement') </a>
                        </li>
                        {{-- <li class="{{ Request::is('*/countries*') ? 'is-shown' : '' }}">
                            <a class="menu-item" href="#" data-i18n="">انشاء سعر الشحن</a>
                        </li> --}}
                    </ul>
                </li>
            @endcan
            {{-- @can('attributes')
                <li class=" nav-item"><a href="index.html"><i class="la la-home"></i><span class="menu-title"
                            data-i18n="nav.dash.main">{{ __('dashboard.attributes') }}</span></a>
                    <ul class="menu-content">
                        <li class="active"><a class="menu-item" href="{{ route('dashboard.attributes.index') }}"
                                data-i18n="nav.dash.ecommerce">{{ __('dashboard.attributes') }}</a>
                        </li>
                    </ul>
                </li>
            @endcan --}}
            @if (auth('admin')->user()->can('products') || auth('admin')->user()->can('attributes'))
                <li class="nav-item"><a href="javascript:void(0)"><i class="la la-cart-arrow-down"></i><span
                            class="menu-title" data-i18n="nav.dash.main">{{ __('dashboard.products') }}</span><span
                            class="badge badge badge-info badge-pill float-right mr-2">{{ $products_count }}</span></a>
                    <ul class="menu-content">
                        @can('attributes')
                            <li class="active"><a class="menu-item" href="{{ route('dashboard.attributes.index') }}"
                                    data-i18n="nav.dash.ecommerce">{{ __('dashboard.attributes') }}</a>
                            </li>
                        @endcan
                        @can('products')
                            <li><a class="menu-item" href="{{ route('dashboard.products.index') }}"
                                    data-i18n="nav.dash.crypto">{{ __('dashboard.products') }}</a>
                            </li>
                            <li><a class="menu-item" href="{{ route('dashboard.products.create') }}"
                                    data-i18n="nav.dash.crypto">{{ __('dashboard.create_product') }}</a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endif

            @can('contacts')
                <li class=" nav-item"><a href="index.html"><i class="la la-phone"></i><span class="menu-title"
                            data-i18n="nav.dash.main">{{ __('dashboard.contacts') }}</span><span
                            class="badge badge badge-info badge-pill float-right mr-2">{{ $contacts_count }}</span></a>
                    <ul class="menu-content">
                        <li class="active"><a class="menu-item" href="{{ route('dashboard.contacts.index') }}"
                                data-i18n="nav.dash.ecommerce">{{ __('dashboard.contacts') }}</a>
                        </li>
                    </ul>
                </li>
            @endcan
            @can('faqs')
                <li class=" nav-item"><a href="index.html"><i class="la la-home"></i><span class="menu-title"
                            data-i18n="nav.dash.main">{{ __('dashboard.faqs') }}</span><span
                            class="badge badge badge-info badge-pill float-right mr-2">{{ $faqs_count }}</span></a>
                    <ul class="menu-content">
                        <li class="active"><a class="menu-item" href="{{ route('dashboard.faqs.index') }}"
                                data-i18n="nav.dash.ecommerce">{{ __('dashboard.faqs') }}</a>
                        </li>
                    </ul>
                </li>
            @endcan
            @can('faqsQuestions')
                <li class=" nav-item"><a href="index.html"><i class="la la-home"></i><span class="menu-title"
                            data-i18n="nav.dash.main">{{ __('dashboard.faqsQuestions') }}</span></a>
                    <ul class="menu-content">
                        <li class="active"><a class="menu-item" href="{{ route('dashboard.faqsQuestions.index') }}"
                                data-i18n="nav.dash.ecommerce">{{ __('dashboard.faqsQuestion') }}</a>
                        </li>
                    </ul>
                </li>
            @endcan
            @can('settings')
                <li class=" nav-item"><a href="index.html"><i class="la la-home"></i><span class="menu-title"
                            data-i18n="nav.dash.main">{{ __('dashboard.settings') }}</span></a>
                    <ul class="menu-content">
                        @can('settings')
                            <li class="active"><a class="menu-item" href="{{ route('dashboard.settings.index') }}"
                                    data-i18n="nav.dash.ecommerce">{{ __('dashboard.settings') }}</a>
                            </li>
                        @endcan
                        @can('sliders')
                            <li class="active"><a class="menu-item" href="{{ route('dashboard.sliders.index') }}"
                                    data-i18n="nav.dash.ecommerce">{{ __('dashboard.sliders') }}</a>

                            </li>
                        @endcan
                        @can('pages')
                            <li class="active"><a class="menu-item" href="{{ route('dashboard.pages.index') }}"
                                    data-i18n="nav.dash.ecommerce">{{ __('dashboard.pages') }}</a>

                            </li>
                        @endcan

                    </ul>
                </li>
            @endcan

            @can('orders')
                <li class="nav-item"><a href="javascript:void(0)"><i class="la la-cart-arrow-down"></i><span
                            class="menu-title" data-i18n="nav.dash.main">{{ __('dashboard.orders') }}</span>
                        {{-- <span
                            class="badge badge badge-info badge-pill float-right mr-2">10</span> --}}
                    </a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="{{ route('dashboard.orders.index') }}"
                                data-i18n="nav.dash.crypto">{{ __('dashboard.orders') }}</a>
                        </li>
                    </ul>
                </li>
            @endcan
        </ul>
    </div>
</div>
