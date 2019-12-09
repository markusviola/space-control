@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card shadow neutral-round">
                <div class="card-body">
                    <div class="text-center">
                        <h4 class="alt-neutral">スペース予約管理</h4>
                        <span class="text-dark">予約者の要求フォームを管理しましょう</span>
                    </div>
                    <ul class="nav nav-tabs mt-3">
                        <li class="nav-item">
                            <h5>
                                <a
                                    class="nav-link {{ !$isReserveList ? 'active' : '' }}"
                                    href="{{ route('forms.index') }}"
                                >要求リスト
                                </a>
                            </h5>
                        </li>
                        <li class="nav-item">
                            <h5>
                                <a
                                    class="nav-link {{ $isReserveList ? 'active' : '' }}"
                                    href="#"
                                >承認リスト
                                </a>
                            </h5>
                        </li>
                    </ul>
                    @if ($isReserveList)
                        {{-- @include('admin.reservations') --}}
                    @else
                        @include('admin.requests')
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
