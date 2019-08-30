<div class="formlist-column">
    @if (sizeof($forms) > 0)
        @foreach ($forms as $form)
            <div class="container py-3 panel-highlight" onclick="toMessenger({!! json_encode($form->id) !!})" >
                <div class="row">
                    <div class="col-md-8 alt-anti-neutral">
                        <h4>
                            @if ($form->is_approved)
                                <strong class="text-admin">Approved ></strong>
                            @else
                                <strong>Pending ></strong>
                            @endif
                           {{ $form->type->name }}
                        </h4>
                    </div>
                    <div class="col-md-4 d-flex justify-content-end text-muted">
                        Sender | {{ $form->name }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 ">
                        @if ($form->user_id == 0)
                           <div class="text-danger">
                               <strong>Guest</strong>
                            </div>
                        @else
                            <div class="text-primary">
                                <strong>Registered</strong>
                            </div>
                        @endif
                    </div>
                    <div class="col-md-6 d-flex justify-content-end text-muted">
                        {{ $form->created_at }}
                    </div>
                </div>
            </div>
            <hr class="m-0 p-0">
        @endforeach
    @else
        <div class="text-muted text-center mt-4 mb-4">
            No reservation requests yet.
        </div>
    @endif
</div>
<hr class="mt-0">
