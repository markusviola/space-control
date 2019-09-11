<div class="formlist-column">
    @if (sizeof($forms) > 0)
        @foreach ($forms as $form)
            <div class="container py-3 panel-highlight" onclick="toMessenger({!! json_encode($form->id) !!})" >
                <div class="row">
                    <div class="col-md-8 alt-anti-neutral">
                        <h5>
                            @if ($form->is_approved)
                                <strong class="text-admin">承認 ></strong>
                            @else
                                <strong>未決 ></strong>
                            @endif
                           {{ $form->type->name }}
                        </h5>
                    </div>
                    <div class="col-md-4 d-flex justify-content-end text-muted">
                        顧客名 {{ $form->name }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 ">
                        @if ($form->user_id == 0)
                           <div class="text-danger">
                               <strong>ゲスト</strong>
                            </div>
                        @else
                            <div class="text-primary">
                                <strong>ユーザー</strong>
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
            何も予約要求は提出されていません。
        </div>
    @endif
</div>
<hr class="mt-0">
