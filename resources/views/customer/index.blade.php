@extends('layouts.app')

@section('title', 'Customer')


@section('content')
    @if(session('unauthenticated'))
        <div class="p-4 mb-4 text-sm text-white rounded-lg bg-red-600" role="alert">
            <span class="font-medium">{{ session('unauthenticated') }}</span>
        </div>
    @endif
    <h1 class="uppercase mb-10">customers dashboard</h1>



@php
    $enquetes = [];
@endphp

@foreach($qtsEnquetes as $enquete)
    @if (!in_array($enquete->enquete->id, $enquetes))
        @php
            array_push($enquetes, $enquete->enquete->id);
        @endphp
        <div class="flex items-center space-x-2">
            <p class="text-3xl">{{$enquete->enquete->id}}:</p>
            <p class="text-3xl">{{$enquete->enquete->title}}</p>
        </div>
        @foreach($qtsEnquetes as $qtsEnquete)
            @if ($qtsEnquete->enquete->id === $enquete->enquete->id)
                    <p>{{$qtsEnquete->question->question}}</p>
            @endif
        @endforeach
    @endif
@endforeach



@endsection