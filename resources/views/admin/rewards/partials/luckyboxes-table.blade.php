@forelse($luckyBoxes as $index => $box)
<tr>
  <td>{{ $luckyBoxes->firstItem() + $index }}</td>
  <td><strong>{{ $box->user->username ?? 'N/A' }}</strong></td>
  <td style="font-weight:700;color:#059669">${{ number_format($box->reward, 2) }}</td>
  <td>{{ $box->created_at->format('M d, Y H:i') }}</td>
  <td>
    <a href="{{ route('admin.lucky-boxes.edit', $box->id) }}" style="padding:6px 12px;background:#fef3c7;color:#92400e;border-radius:6px;text-decoration:none;font-size:12px;font-weight:600;margin-right:4px">✏️</a>
    <form action="{{ route('admin.lucky-boxes.destroy', $box->id) }}" method="POST" style="display:inline" onsubmit="return confirm('Delete this lucky box?')">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn-delete">🗑️</button>
    </form>
  </td>
</tr>
@empty
<tr><td colspan="5" class="empty">No lucky box rewards found</td></tr>
@endforelse
