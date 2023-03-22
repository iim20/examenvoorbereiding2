@extends('layouts.app')

@section('title', 'Customer')


@section('content')

<form action="{{ route('customer.submitAnswer', ['enquete_id' => $enquete->id, 'question_id' => $question->id]) }}" method="POST">
    @csrf
    <div class="flex justify-center items-center mx-auto flex-col space-y-5 w-64 mt-32">

        <label class="text-2xl" for="answer">{{ $question->question }}</label>
        <select id="answer" name="answer" required>
            <option class="w-64" value="">Select an answer</option>
            @foreach($question->answers as $answer)
            <option value="{{ $answer->id }}">{{ $answer->option }}</option>
            @endforeach
        </select>
        <button class="w-64 h-10 mt-10 shadow-sm bg-blue-500 text-white focus:ring-blue-500 focus:border-blue-500 block  sm:text-sm border-gray-300 rounded-md" type="submit">Submit answer</button>
    </div>

</form>


@endsection