@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card shadow neutral-round">
                <div class="card-body">
                    <div class="text-center">
                        <h5 class="alt-neutral">Reservation Form</h5>
                        @if (Auth::check())
                            User Mode
                        @else
                            Guest Mode
                        @endif
                    </div>
                    <hr>
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
