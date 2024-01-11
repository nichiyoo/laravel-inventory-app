@php
    $categories = ['Hardware', 'Software', 'Peripheral'];
    // {{ request()->routeIs('assets.index') && request()->query('category') == $category ? 'active' : '' }}
@endphp

<aside class="navbar navbar-vertical navbar-expand-lg navbar-transparent">
    <div class="container-fluid">

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu"
            aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <h1 class="navbar-brand navbar-brand-autodark">
            <a href="{{ route('dashboard.index') }}" class="navbar-brand navbar-brand-autodark">
                <img src="{{ asset('img/logo.svg') }}" width="28" height="28" alt="Tabler"
                    class="navbar-brand-image">
                <span class="navbar-brand-title">{{ config('app.name', 'Laravel') }}</span>
            </a>
        </h1>

        <div class="navbar-nav flex-row d-lg-none">
            {{-- empty --}}
        </div>

        <div class="collapse navbar-collapse" id="sidebar-menu">
            <ul class="navbar-nav pt-lg-3">
                <li class="nav-item {{ request()->routeIs('dashboard.*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('dashboard.index') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <i class="ti ti-home icon"></i>
                        </span>
                        <span class="nav-link-title">
                            Home
                        </span>
                    </a>
                </li>

                <li class="nav-item dropdown {{ request()->routeIs('assets.index') ? 'active' : '' }}">
                    <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown"
                        data-bs-auto-close="false" role="button" aria-expanded="false">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <i class="ti ti-package icon"></i>
                        </span>
                        <span class="nav-link-title">
                            List Assets
                        </span>
                    </a>

                    <div class="dropdown-menu {{ request()->routeIs('assets.index') ? 'show' : '' }}">
                        <div class="dropdown-menu-columns">
                            <div class="dropdown-menu-column">
                                <a href="{{ route('assets.index') }}"
                                    class="dropdown-item {{ (request()->routeIs('assets.index') && request()->query('category') == 'All') || !request()->query('category') ? 'active' : '' }}">
                                    All Categories
                                </a>
                            </div>
                        </div>

                        @foreach ($categories as $category)
                            <div class="dropdown-menu-columns">
                                <div class="dropdown-menu-column">
                                    <a href="{{ route('assets.index', ['category' => $category]) }}"
                                        class="dropdown-item {{ request()->routeIs('assets.index') && request()->query('category') == $category ? 'active' : '' }}">
                                        {{ $category }}
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </li>

                <li class="nav-item {{ request()->routeIs('assets.create') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('assets.create') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <i class="ti ti-layout-grid-add icon"></i>
                        </span>
                        <span class="nav-link-title">
                            Create Asset
                        </span>
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#navbar-help" data-bs-toggle="dropdown"
                        data-bs-auto-close="false" role="button" aria-expanded="false">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <i class="ti ti-user icon"></i>
                        </span>
                        <span class="nav-link-title">
                            Other
                        </span>
                    </a>
                    <div class="dropdown-menu">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item w-100">
                                Logout
                            </button>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</aside>
