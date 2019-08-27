<div class="side-wrapper mb-2">
    <div class="card shadow-sm side-card neutral-round">
        <div class="text-center mt-3">
            <h5 class="alt-neutral">Submission Chat List</h5>
            <div class="text-muted">Talk with the person-in-charge!</div>
            <hr>
        </div>
        <div class="container mb-0 side-list">
            @if (sizeof($forms) > 0)
                @foreach ($forms as $form)
                    @if ($form->user_id == auth()->user()->id)
                        <a class="anti-neutral" href="{{ route('messenger', $form->id)}}">
                            <h6>
                            <strong>{{ $form->type->name }} Space</strong>
                            </h6>
                        </a>
                        <div class="text-muted">
                            Submitted on {{ $form->created_at }}
                        </div>
                        <hr>
                    @endif
                @endforeach
            @else
                <div class="text-muted text-center mt-4 mb-4">
                    No reservations submitted yet.
                </div>
            @endif
        </div>
        <hr class="mt-0">
    </div>
</div>
