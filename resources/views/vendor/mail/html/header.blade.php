<tr>
<td class="header">
<a href="{{ url('/') }}" style="display: inline-block;">
@if (trim($slot) === 'LockdownClerk')
<img src="{{ asset('white/img/logo_group.png') }}" class="logo" alt="LockdownClerk Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
