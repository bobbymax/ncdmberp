<aside id="main-sidebar" class="dt-sidebar" style="background-color: #faf662">
    <div class="dt-sidebar__container">

        <!-- Sidebar Navigation -->
        <ul class="dt-side-nav">

            <!-- Menu Header -->
            <li class="dt-side-nav__item dt-side-nav__header">
                <span class="dt-side-nav__text">main</span>
            </li>
            <!-- /menu header -->

            <!-- Menu Item -->
            <li class="dt-side-nav__item">
                <a href="{{ route('user.dashboard') }}" class="dt-side-nav__link" title="Dashboard"> <i
                        class="icon icon-dashboard2 icon-fw icon-lg"></i>
                    <span class="dt-side-nav__text">Dashboard</span> </a>
            </li>

            {{--

            @if (auth()->user()->isAdministrator())
                <!-- Menu Header -->
                <li class="dt-side-nav__item dt-side-nav__header">
                    <span class="dt-side-nav__text">Consumables</span>
                </li>
                <!-- /menu header -->
                @foreach ($resources as $resource)
                    <!-- Menu Item -->
                    <li class="dt-side-nav__item">
                        <a href="{{ route('fetch.resource', $resource->label) }}" class="dt-side-nav__link" title="{{ $resource->name }}">
                            <i class="icon icon-listall icon-fw icon-lg"></i>
                            <span class="dt-side-nav__text">{{ $resource->name }}</span>
                        </a>
                    </li>
                @endforeach
            @endif

            --}}


            @foreach ($modules as $module)
                @can('accessible', $module->application)

                    @if ($module->hasChildren()->count() > 0)
                        @can('accessible', $module)
                        <!-- Menu Header -->
                        <li class="dt-side-nav__item dt-side-nav__header">
                            <span class="dt-side-nav__text">{{ $module->name }}</span>
                        </li>
                        <!-- /menu header -->
                        @endcan

                        @foreach ($module->pages as $page)
                            @can('accessible', $page)
                                @if ($page->menu == 1 && $page->is_published == 1)
                                    <!-- Menu Item -->
                                    <li class="dt-side-nav__item">
                                        <a href="{{ route($page->route) }}" class="dt-side-nav__link" title="{{ $page->name }}">
                                            <i class="icon {{ $page->icon }} icon-fw icon-lg"></i>
                                            <span class="dt-side-nav__text">{{ $page->name }}</span>
                                        </a>
                                    </li>
                                @endif
                            @endcan
                        @endforeach
                    @endif
                @endcan
            @endforeach

        </ul>
        <!-- /sidebar navigation -->

    </div>
</aside>
