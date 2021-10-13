@props(['title', 'amount', 'span' => 1,])

<tr>
    <td class="text-right pb-0" colspan="{{ $span }}">
        <div class="text-uppercase small font-weight-700 text-muted">{{ $title }}:</div>
    </td>
    <td class="text-right pb-0">
        <div {{ $attributes->merge(['class' => 'h5 mb-0 font-weight-700']) }}>
            {{ toNaira($amount) }}
        </div>
    </td>
</tr>
