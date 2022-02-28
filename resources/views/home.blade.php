@extends('layouts.app')

@section('content')

<h1>Home</h1>
<div>
    <a href="{{ "/download/03?token=$token" }}" download>Download</a>
</div>
@endsection

@section('inline_js')
    @parent
@endsection