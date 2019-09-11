@extends('layouts.app')

@section('content')
<div class="container">
    @if (Auth::check() && !Auth::user()->is_admin)
        @include('user.submissions')
    @endif
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card shadow neutral-round">
                <div class="card-body">
                    <div class="text-center">
                        @if (Auth::check())
                            @if (Auth::user()->is_admin)
                                <h4 class="alt-neutral">
                                    予約 {{ $isReserveList ? '管理' : '要求' }}
                                </h4>
                                <h5 class="text-muted">管理者モード</h5>
                            @else
                                <h4 class="alt-neutral">予約フォーム</h4>
                                <h5 class="text-muted">ユーザーモード</h5>
                            @endif
                        @else
                            <h4 class="alt-neutral">予約フォーム</h4>
                            <h5 class="text-muted">ゲストモード</h5>
                        @endif
                    </div>
                    @if (Auth::check() && Auth::user()->is_admin)
                        <ul class="nav nav-tabs mt-3">
                            <li class="nav-item">
                                <h5><a
                                    class="nav-link {{ !$isReserveList ? 'active' : '' }}"
                                    href="{{ route('home') }}"
                                >要求</a></h5>
                            </li>
                            <li class="nav-item">
                                <h5><a
                                    class="nav-link {{ $isReserveList ? 'active' : '' }}"
                                    href="{{ route('manager', ['type' => '1']) }}"
                                >予約</a></h5>
                            </li>
                        </ul>
                        @if ($isReserveList)
                            @include('admin.reservations')
                        @else
                            @include('admin.requests')
                        @endif
                    @else
                        <hr class="mb-0">
                        <form class="pt-4" action="{{ route('forms.store') }}" method="POST">
                            @csrf
                            @if (Auth::check())
                                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            @else
                                @include('form.guest')
                            @endif
                            <space-form
                                :types="{{ $types }}"
                                :spaces="{{ $spaces }}"
                            ></space-form>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
