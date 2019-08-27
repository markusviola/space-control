@extends('layouts.app')

@section('content')
<div class="container">
    <chats :user="{{ auth()->user() }}" :chosenForm="{{ $chosenForm ?? 0 }}"></chats>
</div>
@endsection
