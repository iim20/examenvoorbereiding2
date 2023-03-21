
@extends('layouts.app')
@section('title', 'Questions')


@section('content')
    <div class="max-w-7xl mx-auto mt-20 ml-24">
        <div class="flex justify-between">

            <h1 class="text-2xl mb-4">Koppel enquete aan question</h1>
            <button id="addAnswer" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Add answer</button>
        </div>


        <form id="addQna" method="POST" enctype="multipart/form-data" action="{{ route('employee.enquetequestion.store')}}">
            @csrf

            <!--<input type="hidden" name="question_id" value="12">-->
            <input type="hidden" name="question_id" value="{{ $question_id->id }}">




            

            <div id="qna-container">

   

             <div class="mb-6">
                    <label for="enquete_id" class="block mb-2 text-sm font-medium text-gray-900">Enquete</label>
                    <select class="bg-gray-50 border border-gray-300 w-64 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5" name="enquete_id" id="enquete_id">
                        @foreach(\App\Models\Enquete::all() as $enquete)
                            <option 
                            value="{{ $enquete->id }}"
                            {{ old('enquete_id') == $enquete->id ? 'selected' : ''}}> 
                            {{ ucwords($enquete->title) }}
                            </option>
                        @endforeach
                    </select>
                </div>
            
  
            
            </div>
            


          <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>

        </form>
    </div>





@endsection
