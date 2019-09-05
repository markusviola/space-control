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
        @foreach ($approvedForms as $form)
            <reservation-item
                :type_id="{{ $typeId }}"
                :form="{{ $form }}"
                :types="{{ $types }}"
                :spaces="{{ $spaces }}"
                :discoveries="{{ $discoveries }}"
                :statuses="{{ $statuses }}"
            ></reservation-item>
            <div class="container py-3 panel-highlight" data-toggle="modal" data-target="#reservation-item{{ $form->reservation->id }}">
                <div class="row">
                    <div class="col-md-8 alt-neutral">
                        <h5>
                            <strong class="text-secondary">{{ $form->reservation->status->name }} ></strong>
                            Reservation #{{ $form->reservation->id }}
                        </h5>
                    </div>
                    <div class="col-md-4 d-flex justify-content-end text-muted">
                        Client | {{ $form->name }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-muted">
                        Initial Reservation Date: {{ $form->schedules[0]->getStartDate() }}
                    </div>
                </div>
            </div>
            <hr class="m-0 p-0">
        @endforeach
    @else
        <div class="text-muted text-center mt-4 mb-4">
            No reservations yet.
        </div>
    @endif
</div>
<hr class="mt-0">
