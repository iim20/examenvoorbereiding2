@extends('layouts.app')

@section('title', 'Customer')


@section('content')
    @if(session('unauthenticated'))
        <div class="p-4 mb-4 text-sm text-white rounded-lg bg-red-600" role="alert">
            <span class="font-medium">{{ session('unauthenticated') }}</span>
        </div>
    @endif
    <h1 class="uppercase mb-10">customers dashboard</h1>








    <table class="w-full text-sm text-left text-gray-500 border-2 border-t dark:text-gray-400 mt-10">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-2 border-t dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="p-4">ID</th>
                <th scope="col" class="px-6 py-3">
                    Questions
                </th>
         
                <th scope="col">Beantwoord</th>

            </tr>
        </thead>
        <tbody>
            @foreach($questions as $qtsEnquete)




            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td scope="row" class="px-6 py-4  whitespace-nowrap w-32 dark:text-white">
                    {{ $loop->iteration }}
                </td>
                
                <td scope="row" class="px-6 py-4">
                    {{ $qtsEnquete->question->question }}
                </td>
                  
            

                <td scope="row" class="px-6 py-4">
            @if ($qtsEnquete->question->answers->where('user_id', Auth::user()->id)->count() > 0)
                Antwoord gegeven
            @else
                <a class="text-blue-600" href="{{ route('customer.showAnswerForm', ['enquete_id' => $enquete->id, 'question_id' => $qtsEnquete->question->id]) }}">
                    Beantwoorden
                </a>
            @endif
        </td>
              

            </tr>

            @endforeach

        
        </tbody>
    </table> 






@endsection