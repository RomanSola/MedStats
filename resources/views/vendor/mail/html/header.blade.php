@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="{{asset('assets/img/logo-san-felipe.png')}}" class="logo" alt="San Felipe Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
