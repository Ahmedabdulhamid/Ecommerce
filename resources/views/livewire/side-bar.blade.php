@php

    $admin = Auth::guard('admin')->user();

@endphp

<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main mt-5" id="main-menu-navigation" data-menu="menu-navigation">
            @if ($admin && $admin->can('super-admin'))
                <li class=" nav-item"><a href="{{ route('admins.index') }}"><i class="fa-solid fa-lock"></i><span
                            class="menu-title" data-i18n="nav.dash.main">{{ __('sidebar.admins') }}</span><span
                            class="badge badge badge-info badge-pill float-right mr-2 admins-bar">{{ $admins }}</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="{{ route('admins.index') }}"
                                data-i18n="nav.dash.ecommerce">{{ __('admin.admins_page') }}</a>
                        </li>

                    </ul>
                </li>
            @endif

            <li class=" nav-item"><a href="#"><i class="fa-solid fa-user"></i><span class="menu-title"
                        data-i18n="nav.templates.main">{{ __('sidebar.users') }}</span><span
                        class="badge badge badge-info badge-pill float-right mr-2 users-bar">{{ $users }}</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{ route('users.index') }}"
                            data-i18n="nav.templates.vert.main">{{ __('admin.users_page') }}</a>

                    </li>

                </ul>
            </li>
            @if ($admin && ($admin->can('admin') || $admin->can('super-admin') || $admin->can('product-manager')))
                <li class=" nav-item"><a href="#"><i class="fa-solid fa-copyright"></i><span class="menu-title"
                            data-i18n="nav.templates.main">{{ __('sidebar.brands') }}</span><span
                            class="badge badge badge-info badge-pill float-right mr-2">{{ $brands }}</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="{{ route('brands.index') }}"
                                data-i18n="nav.templates.vert.main">{{ __('admin.brands_page') }}</a>

                        </li>

                    </ul>
                </li>
            @endif

            @if ($admin && ($admin->can('admin') || $admin->can('category-manager') || $admin->can('super-admin')))
                <li class=" nav-item">
                    <a href="#"><i class="fa-solid fa-table-cells-row-lock"></i>
                        <span class="menu-title" data-i18n="nav.templates.main">{{ __('sidebar.categories') }}</span>
                        <span class="badge badge badge-info badge-pill float-right mr-2">{{ $categories }}</span>
                    </a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="{{ route('categories.index') }}"
                                data-i18n="nav.templates.vert.main">{{ __('admin.categories_page') }}</a>
                        </li>
                    </ul>
                </li>
            @endif

            @if ($admin && ($admin->can('super-admin') || $admin->can('product-manager')))
                <li class=" nav-item"><a href="#"><i class="fa-solid fa-percent"></i><span class="menu-title"
                            data-i18n="nav.templates.main">{{ __('sidebar.coupones') }}</span><span
                            class="badge badge badge-info badge-pill float-right mr-2 coupon-bar">{{ $coupones }}</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item " href="{{ route('coupones') }}"
                                data-i18n="nav.templates.vert.main">{{ __('admin.coupones_page') }}</a>

                        </li>

                    </ul>
                </li>
            @endif

            @if ($admin && ($admin->can('super-admin') || $admin->can('product-manager')))
                <li class=" nav-item"><a href="#"><i class="la la-television"></i><span class="menu-title"
                            data-i18n="nav.templates.main">{{ __('sidebar.attributes') }}</span><span
                            class="badge badge badge-info badge-pill float-right mr-2 attribute-bar">{{ $attributesCount }}</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item " href="{{ route('attributes') }}"
                                data-i18n="nav.templates.vert.main">{{ __('admin.attributes_page') }}</a>

                        </li>

                    </ul>
                </li>
            @endif

            @if ($admin && ($admin->can('super-admin') || $admin->can('product-manager')))
                <li class=" nav-item"><a href="#"><i class="la la-television"></i><span class="menu-title"
                            data-i18n="nav.templates.main">{{ __('sidebar.products') }}</span><span
                            class="badge badge badge-info badge-pill float-right mr-2 product-bar">{{ $products }}</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item " href="{{ route('products.index') }}"
                                data-i18n="nav.templates.vert.main">{{ __('admin.products_page') }}</a>

                        </li>

                    </ul>
                </li>
            @endif

            @if ($admin && ($admin->can('super-admin') || $admin->can('admin')))
                <li class=" nav-item"><a href="#"><i class="fa-solid fa-globe"></i><span class="menu-title"
                            data-i18n="nav.templates.main">{{ __('sidebar.countaries') }}</span><span
                            class="badge badge badge-info badge-pill float-right mr-2 coupon-bar">{{ $countaries }}</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item " href="{{ route('countaries.index') }}"
                                data-i18n="nav.templates.vert.main">{{ __('admin.countries_page') }}</a>

                        </li>

                    </ul>
                </li>
            @endif
            @if ($admin && ($admin->can('super-admin') || $admin->can('contact-manager')))
                <li class=" nav-item"><a href="#"><i class="fa-solid fa-address-card"></i><span class="menu-title"
                            data-i18n="nav.templates.main">{{ __('contacts.contacts') }}</span><span
                            class="badge badge badge-info badge-pill float-right mr-2 users-bar">{{ $contacts }}</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="{{ route('contacts.index') }}"
                                data-i18n="nav.templates.vert.main">{{ __('admin.contacts_page') }}</a>

                        </li>

                    </ul>
                </li>
            @endif
            @if ($admin && ($admin->can('super-admin') || $admin->can('contact-manager')))
                <li class=" nav-item"><a href="#"><i class="la la-question"></i><span class="menu-title"
                            data-i18n="nav.templates.main">{{ __('sidebar.faqs') }}</span><span
                            class="badge badge badge-info badge-pill float-right mr-2 faq-bar">{{ $faqs }}</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="{{ route('faqs.index') }}"
                                data-i18n="nav.templates.vert.main">{{__('admin.faqs_page')}}</a>

                        </li>

                    </ul>
                </li>
            @endif


            @if ($admin && ($admin->can('super-admin') || $admin->can('contact-manager')))
                <li class=" nav-item"><a href="#"><i class="la la-question"></i><span class="menu-title"
                            data-i18n="nav.templates.main">{{ __('sidebar.user-faqs') }}</span><span
                            class="badge badge badge-info badge-pill float-right mr-2 user-ques-bar">{{ $userQuestions }}</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="{{ route('user-faqs.index') }}"
                                data-i18n="nav.templates.vert.main">{{__('admin.user_ques_page')}}</a>

                        </li>

                    </ul>
                </li>
            @endif

            @if ($admin && $admin->can('super-admin'))
                <li class=" nav-item"><a href="#"><i class="la la-key"></i><span class="menu-title"
                            data-i18n="nav.templates.main">{{ __('sidebar.permissions') }}</span><span
                            class="badge badge badge-info badge-pill float-right mr-2">{{ $permissions }}</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="{{ route('permissions.index') }}"
                                data-i18n="nav.templates.vert.main">{{__('admin.permissions_page')}}</a>

                        </li>

                    </ul>

                </li>
            @endif

            @if ($admin && $admin->can('super-admin'))
                <li class=" nav-item"><a href="#"><i class="fa-solid fa-hand-sparkles"></i><span
                            class="menu-title" data-i18n="nav.templates.main">{{ __('sidebar.roles') }}</span><span
                            class="badge badge badge-info badge-pill float-right mr-2">{{ $roles }}</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="{{ route('roles.index') }}"
                                data-i18n="nav.templates.vert.main">{{__('admin.roles_page')}}</a>

                        </li>

                    </ul>

                </li>
            @endif
            @if ($admin && ($admin->can('super-admin') || $admin->can('admin')))
                <li class=" nav-item"><a href="#"><i class="la la-gear"></i><span class="menu-title"
                            data-i18n="nav.templates.main">{{ __('sidebar.settings') }}</span><span
                            class="badge badge badge-info badge-pill float-right mr-2">{{ $settings }}</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="{{ route('settings.index') }}"
                                data-i18n="nav.templates.vert.main">{{__('admin.settings_page')}}</a>

                        </li>

                    </ul>

                </li>
            @endif

            @if ($admin && ($admin->can('super-admin') || $admin->can('designer')))
                <li class=" nav-item"><a href="#"><i class="la la-sliders"></i><span class="menu-title"
                            data-i18n="nav.templates.main">{{ __('sidebar.sliders') }}</span><span
                            class="badge badge badge-info badge-pill float-right mr-2 product-bar">{{ $sliders }}</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item " href="{{ route('sliders.index') }}"
                                data-i18n="nav.templates.vert.main">{{__('admin.sliders')}}</a>

                        </li>

                    </ul>
                </li>
            @endif
            @if ($admin && ($admin->can('super-admin') || $admin->can('designer')))
                <li class=" nav-item"><a href="#"><i class="la la-file"></i><span class="menu-title"
                            data-i18n="nav.templates.main">{{ __('sidebar.pages') }}</span><span
                            class="badge badge badge-info badge-pill float-right mr-2 product-bar">{{ $pages }}</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item " href="{{ route('pages.index') }}"
                                data-i18n="nav.templates.vert.main">{{__('admin.pages_table')}}</a>

                        </li>

                    </ul>
                </li>
            @endif
            @if ($admin && ($admin->can('super-admin') || $admin->can('order-manger')))
                <li class=" nav-item"><a href="#"><i class="la la-cart-plus"></i><span class="menu-title"
                            data-i18n="nav.templates.main">{{ __('sidebar.orders') }}</span><span
                            class="badge badge badge-info badge-pill float-right mr-2 order-bar">{{ $orders }}</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item " href="{{ route('orders.index') }}"
                                data-i18n="nav.templates.vert.main">{{__('admin.orders_page')}}</a>

                        </li>

                    </ul>
                </li>
            @endif





        </ul>
        </li>


        </ul>
    </div>
</div>
