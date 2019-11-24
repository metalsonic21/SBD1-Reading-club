@extends('layouts.dashboard')

@section('content')
<div id="dashboard">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif


<!-- DESIGN HERE -->

<popular-books></popular-books>
<last-discussed></last-discussed>
<active-presentations></active-presentations>
</div>
@endsection
