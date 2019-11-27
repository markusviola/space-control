@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card shadow neutral-round">
                <div class="card-body">
                    <div class="text-center">
                        <h4 class="alt-neutral">提出フォームリスト</h4>
                        <span class="text-dark">管理者に問い合わせよう！</span>
                    </div>
                    <hr class="mb-0">
                    <div class="formlist-column">
                        @if (sizeof($forms) > 0)
                            @foreach ($forms as $form)
                                <div class="container py-3 panel-highlight" onclick="toMessenger({!! json_encode($form->id) !!})" >
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="text-secondary font-weight-bold mb-0">
                                                {{ $form->post->title }}
                                            </h6>
                                        </div>
                                        <div class="text-muted">
                                            提出日 {{ $form->created_at }}
                                        </div>
                                    </div>
                                </div>
                                <hr class="m-0 p-0">
                            @endforeach
                        @else
                            <div class="text-muted text-center mt-4 mb-4">
                                何も予約フォームは提出されていません。
                            </div>
                        @endif
                    </div>
                    <hr class="mt-0">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
