@if($luckyBoxes->hasPages())
@php
  $params = request()->except('luckyboxes_page');
@endphp
@if($luckyBoxes->onFirstPage())
  <span style="padding:8px 12px;background:#f3f4f6;color:#cbd5e1;border-radius:6px;margin:0 2px">←</span>
@else
  <a href="#" data-page="{{ $luckyBoxes->currentPage() - 1 }}" data-type="luckyboxes" class="pagination-link" style="padding:8px 12px;background:#f3f4f6;color:#6b7280;border-radius:6px;margin:0 2px;text-decoration:none">←</a>
@endif
@for($i = 1; $i <= $luckyBoxes->lastPage(); $i++)
  @if($i == $luckyBoxes->currentPage())
    <span style="padding:8px 12px;background:#667eea;color:#fff;border-radius:6px;margin:0 2px">{{ $i }}</span>
  @else
    <a href="#" data-page="{{ $i }}" data-type="luckyboxes" class="pagination-link" style="padding:8px 12px;background:#f3f4f6;color:#6b7280;border-radius:6px;margin:0 2px;text-decoration:none">{{ $i }}</a>
  @endif
@endfor
@if($luckyBoxes->hasMorePages())
  <a href="#" data-page="{{ $luckyBoxes->currentPage() + 1 }}" data-type="luckyboxes" class="pagination-link" style="padding:8px 12px;background:#f3f4f6;color:#6b7280;border-radius:6px;margin:0 2px;text-decoration:none">→</a>
@else
  <span style="padding:8px 12px;background:#f3f4f6;color:#cbd5e1;border-radius:6px;margin:0 2px">→</span>
@endif
@endif
