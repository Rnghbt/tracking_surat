@extends('layouts.app')

@section('content')
    <div class="text-center">
        <div class="alert alert-{{ $color }} fw-bold text-{{ $color }} h1">{{ $text }}</div>
        <a href="/" class="link">Go Back</a>
    </div>
@endsection
