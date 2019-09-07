<ul class="nav justify-content-between mt-2">
    @foreach ($types as $type)
        <li class="nav-item">
            <a
                class="nav-link {{ $type->id == $typeId ? 'disabled' : '' }}"
                href="{{ route('manager',['type' => $type->id]) }}"
            >{{ $type->name }}</a>
        </li>
    @endforeach
</ul>
<hr class="my-0">
<div class="formlist-column">
    @if (sizeof($approvedForms) > 0)
        <reservation-list
            :type_id="{{ $typeId }}"
            :approved_forms="{{ $approvedForms }}"
            :types="{{ $types }}"
            :spaces="{{ $spaces }}"
            :discoveries="{{ $discoveries }}"
            :statuses="{{ $statuses }}"
        ></reservation-list>
    @else
        <div class="text-muted text-center mt-4 mb-4">
            No reservations yet.
        </div>
    @endif
</div>
<hr class="mt-0 mb-3">
<div class="text-center font-weight-bold">
    <a class="anti-neutral" href="{{ route('payment.records') }}">See Payment Transaction Records</a>
</div>
