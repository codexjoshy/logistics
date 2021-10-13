


@canany(['admin', 'super admin'])
<x-aside-dropdown title="App Settings" key="settings">
    <x-slot name="icon">
        <i class="fa fa-address-book"></i>
    </x-slot>
    <x-aside-dropdown-item :href="route('options.fees')" title="Fees" />
    <x-aside-dropdown-item :href="route('options.index')" title="App Options" />
</x-aside-dropdown>
@endcanany

