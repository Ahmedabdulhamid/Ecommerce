@php
    use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
    $lang = LaravelLocalization::getCurrentLocale() == 'ar' ? 'en' : 'ar';

    $notifications = auth('admin')->user()->unreadNotifications;

    $admin = Auth::guard('admin')->user();

@endphp
@if (Auth::guard('admin')->check())
    <meta name="admin-id" content="{{ auth('admin')->id() }}">
@endif
<nav
    class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-semi-dark navbar-shadow">
    <div class="navbar-wrapper">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs"
                        href="#"><i class="ft-menu font-large-1"></i></a></li>
                <li class="nav-item mr-auto">
                    <a class="navbar-brand" href="index.html">
                        <img class="brand-logo" alt="modern admin logo"
                            src="{{ asset('assets') }}/images/logo/logo.png">
                        <h3 class="brand-text">Modern Admin</h3>
                    </a>
                </li>
                <li class="nav-item d-none d-md-block float-right"><a class="nav-link modern-nav-toggle pr-0"
                        data-toggle="collapse"><i class="toggle-icon ft-toggle-right font-medium-3 white"
                            data-ticon="ft-toggle-right"></i></a></li>
                <li class="nav-item d-md-none">
                    <a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i
                            class="la la-ellipsis-v"></i></a>
                </li>
            </ul>
        </div>
        <div class="navbar-container content">
            <div class="collapse navbar-collapse" id="navbar-mobile">
                <ul class="nav navbar-nav mr-auto float-left">
                    <li class="nav-item d-none d-md-block"><a class="nav-link nav-link-expand" href="#"><i
                                class="ficon ft-maximize"></i></a></li>

                    <li class="nav-item nav-search"><a class="nav-link nav-link-search" href="#"><i
                                class="ficon ft-search"></i></a>
                        <div class="search-input">
                            <input class="input" type="text" placeholder="Explore Modern...">
                        </div>
                    </li>
                </ul>
                <ul class="nav navbar-nav float-right">
                    <li class="dropdown dropdown-user nav-item">
                        <a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                            <span class="mr-1">
                                <span class="user-name text-bold-700">{{ Auth::guard('admin')->user()->name }}</span>
                            </span>
                            <span class="avatar avatar-online">
                                <img src="{{ asset('assets') }}/images/portrait/small/avatar-s-19.png"
                                    alt="avatar"><i></i></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">

                            <form action="{{ route('admin.logout') }}"method="POST">
                                @csrf
                                <button class="dropdown-item btn" type="submit"style="background-color:transparent">

                                    <i class="ft-power"></i> {{ __('admin.logout') }}</button>
                            </form>


                        </div>
                    </li>
                    <li class="dropdown dropdown-language nav-item"><a class="dropdown-toggle nav-link"
                            id="dropdown-flag" href="#" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"><i class="flag-icon flag-icon-gb"></i><span
                                class="selected-language"></span></a>
                        <div class="dropdown-menu" aria-labelledby="dropdown-flag">

                            <a class="dropdown-item" href="{{ LaravelLocalization::getLocalizedURL('ar') }}"><i
                                    class="flag-icon flag-icon-eg"></i> العربية</a>
                            <a class="dropdown-item" href="{{ LaravelLocalization::getLocalizedURL('en') }}"><i
                                    class="flag-icon flag-icon-us"></i>English</a>

                        </div>
                    </li>
                    @if ($admin && ($admin->can('order-manager') || $admin->can('super-admin') || $admin->can('contact-creator')))
                        <li class="dropdown dropdown-notification nav-item">
                            <a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i
                                    class="ficon ft-bell"></i>
                                <span
                                    class="badge badge-pill badge-default badge-danger badge-default badge-up badge-glow"id="notifications_count">{{ count(auth('admin')->user()->unreadNotifications) }}</span>
                            </a>

                            <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                                <li class="dropdown-menu-header">
                                    <h6 class="dropdown-header m-0">
                                        <span class="grey darken-2">{{__('admin.notifications')}}</span>
                                    </h6>
                                    <span
                                        class="notification-tag badge badge-default badge-danger float-right m-0"id="notifications_count_inside">{{ count(auth('admin')->user()->unreadNotifications) }}
                                        {{__('admin.new')}}</span>
                                </li>
                                <li class="scrollable-container media-list w-100">

                                    @forelse ($notifications as $notification)
                                        @if ($notification->type == 'CreateOrderNotification')
                                            <a
                                                href="{{ route('orders.show', ['id' => $notification->data['order_id']]) }}?notify-order={{ $notification->id }}">
                                                <div class="media">
                                                    <div class="media-left align-self-center"><i
                                                            class="ft-plus-square icon-bg-circle bg-cyan"></i></div>
                                                    <div class="media-body">
                                                        <h6 class="media-heading">{{ $notification->data['message'] }}
                                                        </h6>
                                                        <p class="notification-text font-small-3 text-muted">{{__('admin.order_from')}}
                                                            {{ $notification->data['user_name'] }}
                                                            {{ number_format($notification->data['total_price']) }} EGP
                                                        </p>
                                                        <small>
                                                            <time class="media-meta text-muted"
                                                                datetime="2015-06-11T18:29:20+08:00">
                                                                {{ $notification->created_at->diffForHumans() }}
                                                            </time>
                                                        </small>
                                                    </div>
                                                </div>
                                            </a>
                                        @elseif ($notification->type == 'CreateContactNotification')
                                            <a
                                                href="{{ route('contacts.index') }}?notify-contact={{ $notification->id }}">
                                                <div class="media">
                                                    <div class="media-left align-self-center"><i
                                                            class="ft-alert-triangle icon-bg-circle bg-yellow bg-darken-3"></i>
                                                    </div>
                                                    <div class="media-body">
                                                        <h6 class="media-heading">
                                                            {{ $notification->data['custom_message'] }}</h6>
                                                        <p class="notification-text font-small-3 text-muted">{{__('admin.contact_from')}} {{ $notification->data['name'] }}</p>
                                                        <small>
                                                            <time class="media-meta text-muted"
                                                                datetime="2015-06-11T18:29:20+08:00">
                                                                {{ $notification->created_at->diffForHumans() }}
                                                            </time>
                                                        </small>
                                                    </div>
                                                </div>
                                            </a>
                                        @endif

                                    @empty
                                        <p class="text-center">{{__('admin.no_noti_yet')}}</p>
                                    @endforelse


                                </li>
                                <li class="dropdown-menu-footer"><a class="dropdown-item text-muted text-center"
                                        href="javascript:void(0)">{{__('admin.read_all_notifications')}}</a></li>
                            </ul>


                        </li>
                    @endif
                    <li class="dropdown dropdown-notification nav-item">
                        <a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i
                                class="ficon ft-mail"> </i></a>
                        <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                            <li class="dropdown-menu-header">
                                <h6 class="dropdown-header m-0">
                                    <span class="grey darken-2">Messages</span>
                                </h6>
                                <span class="notification-tag badge badge-default badge-warning float-right m-0">4
                                    New</span>
                            </li>
                            <li class="scrollable-container media-list w-100">
                                <a href="javascript:void(0)">
                                    <div class="media">
                                        <div class="media-left">
                                            <span class="avatar avatar-sm avatar-online rounded-circle">
                                                <img src="{{ asset('assets') }}/images/portrait/small/avatar-s-19.png"
                                                    alt="avatar"><i></i></span>
                                        </div>
                                        <div class="media-body">
                                            <h6 class="media-heading">Margaret Govan</h6>
                                            <p class="notification-text font-small-3 text-muted">I like your portfolio,
                                                let's start.</p>
                                            <small>
                                                <time class="media-meta text-muted"
                                                    datetime="2015-06-11T18:29:20+08:00">Today</time>
                                            </small>
                                        </div>
                                    </div>
                                </a>
                                <a href="javascript:void(0)">
                                    <div class="media">
                                        <div class="media-left">
                                            <span class="avatar avatar-sm avatar-busy rounded-circle">
                                                <img src="{{ asset('assets') }}/images/portrait/small/avatar-s-2.png"
                                                    alt="avatar"><i></i></span>
                                        </div>
                                        <div class="media-body">
                                            <h6 class="media-heading">Bret Lezama</h6>
                                            <p class="notification-text font-small-3 text-muted">I have seen your work,
                                                there is</p>
                                            <small>
                                                <time class="media-meta text-muted"
                                                    datetime="2015-06-11T18:29:20+08:00">Tuesday</time>
                                            </small>
                                        </div>
                                    </div>
                                </a>
                                <a href="javascript:void(0)">
                                    <div class="media">
                                        <div class="media-left">
                                            <span class="avatar avatar-sm avatar-online rounded-circle">
                                                <img src="{{ asset('assets') }}/images/portrait/small/avatar-s-3.png"
                                                    alt="avatar"><i></i></span>
                                        </div>
                                        <div class="media-body">
                                            <h6 class="media-heading">Carie Berra</h6>
                                            <p class="notification-text font-small-3 text-muted">Can we have call in
                                                this week ?</p>
                                            <small>
                                                <time class="media-meta text-muted"
                                                    datetime="2015-06-11T18:29:20+08:00">Friday</time>
                                            </small>
                                        </div>
                                    </div>
                                </a>
                                <a href="javascript:void(0)">
                                    <div class="media">
                                        <div class="media-left">
                                            <span class="avatar avatar-sm avatar-away rounded-circle">
                                                <img src="{{ asset('assets') }}/images/portrait/small/avatar-s-6.png"
                                                    alt="avatar"><i></i></span>
                                        </div>
                                        <div class="media-body">
                                            <h6 class="media-heading">Eric Alsobrook</h6>
                                            <p class="notification-text font-small-3 text-muted">We have project party
                                                this saturday.</p>
                                            <small>
                                                <time class="media-meta text-muted"
                                                    datetime="2015-06-11T18:29:20+08:00">last month</time>
                                            </small>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="dropdown-menu-footer"><a class="dropdown-item text-muted text-center"
                                    href="javascript:void(0)">Read all messages</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
@if (Auth::guard('admin')->check())
    <script>
        layout = "admin"
        adminId = "{{ auth('admin')->user()->id }}"
        showOrderRoute = "{{ route('orders.show', ':id') }}"
        showContactRoute = "{{ route('contacts.index') }}"
    </script>
@endif
<script src="{{ asset('build/assets/app-9e5c418a.js') }}"></script>
