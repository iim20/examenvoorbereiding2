@extends('layouts.app')

@section('title', 'Employee create')

@section('content')
    <div class="max-w-[77rem] mx-auto mt-10">
    @if(session('unauthenticated'))
            <div class="p-4 mb-4 text-sm text-white rounded-lg bg-red-600" role="alert">
                <span class="font-medium">{{ session('unauthenticated') }}</span>
            </div>
        @endif
        <h1 class="uppercase">Employee creates enquetes</h1>
        <div class="mt-10">

        <form method="POST" action="{{ route('employee.store') }}">
          <div class="mb-6">
            <label for="title" class="block mb-2 text-sm font-medium text-gray-900">Enquete titel</label>
            <input type="text" id="title" name="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
          </div>
          <div class="mb-6">
            <label for="category_id" class="block mb-2 text-sm font-medium text-gray-900">Category</label>
            <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" name="category_id" id="category_id">
                @foreach(\App\Models\Category::all() as $category)
                    <option 
                    value="{{ $category->id }}"
                    {{ old('category_id') == $category->id ? 'selected' : ''}}> 
                    {{ ucwords($category->name) }}
                    </option>
                @endforeach
            </select>
          </div>
          <div class="mb-6">
            <label for="question_1" class="block mb-2 text-sm font-medium text-gray-900">Question</label>
            <input type="text" id="question_1" name="question_1" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
          </div>
          
          <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
        </form>

        </div>
    </div>
@endsection