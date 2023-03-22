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
                    Enquete
                </th>
             
                <th scope="col">Category</th>
                <th scope="col">Beantwoord</th>

            </tr>
        </thead>
        <tbody>
            @foreach($enquetes as $enquete)




            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td scope="row" class="px-6 py-4  whitespace-nowrap w-32 dark:text-white">
                    {{$loop->iteration }}
                </td>
                
                <td scope="row" class="px-6 py-4">
                    {{ $enquete->title }}
                </td>
                  
                <td scope="row" class="px-6 py-4">
                    {{ $enquete->category->name }}
                </td>

                <td scope="row" class="px-6 py-4">
                <a href="{{ route('customer.enquetequestion', ['enquete_id' => $enquete->id]) }}">
                        <svg class="w-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"></path>
                        </svg>
                    </a>
                </td>


                
            </tr>

            @endforeach

        
        </tbody>
    </table> 



    <!---Ingevuld-->

    <h1 class="uppercase mt-32 mb-10">Ingevuld dashboard</h1>

        <table class="w-full text-sm text-left text-gray-500 border-2 border-t dark:text-gray-400 mt-10">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-2 border-t dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="p-4">ID</th>
                <th scope="col" class="px-6 py-3">
                    Questions
                </th>
         
                <th scope="col">Answers</th>

            </tr>
        </thead>
        <tbody>



@foreach($answers as $answer)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <td scope="row" class="px-6 py-4  whitespace-nowrap w-32 dark:text-white">
                {{ $loop->iteration }}
                </td>
                
                <td scope="row" class="px-6 py-4">
                    {{ $answer->question->question }}
                </td>
                  
            

                <td scope="row" class="px-6 py-4">
                    {{ $answer->option}}
                </td>
              

            </tr>

            @endforeach


        
        </tbody>
    </table> 





@endsection