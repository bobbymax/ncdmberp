@auth
    <header class="dt-header">

        <!-- Header container -->
        <div class="dt-header__container">

            <!-- Brand -->
            <div class="dt-brand">

                <!-- Brand tool -->
                <div class="dt-brand__tool" data-toggle="main-sidebar">
                    <div class="hamburger-inner"></div>
                </div>
                <!-- /brand tool -->

                <!-- Brand logo -->
                <span class="dt-brand__logo">
                    <a class="dt-brand__logo-link" href="index.html">
                        <img class="dt-brand__logo-img d-none d-sm-inline-block" src="{{ asset('images/logo.jpg') }}" alt="Drift">
                        <img class="dt-brand__logo-symbol d-sm-none" src="{{ asset('images/logo.jpg') }}" alt="Drift">
                    </a>
                </span>
                <!-- /brand logo -->

            </div>
            <!-- /brand -->

            <!-- Header toolbar-->
            <div class="dt-header__toolbar">

                <!-- Search box -->
                <form class="search-box d-none d-lg-block">
                    <div class="input-group">
                        <input class="form-control" placeholder="Search in app..." value="" type="search">
                        <span class="search-icon"><i class="icon icon-search icon-lg"></i></span>
                        <div class="input-group-append">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"
                                    aria-haspopup="true"
                                    aria-expanded="false">Category
                            </button>

                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="javascript:void(0)">Action</a>
                                <a class="dropdown-item" href="javascript:void(0)">Another action</a>
                                <a class="dropdown-item" href="javascript:void(0)">Something else here</a>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- /search box -->

                <!-- Header Menu Wrapper -->
                <div class="dt-nav-wrapper">
                    <!-- Header Menu -->
                    <ul class="dt-nav d-lg-none">
                        <li class="dt-nav__item dt-notification-search dropdown">

                            <!-- Dropdown Link -->
                            <a href="#" class="dt-nav__link dropdown-toggle no-arrow" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false"> <i
                                    class="icon icon-search icon-fw icon-lg"></i> </a>
                            <!-- /dropdown link -->

                            <!-- Dropdown Option -->
                            <div class="dropdown-menu">

                                <!-- Search Box -->
                                <form class="search-box right-side-icon">
                                    <input class="form-control form-control-lg" type="search"
                                           placeholder="Search in app...">
                                    <button type="submit" class="search-icon"><i
                                            class="icon icon-search icon-lg"></i></button>
                                </form>
                                <!-- /search box -->

                            </div>
                            <!-- /dropdown option -->

                        </li>
                    </ul>
                    <!-- /header menu -->

                    <!-- Header Menu -->
                    <ul class="dt-nav">
                        <li class="dt-nav__item dt-notification-app dropdown">

                            <!-- Dropdown Link -->
                            <a href="#" class="dt-nav__link dropdown-toggle no-arrow" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false"> <i
                                    class="icon icon-apps icon-sm icon-fw"></i>
                                <span>Apps</span> </a>
                            <!-- /dropdown link -->

                            <!-- Dropdown Option -->
                            <div class="dropdown-menu ps-custom-scrollbar">

                                <!-- Apps -->
                                <ul class="dt-app-list">
                                    @foreach ($applications as $application)
                                        <li class="dt-app-list__item">
                                            <a href="{{ route('applications.show', $application->code) }}" class="dt-app-list__link">
                                                <img src="{{ asset('images/applications/logos/'.$application->path) }}" alt="{{ $application->name }} Logo Image" class="img-fluid" width="60%">
                                                <span class="dt-app-list__text">{{ strtoupper($application->code) }}</span> </a>
                                        </li>
                                    @endforeach
                                </ul>
                                <!-- /apps -->

                            </div>
                            <!-- /dropdown option -->

                        </li>
                    </ul>
                    <!-- /header menu -->

                    <!-- Header Menu -->
                    <ul class="dt-nav">
                        <li class="dt-nav__item dt-notification dropdown">

                            <!-- Dropdown Link -->
                            <a href="#" class="dt-nav__link dropdown-toggle no-arrow" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false"> <i
                                    class="icon icon-notification2 icon-fw {{ auth()->user()->unreadNotifications->count() > 0 ? 'dt-icon-alert' : '' }}"></i>
                            </a>
                            <!-- /dropdown link -->

                            <!-- Dropdown Option -->
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-media">
                                <!-- Dropdown Menu Header -->
                                <div class="dropdown-menu-header">
                                    <h4 class="title">Notifications ({{ auth()->user()->unreadNotifications->count() }})</h4>

                                    <div class="ml-auto action-area">
                                        <a href="javascript:void(0)">Mark All Read</a> <a class="ml-2"
                                                                                          href="javascript:void(0)">
                                        <i class="icon icon-settings icon-lg text-light-gray"></i> </a>
                                    </div>
                                </div>
                                <!-- /dropdown menu header -->

                                <!-- Dropdown Menu Body -->
                                <div class="dropdown-menu-body ps-custom-scrollbar">

                                    <div class="h-auto">

                                        @foreach (auth()->user()->unreadNotifications as $notification)
                                            <!-- Media -->
                                            <a href="javascript:void(0)" class="media">

                                                <!-- Media Body -->
                                                <span class="">
                                                    <span class="badge badge-success mb-2 mr-1">{{ $notification->data['type'] }}</span>
                                                    <span class="badge badge-primary mb-2 mr-1">{{ $notification->data['status'] }}</span>
                                                    <p class="message">
                                                        <span class="user-name">{{ $notification->data['title'] }}</span> for a period of <span class="user-name">{{ $notification->data['duration'] }}</span>
                                                        started at {{ $notification->data['start_date'] }}
                                                    </p>
                                                    <span class="meta-date">{{ $notification->created_at->diffForHumans() }}</span>
                                                </span>
                                                <!-- /media body -->

                                            </a>
                                            <!-- /media -->
                                        @endforeach
                                    </div>

                                </div>
                                <!-- /dropdown menu body -->

                                <!-- Dropdown Menu Footer -->
                                <div class="dropdown-menu-footer">
                                    <a href="javascript:void(0)" class="card-link"> See All <i
                                            class="icon icon-arrow-right icon-fw"></i>
                                    </a>
                                </div>
                                <!-- /dropdown menu footer -->
                            </div>
                            <!-- /dropdown option -->
                        </li>

                        <li class="dt-nav__item dt-notification dropdown">

                            <!-- Dropdown Link -->
                            <a href="#" class="dt-nav__link dropdown-toggle no-arrow" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false"> <i
                                    class="icon icon-open-mail icon-fw"></i> </a>
                            <!-- /dropdown link -->

                            <!-- Dropdown Option -->
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-media">
                                <!-- Dropdown Menu Header -->
                                <div class="dropdown-menu-header">
                                    <h4 class="title">Messages (6)</h4>

                                    <div class="ml-auto action-area">
                                        <a href="javascript:void(0)">Mark All Read</a> <a class="ml-2"
                                                                                          href="javascript:void(0)">
                                        <i class="icon icon-settings icon-lg text-light-gray"></i></a>
                                    </div>
                                </div>
                                <!-- /dropdown menu header -->

                                <!-- Dropdown Menu Body -->
                                <div class="dropdown-menu-body ps-custom-scrollbar">

                                    <div class="h-auto">

                                        <!-- Media -->
                                        <a href="javascript:void(0)" class="media">

                                            <!-- Avatar -->
                                            <img class="dt-avatar mr-3" src="https://via.placeholder.com/150x150"
                                                 alt="User">
                                            <!-- avatar -->

                                            <!-- Media Body -->
                                            <span class="media-body text-truncate">
                                                <span class="user-name mb-1">Chris Mathew</span>
                                                <span class="message text-light-gray text-truncate">Okay.. I will be waiting for your...</span>
                                            </span>
                                            <!-- /media body -->

                                            <span class="action-area h-100 min-w-80 text-right">
                                                <span class="meta-date mb-1">8 hours ago</span>
                                                <!-- Toggle Button -->
                                                <span class="toggle-button" data-toggle="tooltip" data-placement="left" title="Mark as read">
                                                    <span class="show"><i class="icon icon-dot-o icon-fw f-10 text-light-gray"></i></span>
                                                    <span class="hide"><i class="icon icon-dot icon-fw f-10 text-light-gray"></i></span>
                                                </span>
                                            <!-- /toggle button -->
                                            </span> 
                                        </a>
                                        <!-- /media -->

                                        <!-- Media -->
                                        <a href="javascript:void(0)" class="media">

                                            <!-- Avatar -->
                                            <img class="dt-avatar mr-3" src="https://via.placeholder.com/150x150"
                                                 alt="User">
                                            <!-- avatar -->

                                            <!-- Media Body -->
                                            <span class="media-body text-truncate">
                                                <span class="user-name mb-1">Alia Joseph</span>
                                                <span class="message text-light-gray text-truncate">
                                                Alia Joseph just joined Messenger! Be the first to send a welcome message or sticker.
                                                </span>
                                            </span>
                                            <!-- /media body -->

                                            <span class="action-area h-100 min-w-80 text-right">
                                                <span class="meta-date mb-1">9 hours ago</span>
                                                <!-- Toggle Button -->
                                                <span class="toggle-button" data-toggle="tooltip" data-placement="left" title="Mark as read">
                                                    <span class="show"><i class="icon icon-dot-o icon-fw f-10 text-light-gray"></i></span>
                                                    <span class="hide"><i class="icon icon-dot icon-fw f-10 text-light-gray"></i></span>
                                                </span>
                                                <!-- /toggle button -->
                                            </span> 
                                        </a>
                                        <!-- /media -->

                                        <!-- Media -->
                                        <a href="javascript:void(0)" class="media">

                                            <!-- Avatar -->
                                            <img class="dt-avatar mr-3" src="https://via.placeholder.com/150x150"
                                                 alt="User">
                                            <!-- avatar -->

                                            <!-- Media Body -->
                                            <span class="media-body text-truncate">
                                                <span class="user-name mb-1">Joshua Brian</span>
                                                <span class="message text-light-gray text-truncate">
                                                Alex will explain you how to keep the HTML structure and all that.
                                                </span>
                                            </span>
                                            <!-- /media body -->

                                            <span class="action-area h-100 min-w-80 text-right">
                                                <span class="meta-date mb-1">12 hours ago</span>
                                                <!-- Toggle Button -->
                                                <span class="toggle-button" data-toggle="tooltip" data-placement="left" title="Mark as read">
                                                <span class="show"><i class="icon icon-dot-o icon-fw f-10 text-light-gray"></i></span>
                                                <span class="hide"><i class="icon icon-dot icon-fw f-10 text-light-gray"></i></span>
                                                </span>
                                            <!-- /toggle button -->
                                            </span> 
                                        </a>
                                        <!-- /media -->

                                        <!-- Media -->
                                        <a href="javascript:void(0)" class="media">

                                            <!-- Avatar -->
                                            <img class="dt-avatar mr-3" src="https://via.placeholder.com/150x150"
                                                 alt="User">
                                            <!-- avatar -->

                                            <!-- Media Body -->
                                            <span class="media-body text-truncate">
                                                <span class="user-name mb-1">Domnic Brown</span>
                                                <span class="message text-light-gray text-truncate">Okay.. I will be waiting for your...</span>
                                            </span>
                                            <!-- /media body -->

                                            <span class="action-area h-100 min-w-80 text-right">
                                                <span class="meta-date mb-1">yesterday</span>
                                                <!-- Toggle Button -->
                                                <span class="toggle-button" data-toggle="tooltip" data-placement="left" title="Mark as read">
                                                <span class="show"><i class="icon icon-dot-o icon-fw f-10 text-light-gray"></i></span>
                                                <span class="hide"><i class="icon icon-dot icon-fw f-10 text-light-gray"></i></span>
                                                </span>
                                            <!-- /toggle button -->
                                            </span> 
                                        </a>
                                        <!-- /media -->

                                    </div>

                                </div>
                                <!-- /dropdown menu body -->

                                <!-- Dropdown Menu Footer -->
                                <div class="dropdown-menu-footer">
                                    <a href="javascript:void(0)" class="card-link"> See All <i
                                            class="icon icon-arrow-right icon-fw"></i>
                                    </a>
                                </div>
                                <!-- /dropdown menu footer -->
                            </div>
                            <!-- /dropdown option -->
                        </li>
                    </ul>
                    <!-- /header menu -->

                    <!-- Header Menu -->
                    <ul class="dt-nav">
                        <li class="dt-nav__item dropdown">

                            <!-- Dropdown Link -->
                            <a href="#" class="dt-nav__link dropdown-toggle no-arrow dt-avatar-wrapper"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="dt-avatar size-30" src="{{ auth()->user()->avatar !== null ? asset('images/staffs/'.auth()->user()->avatar) : 'https://via.placeholder.com/150x150' }}"
                                alt="{{ auth()->user()->name }}">
                                <span class="dt-avatar-info d-none d-sm-block">
                                <span class="dt-avatar-name">{{ auth()->user()->name }}</span>
                                </span> 
                            </a>
                            <!-- /dropdown link -->

                            <!-- Dropdown Option -->
                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="dt-avatar-wrapper flex-nowrap p-6 mt-n2 bg-gradient-purple text-white rounded-top">
                                    <img class="dt-avatar" src="{{ auth()->user()->avatar !== null ? asset('images/staffs/'.auth()->user()->avatar) : 'https://via.placeholder.com/150x150' }}"
                                         alt="{{ auth()->user()->name }}">
                                    <span class="dt-avatar-info">
                                        <span class="dt-avatar-name">{{ auth()->user()->name }}</span>
                                        <span class="f-12">{{ auth()->user()->roles->last()->name }}</span>
                                    </span>
                                </div>
                                <a class="dropdown-item" href="{{ route('staffs.show', auth()->user()->staff_no) }}"> <i
                                        class="icon icon-user icon-fw mr-2 mr-sm-1"></i>Account
                                </a> 
                                <a class="dropdown-item" href="javascript:void(0)">
                                    <i class="icon icon-settings icon-fw mr-2 mr-sm-1"></i>Setting
                                </a>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();"> <i
                                        class="icon icon-editors icon-fw mr-2 mr-sm-1"></i>{{ __('Logout') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                            <!-- /dropdown option -->
                        </li>
                    </ul>
                    <!-- /header menu -->
                </div>
                <!-- Header Menu Wrapper -->

            </div>
            <!-- /header toolbar -->

        </div>
        <!-- /header container -->

    </header>
@endauth
