@extends('layouts.app')

@section('content')
<div class="container">
    <chats
        :user="{{ auth()->user() }}"
        :choice="{{ $chosenForm ?? 0 }}"
        :spaces={{ $spaces }}
    ></chats>
</div>
@endsection
