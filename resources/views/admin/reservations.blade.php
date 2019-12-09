
<hr class="my-0">
<div class="formlist-column">
    @if (sizeof($approvedForms) > 0)
        <reservation-list
            :approved_forms="{{ $approvedForms }}"
            :statuses="{{ $statuses }}"
        ></reservation-list>
    @else
        <div class="text-muted text-center mt-4 mb-4">
            何も予約要求は承認されていません。
        </div>
    @endif
</div>
<hr class="mt-0 mb-3">
<div class="text-center font-weight-bold">
    <a class="anti-neutral" href="{{ route('payment.records') }}">
        <h5 class="m-0">支払い記録を見る</h5>
    </a>
</div>
