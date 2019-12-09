@extends('layouts.dashboard')
@section('content')
<div id="dashboard">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif

<character-add></character-add>

@endsection