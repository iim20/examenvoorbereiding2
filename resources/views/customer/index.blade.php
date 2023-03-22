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



<!-- Hier is test data om te laten zien -->


<div class="my-4 flex justify-end">

    <a class="capitalize px-8 font-medium leading-6 w-64 py-2 rounded-lg bg-blue-600 text-white" href="/customer/create">Beantwoord enquete</a>
</div>
<table class="w-full text-sm text-left text-gray-500 border-2 border-t dark:text-gray-400 mt-10">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-2 border-t dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="p-4">ID</th>
                    <th scope="col" class="px-6 py-3">
                        Vraag
                    </th>
                 
                    <th scope="col"></th>

                </tr>
            </thead>
            <tbody>
                @foreach($questions as $vraagtitle)

                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td scope="row" class="px-6 py-4  whitespace-nowrap w-32 dark:text-white">
                            {{ $loop->iteration}}
                        </td>
                        <td class="px-6 py-4">
                           <a href="{{ route('employee.question.edit', $vraagtitle->id) }}">{{ $vraagtitle->question }}</a>
                        </td> 
                      <td>
                          <a href="{{ route('employee.enquetequestion.create', ['question_id' => $vraagtitle->id]) }}" class="ansButton block cursor-pointer text-blue-700 text-sm">Voeg enquete</a>
                        </td>
                          
                        <td scope="row">
                            <!--Antwoorden pop up modal-->



                            <!-- Modal toggle -->
                            <a type="button" data-modal-target="staticModal" data-modal-toggle="staticModal" data-id="{{ $vraagtitle->id }}" class="ansButton block cursor-pointer text-blue-700 text-sm">
                              Antwoorden</a>

                            <!-- Main modal -->
                            <div id="staticModal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true" class="fixed !top-[-150px] left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] md:h-full">
                                <div class="relative w-full h-full max-w-2xl md:h-auto">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <!-- Modal header -->
                                        <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                                           
                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="staticModal">
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>  
                                            </button>
                                        </div>
                                        <!-- Modal body -->
                                        <table class="w-full text-sm text-left text-gray-500 border-2 border-t dark:text-gray-400">
                                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-2 border-t dark:bg-gray-700 dark:text-gray-400">
                                                <tr>
                                                    <th scope="col" class="px-6 py-3">Antwoord</th>
                                                </tr>
                                            </thead>
                                            <tbody class="showAnswers">

                                              
                                            </tbody>
                                        </table> 
                                       
                                    </div>
                                </div>
                            </div>

                            <!-- end pop up -->

                        </td>
                      

                    </tr>
                @endforeach
                <span class="error text-red-600"></span>
            
            </tbody>
        </table> 


    <script>
        $(document).ready(function(){

           // Show answers code

           $(".ansButton").click(function(){

                var questions = @json($questions);
                var qid = $(this).attr('data-id');

                var html = '';

                for (let i = 0; i < questions.length; i++) {
                    if(questions[i]['id'] == qid)
                    {
                        var answersLength = questions[i]['answers'].length;
                        for (let j = 0; j < answersLength; j++) {
                           
                            html += `
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td class="px-6 py-4">`+questions[i]['answers'][j]['option']+`</td> 
                                </tr>

                            `;
                        }
                        break;
                    }
                }

                $('.showAnswers').html(html);
            });

        


            
        });

    </script>



@endsection