<!-- resources/views/survey/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Survey</h1>

        <form method="POST" action="{{ route('employee.store') }}">
            @csrf

            <div class="mb-6">
                <label class="block mb-2 text-sm font-medium text-gray-900" for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control">
            </div>

            <div class="mb-6">
            <label for="category_id" class="block mb-2 text-sm font-medium text-gray-900">Category</label>
            <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5" name="category_id" id="category_id">
                @foreach(\App\Models\Category::all() as $category)
                    <option 
                    value="{{ $category->id }}"
                    {{ old('category_id') == $category->id ? 'selected' : ''}}> 
                    {{ ucwords($category->name) }}
                    </option>
                @endforeach
            </select>
          </div>
            <div id="questions">
                <div class="question">
                    <label class="block mb-2 text-sm font-medium text-gray-900" for="question_1">Question 1:</label>
                    <input type="text" name="questions[]" id="question_1" required>

                    <div class="answers">
                        <label class="block mb-2 text-sm font-medium text-gray-900">Answers:</label>
                        <input class="block mb-2 text-sm font-medium text-gray-900" type="text" name="answers[][1]" required>
                        <input class="block mb-2 text-sm font-medium text-gray-900" type="text" name="answers[][2]" required>
                    </div>
                </div>
            </div>


            <div class="form-group mt-6">
                <button type="button" id="add-question" class="btn btn-primary text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Add Question</button>
                <button type="submit" class="btn btn-success text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Save Survey</button>
            </div>
        </form>
    </div>




@endsection
