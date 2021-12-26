
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
<x-aside-dropdown title="Riders & Route MGT" key="riders">
    <x-slot name="icon">
        <i class="fa fa-address-book"></i>
    </x-slot>
    <x-aside-dropdown-item :href="route('company.riders.create')" title="Riders" />
    <x-aside-dropdown-item :href="route('company.route.create')" title="Route" />
</x-aside-dropdown>
<x-aside-link :href="route('company.daily.pool')" title="Pool Request">
    <x-slot name="icon">
        <i class="fa fa-comment"></i>
    </x-slot>
</x-aside-link>
<x-aside-dropdown title="Order Management" key="order">
    <x-slot name="icon">
        <i class="fa fa-address-book"></i>
    </x-slot>
    <x-aside-dropdown-item :href="route('company.daily.request')" title="Daily Request" />
    <x-aside-dropdown-item :href="route('company.daily.order')" title="Daily Orders" />
    <x-aside-dropdown-item :href="route('company.previous.order')" title="Previous Orders" />
</x-aside-dropdown>
@endif