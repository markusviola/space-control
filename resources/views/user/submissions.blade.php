<div class="side-wrapper mb-2">
    <div class="card shadow-sm side-card neutral-round">
        <div class="text-center mt-3">
            <h5 class="alt-neutral">Submission Chat List</h5>
            <div class="text-muted">Talk with the person-in-charge!</div>
            <hr>
        </div>
        <div class="container mb-3">
            @if (sizeof($formsByUser) > 0)
                @foreach ($formsByUser as $form)
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
    </div>
</div>
