@extends('layouts.app')

@section('title', 'Customer')


@section('content')
    @if(session('unauthenticated'))
        <div class="p-4 mb-4 text-sm text-white rounded-lg bg-red-600" role="alert">
            <span class="font-medium">{{ session('unauthenticated') }}</span>
        </div>
    @endif
<h1 class="uppercase">customers dashboard</h1>
@endsection