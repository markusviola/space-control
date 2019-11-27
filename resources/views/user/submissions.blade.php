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
                    <div class="formlist-column">
                        @if (sizeof($forms) > 0)
                            @foreach ($forms as $form)
                                <div class="container py-3 panel-highlight" onclick="toMessenger({!! json_encode($form->id) !!})" >
                                    <div class="row">
                                        <h6>
                                            <strong>{{ $form->post->title }}</strong>
                                        </h6>
                                        <div class="text-muted">
                                            提出日 {{ $form->created_at }}
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
