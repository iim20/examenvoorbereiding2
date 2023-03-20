@extends('layouts.app')
@section('title', 'Questions')


@section('content')
    <div class="max-w-4xl mx-auto py-12 sm:px-6 lg:px-8">
        <div class="bg-white shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <div class="flex justify-end">

                    <button id="editAnswer" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Add answer</button>
                </div>

                <form id="editQna" action="{{ route('employee.question.update', $question->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="question_id" id="question_id">

                    <div id="editAnswerBody">
                        <div class="mb-6">
                            <label class="block mb-2 text-sm font-medium text-gray-900" for="question">Title</label>
                            <input type="text" name="question" id="question" class="form-control shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md" value="{{ old('question', $question->question) }}" >
                        </div>

                  


                  
                        <!-- Answers -->
                    
                
                        
                        <span class="error text-red-600"></span>
                    
                    </div>
                        


                      
                      <div class="flex items-baseline justify-end mt-6 space-x-4">
                     


                        <button type="submit" data-id="{{ $question->id }}"  class="editBtn px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                            Update
                        </button>
                    </form>
                    
                    <form onsubmit="return confirm('Weet u zeker dat wilt u enquete verwijderen?')" action="{{ route('employee.question.destroy', $question) }}" method="POST">
                        <button type="submit" class="px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-900 focus:outline-none focus:border-red-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">Delete</a>
                        @csrf
                        @method('DELETE')    
                    </form>
                </div>
            </div>
        </div>
    </div>

   
    
@endsection
