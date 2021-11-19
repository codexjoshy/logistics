@canany(['admin', 'super admin'])
<x-aside-dropdown title="App Settings" key="settings">
    <x-slot name="icon">
        <i class="fa fa-address-book"></i>
    </x-slot>
    <x-aside-dropdown-item :href="route('admin.option.price')" title="Prices" />
    {{-- <x-aside-dropdown-item :href="route('options.index')" title="App Options" /> --}}
</x-aside-dropdown>
<x-aside-dropdown title="Company Management" key="company">
    <x-slot name="icon">
        <i class="fa fa-address-book"></i>
    </x-slot>
    <x-aside-dropdown-item :href="route('admin.company.pending')" title="Pending" />
    <x-aside-dropdown-item :href="route('admin.company.index')" title="Register" />
</x-aside-dropdown>
@endcanany

