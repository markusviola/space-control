@if (sizeof($forms) > 0)
    @foreach ($forms as $form)
        <div class="container py-0">
            <div class="row">
                <a class="col-md-8 anti-neutral" href="">
                    <h4>
                       <strong>Pending > </strong>
                       {{ $form->type->name }} Space
                    </h4>
                </a>
                <div class="col-md-4 d-flex justify-content-end text-muted">
                    Sender | {{ $form->name }}
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 ">
                    @if ($form->user_id == 0)
                       <div class="text-danger">
                           <strong>Guest User</strong>
                        </div>
                    @else
                        <div class="text-primary">
                            <strong>Registered User</strong>
                        </div>
                    @endif
                </div>
                <div class="col-md-6 d-flex justify-content-end text-muted">
                    {{ $form->created_at }}
                </div>
            </div>
        </div>
    @endforeach
@else
    <div class="text-muted text-center mt-4 mb-4">
        No reservation requests yet.
    </div>
@endif
