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
                                <h5 class="alt-neutral">Reservation Requests</h5>
                                <div class="text-muted">Administrator Mode</div>
                            @else
                                <h5 class="alt-neutral">Reservation Form</h5>
                                <div class="text-muted">User Mode</div>
                            @endif
                        @else
                            <h5 class="alt-neutral">Reservation Form</h5>
                            <div class="text-muted">Guest Mode</div>
                        @endif
                    </div>
                    <hr class="pb-3">
                    @if (Auth::check() && Auth::user()->is_admin)
                        @include('admin.requests')
                    @else
                        <form action="{{ route('forms.store') }}" method="POST">
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
