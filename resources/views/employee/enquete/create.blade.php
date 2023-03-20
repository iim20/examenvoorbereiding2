<!-- resources/views/survey/create.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="flex justify-center items-center flex-col">
        <h1>Create Survey</h1>

        <form method="POST" action="{{ route('employee.store') }}">
            @csrf

            <div class="mb-6">
                <label class="block mb-2 text-sm font-medium text-gray-900" for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control">
            </div>

            <div class="mb-6">
            <label for="category_id" class="block mb-2 text-sm font-medium text-gray-900">Category</label>
            <select class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5" name="category_id" id="category_id">
                @foreach(\App\Models\Category::all() as $category)
                    <option 
                    value="{{ $category->id }}"
                    {{ old('category_id') == $category->id ? 'selected' : ''}}> 
                    {{ ucwords($category->name) }}
                    </option>
                @endforeach
            </select>
          </div>

          <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>

        </form>
    </div>




@endsection
