@extends('layouts.app')

@section('title', 'Employee')

@section('content')
    <div class="max-w-[77rem] mx-auto mt-10">
        @if(session('role'))
            <div class="p-4 mb-4 text-sm text-white rounded-lg bg-red-600" role="alert">
                <span class="font-medium">{{ session('role') }}</span>
            </div>
        @endif

        <div class="flex justify-between items-baseline">
            <div class="flex items-center">
                <div class="flex items-center">
                    <h1 class="text-4xl font-bold">Enquêtes</h1>
                    <div class="space-x-4 flex ml-10 font-bold">
                        <form method="GET" action="{{ route('employee.index') }}">
                            <input type="hidden" name="status_1">
                            <button class="p-4 bg-gray-200 w-36 text-center" type="submit">All</button>
                        </form>
                       <form method="GET" action="{{ route('employee.index') }}">
                            <input type="hidden" name="status_2" value="open">
                            <button class="p-4 bg-gray-200 w-36 text-center" type="submit">Beschikbaar</button>
                        </form>
                        <form method="GET" action="{{ route('employee.index') }}">
                            <input type="hidden" name="status_3" value="ingevuld">
                            <button class="p-4 bg-gray-200 w-36 text-center" type="submit">Ingevuld</button>
                        </form>
                    </div>
                </div>
            </div>
            <a class="capitalize flex justify-between px-8 font-medium leading-6 w-44 py-2 rounded-lg bg-blue-600 text-white" href="/employee/enquete/create">
                <span>
                    <svg class="w-6" fill="none" stroke="white" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6"></path>
                    </svg>
                </span>
                <span>
                    enquete
                </span>
            </a>
        </div>

        <div class="w-full p-4 mt-10 bg-gray-200 rounded-sm">
            <div class="w-full">
                <div class="flex justify-between font-semibold uppercase">
                    <div class=" border-r-2 border-gray-300 w-[4%]">
                        <h1 class="ml-4">#</h1>
                    </div>
                    <div class="border-r-2 border-gray-300 w-[12%] ">
                        <h1 class="ml-4">title</h1>
                    </div>
                    <div class="border-r-2 border-gray-300 w-[12%]">
                        <h1>categorie</h1>
                    </div>
                    <div class="border-r-2 border-gray-300 w-[12%]">
                        <h1 class="ml-2">datum</h1>
                    </div>
                    <div class="border-r-2 border-gray-300 w-[20%];">
                        <h1>punten verkregen</h1>
                    </div>
                    <div class="border-r-2 border-gray-300 w-[20%];">
                        <h1>Voeg vragen</h1>
                    </div>
                    <div class="w-[12%]">
                        <a href="" class=""><h1>bekijken</h1></a>
                    </div>
                </div>

                <div class="font-semibold">
                    @foreach ($enquetes as $enquete)
                        <div class="row-content flex justify-between bg-white p-3 m-3" style="border-radius:3px;">
                            <div class="naam" style="width:10%;">
                                {{ $loop->iteration}}
                            </div>
                            <div class="naam" style="width:30%;">
                                {{ $enquete->title}}
                            </div>
                            <div class="categorie" style="width:40%;">
                                <p class="ml-4">{{ $enquete->category->name }}</p>
                            </div>
                            <div class="datum" style="width:40%;">
                                {{ $enquete->created_at->format('d/m/Y')}}
                            </div>
                            <div class="punten" style="width:50%;">
                                @if ($enquete->category->name == "Voeding")
                                    <p class="ml-4">150 punten</p>
                                @elseif ($enquete->category->name == "Gezondheid")
                                    <p class="ml-4">750 punten</p>
                                @elseif ($enquete->category->name == "Sport")
                                    <p class="ml-4">200 punten</p>
                                @else
                                    <p class="ml-4">500 punten</p>
                                @endif

                            </div>
                            
                            <div class="popupmodal" style="width:40%;">
                               <!-- Modal toggle -->
                                <a type="button" data-modal-target="staticModal" data-modal-toggle="staticModal" data-id="{{ $enquete->id }}" class="addQuestion block cursor-pointer text-blue-700 text-sm">
                                  Lijst van vragen</a>

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

                                                <div class="my-3 mx-4 space-y-2">
                                                      <table class="w-full text-sm text-left text-gray-500 border-2 border-t dark:text-gray-400">
                                                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 border-2 border-t dark:bg-gray-700 dark:text-gray-400">
                                                            <tr>
                                                                <th scope="col" class="p-4">#</th>
                                                                <th scope="col" class="px-6 py-3">Question</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="addBody">
                                                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                                                
                                                            @foreach(\App\Models\QtsEnquete::where('enquete_id', $enquete->id)->get() as $qtsEnquete)
                                                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                                                    <td class="px-6 py-4 whitespace-nowrap w-32">{{$loop->iteration}}</td>
                                                                    <td class="px-6 py-4">{{$qtsEnquete->question->question }}</td>
                                                                </tr>
                                                            @endforeach

                                                            </tr>
                                                        </tbody>
                                                        </table> 
                                                 
                                                 </div>
                                            
                                            <div class="flex justify-end p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                <button data-modal-hide="staticModal" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add vraag</button>
                                              
                                            </div>






                                           
                                        </div>
                                    </div>
                                </div>

                                <!-- end pop up -->
                                </div>

                            <div class="bekijken" style="width:14%;">
                                <a href="{{ route('employee.edit', $enquete->id) }}">
                                <svg class="w-6" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M12.75 15l3-3m0 0l-3-3m3 3h-7.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                  
                    
                </div>
            </div>
        </div>
        
    </div>

    <script>
        $(document).ready(function(){
            // Add question to enquete

            $(".addQuestion").click(function(){

                var id = $(this).attr('data-id');
                $('#addEnqueteId').val(id);


                $.ajax({
                    type:"GET",
                    data:{enquete_id:id},
                    success:function(data)
                    {
                        if(data.success == true)
                        {
                            var questions = data.data;
                            var html = '';
                            if (questions.length > 0) {
                               for (let i = 0; i < questions.length; i++) {
                                html += `
                                    <tr>
                                        <td><input type="checkbox" value="`+questions[i]['id']+`" name="questions_ids[]"</td>
                                        <td>`+questions[i]['questions']+`</td>
                                    </tr>
                                       
                                `;
                                
                               }
                            } 
                            else{
                                html +=`
                                <tr colspan="2">Questions are not available!</td>
                                `;
                            }

                            $(".addBody").html(html);
                        }
                        
                        
                    }
    
                });
            });

            
            

        });


        
    </script>
@endsection