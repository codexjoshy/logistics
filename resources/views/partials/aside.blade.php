<div id="layoutSidenav_nav">
    <nav class="sidenav shadow-right sidenav-light">
        <div class="sidenav-menu">
            <div class="nav accordion" id="side-nav">
                <div class="sidenav-menu-heading"><a href="{{route('dashboard')}}">Home</a></div>
                @can('company')
                <x-aside-link :href="route('dashboard')" title="Dashboard">
                    <x-slot name="icon">
                        <i class="fa fa-home"></i>
                    </x-slot>
                </x-aside-link>
                <x-aside-link :href="route('company.profile.create')" title="Profile">
                    <x-slot name="icon">
                        <i class="fa fa-user"></i>
                    </x-slot>
                </x-aside-link>
                @if (auth()->user()->companyVerified())
                <x-aside-link :href="route('company.wallet')" title="Wallet">
                    <x-slot name="icon">
                        <i class="fa fa-money"></i>
                    </x-slot>
                </x-aside-link>
                <x-aside-dropdown title="Route & Riders MGT" key="riders">
                    <x-slot name="icon">
                        <i class="fa fa-address-book"></i>
                    </x-slot>
                    <x-aside-dropdown-item :href="route('company.riders.create')" title="Riders" />
                    <x-aside-dropdown-item :href="route('company.route.create')" title="Route" />
                </x-aside-dropdown>
                <x-aside-dropdown title="Order Management" key="order">
                    <x-slot name="icon">
                        <i class="fa fa-address-book"></i>
                    </x-slot>
                    <x-aside-dropdown-item :href="route('company.daily.order')" title="Daily Orders" />
                    <x-aside-dropdown-item :href="route('company.daily.request')" title="Daily Requests" />
                    <x-aside-dropdown-item :href="route('company.previous.order')" title="Previous Orders" />

                </x-aside-dropdown>
                @endif
                @endcan

                @can('admin')
                <x-aside-dropdown title="Company Management" key="company">
                    <x-slot name="icon">
                        <i class="fa fa-address-book"></i>
                    </x-slot>
                    <x-aside-dropdown-item :href="route('admin.company.pending')" title="Pending" />
                    <x-aside-dropdown-item :href="route('admin.company.index')" title="Register" />
                </x-aside-dropdown>
                @endcan
                
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
