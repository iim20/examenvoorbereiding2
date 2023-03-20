@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto py-12 sm:px-6 lg:px-8">
        <div class="bg-white shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <form action="{{ route('employee.update', $enquete->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    

                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                        <div class="mt-1">
                            <input type="text" name="title" id="title" value="{{ old('title', $enquete->title) }}" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md">
                        </div>
                        @error('title')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-6">
                        <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                        <select id="category_id" name="category_id" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            @foreach(\App\Models\Category::all() as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $enquete->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div id="questions" class="mt-6">
                      @foreach($enquete->questions as $index => $question)
                        <div class="question">
                          <label for="question{{ $index }}" class="block text-sm font-medium text-gray-700">Question {{ $index + 1 }}</label>
                          <input type="text" name="questions[{{ $index }}][question]" id="question{{ $index }}" value="{{ old('questions.' . $index . '.' . $question . '.question', $question->question) }}" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md">

                          <input type="hidden" name="questions[{{ $index }}][id]" value="{{ $question->id }}">

                          <div class="mt-2">
                            <label for="answers{{ $index }}" class="block text-sm font-medium text-gray-700">Answers:</label>
                            <div id="answers{{ $index }}">
                              @foreach($question->answers as $answerIndex => $answer)
                                <div class="flex items-center mt-1">
                                  <input type="text" name="answers[{{ $index }}][{{ $answerIndex }}][answer]" value="{{ old('answers.' . $index . '.' . $answerIndex . '.answer', $answer->answer) }}" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                  <input type="hidden" name="answers[{{ $index }}][{{ $answerIndex }}][id]" value="{{ $answer->id }}">
                                  <button type="button" class="ml-2 text-sm font-medium text-gray-400 focus:outline-none remove-answer-btn">&times;</button>
                                </div>
                              @endforeach
                              <button type="button" class="mt-1 text-sm font-medium text-gray-400 focus:outline-none add-answer-btn">Add Answer</button>
                            </div>
                          </div>
                        </div>
                      @endforeach
                    </div>


                    <div class="flex items-center justify-end mt-6">
                        <button type="submit" class="px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    
@endsection
