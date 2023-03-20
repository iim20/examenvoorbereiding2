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
                        <select id="category_id" name="category_id" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 w-full sm:text-sm border-gray-300 rounded-md">
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

              








                    <div class="flex items-baseline justify-end mt-6 space-x-4">
                        <form onsubmit="return confirm('Weet u zeker dat wilt u enquete verwijderen?')" action="{{ route('employee.destroy', $enquete) }}" method="POST">
                            <button type="submit" class="px-5 py-2.5 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase hover:bg-red-500 active:bg-red-900 focus:outline-none focus:border-red-900 focus:shadow-outline-gray  transition ease-in-out duration-150">Delete</a>
                            @csrf
                            @method('DELETE')    
                        </form>


                        <button type="submit" class="px-5 py-2.5 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase hover:bg-blue-500 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:shadow-outline-gray  transition ease-in-out duration-150">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>


    </script>
@endsection
