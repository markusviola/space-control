<div class="side-wrapper mb-3">
    <div class="card shadow-sm side-card neutral-round">
        <div class="text-center mt-3">
            <h5 class="alt-neutral">Submission Chat List</h5>
            <div class="text-muted">Talk with the person-in-charge!</div>
            <hr>
        </div>
        @foreach ($forms as $form)
            @if ($form->user_id == auth()->user()->id)
                <div class="container">
                    <a class="anti-neutral" href="">
                        <h6>
                        <strong>{{ $form->type->name }} Space</strong>
                        </h6>
                    </a>
                    <div class="text-muted">
                        Submitted on {{ $form->created_at }}
                    </div>
                    <hr>
                </div>
            @endif
        @endforeach
    </div>
</div>
