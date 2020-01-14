@extends('layouts.dashboard')
@section('content')
<div id="dashboard">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif


<!-- DESIGN HERE -->
<performs idclub="{{$idclub}}" fechai="{{$fechai}}" fechaf="{{$fechaf}}"></performs>

</div>
@endsection