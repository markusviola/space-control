@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12 col-md-8">
            <div class="card shadow neutral-round">
                <div class="card-body">
                    <div class="text-center">
                        <h4 class="alt-neutral">支払い記録</h4>
                        <span class="text-dark">ビジネスがどうなっているのかを監視しよう！</span>
                    </div>
                    <payment-records :types="{{ $types }}"></payment-records>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
