@forelse($checkins as $index => $checkin)
<tr>
  <td>{{ $checkins->firstItem() + $index }}</td>
  <td><strong>{{ $checkin->user->username ?? 'N/A' }}</strong></td>
  <td><span class="badge pending">Day {{ $checkin->day }}</span></td>
  <td style="font-weight:700;color:#059669">${{ number_format($checkin->reward, 2) }}</td>
  <td>{{ $checkin->created_at->format('M d, Y H:i') }}</td>
  <td>
    <a href="{{ route('admin.checkins.edit', $checkin->id) }}" style="padding:6px 12px;background:#fef3c7;color:#92400e;border-radius:6px;text-decoration:none;font-size:12px;font-weight:600;margin-right:4px">✏️</a>
    <form action="{{ route('admin.checkins.destroy', $checkin->id) }}" method="POST" style="display:inline" onsubmit="return confirm('Delete this check-in?')">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn-delete">🗑️</button>
    </form>
  </td>
</tr>
@empty
<tr><td colspan="6" class="empty">No check-ins found</td></tr>
@endforelse
