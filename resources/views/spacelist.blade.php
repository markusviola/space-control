@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12 col-md-8">
            <div class="card shadow neutral-round">
                <div class="card-body">
                    <div class="text-center">
                        <h4 class="alt-neutral">予約スペースリスト</h4>
                        <span class="text-dark">空き場所を探して予約しよう！</span>
                    </div>
                    {{-- <space-reservation-list :posts="{{ $posts }}"></space-reservation-list> --}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
