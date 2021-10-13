@props(['title', 'amount'])

<tr class="border-bottom">
    <td>
        <div class="font-weight-bold">{{ $title }}</div>
        {{ $slot }}
    </td>
    <td class="text-right font-weight-bold">{{ toNaira($amount) }}</td>
</tr>
