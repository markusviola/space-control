@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12 col-md-8">
            <div class="card shadow neutral-round">
                <div class="card-body">
                    <div class="text-center">
                        <h4 class="alt-neutral">あなたの場所投稿リスト</h4>
                        <span class="text-dark">お客様にあなたの場所を知らせましょう！</span>
                    </div>
                    <space-post-list :user="{{ $user }}"></space-post-list>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
