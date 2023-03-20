@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto py-12 sm:px-6 lg:px-8">
        <div class="bg-white shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:p-6">
                <form action="{{ route('employee.question.update', $question->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-6">
                        <label class="block mb-2 text-sm font-medium text-gray-900" for="title">Title</label>
                        <input type="text" name="title" id="title" class="form-control shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md" value="{{ old('question', $question->question) }}" >
                    </div>

                    <div class="mt-6">
                        <label for="answers" class="block text-sm font-medium text-gray-700">Answers</label>
                        <ul>
                            @foreach($question->answers as $answer)
                                <li>{{ $answer->option }}</li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="mt-6">
                        <label for="enquete_id" class="block text-sm font-medium text-gray-700">Enquete</label>
                        <select id="enquete_id" name="enquete_id" class="shadow-sm focus:ring-blue-500 focus:border-blue-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            @foreach(\App\Models\Enquete::all() as $enquete)
                                <option value="{{ $enquete->id }}" {{ old('enquete_id', $question->enquete_id) == $enquete->id ? 'selected' : '' }}>
                                    {{ $enquete->title }}
                                </option>
                            @endforeach
                        </select>
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
