<div id="layoutSidenav_nav">
    <nav class="sidenav shadow-right sidenav-light">
        <div class="sidenav-menu">
            <div class="nav accordion" id="side-nav">
                <div class="sidenav-menu-heading"><a href="{{route('dashboard')}}">Home</a></div>
                @can('rider')
                <x-aside-link :href="route('dashboard')" title="Dashboard">
                    <x-slot name="icon">
                        <i class="fa fa-home"></i>
                    </x-slot>
                </x-aside-link>
                @endcan
                @can('company')
                @include('partials.asides.company')
                @endcan

                @can('admin')
                @include('partials.asides.admin')
                @endcan
                <x-aside-link :href="route('change.password')" title="Change Password">
                    <x-slot name="icon">
                        <i class="fa fa-lock"></i>
                    </x-slot>
                </x-aside-link>
            </div>
        </div>
        <div class="sidenav-footer">
            <div class="sidenav-footer-content">
                <div class="sidenav-footer-subtitle">Logged in as:</div>
                <div class="sidenav-footer-title">
                    {{ auth()->user()->name }}
                </div>
            </div>
        </div>
    </nav>
</div>
