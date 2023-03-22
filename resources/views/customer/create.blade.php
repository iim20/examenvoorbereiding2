
@extends('layouts.app')
@section('title', 'Questions')


@section('content')
    <div class="max-w-7xl mx-auto mt-20 ml-24">
        <div class="flex justify-between">

            <h1 class="text-2xl mb-4">Create questions</h1>
            <button id="addAnswer" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Add answer</button>
        </div>


        <form id="addQna" method="POST" action="{{ route('customer.store')}}">
            @csrf

            <div id="qna-container">

              

            <div class="mb-6">
            <label for="question_id" class="block mb-2 text-sm font-medium text-gray-900">Question</label>
            <select class="bg-gray-50 border border-gray-300 w-64 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5" name="question_id" id="question_id">
                @foreach(\App\Models\Question::all() as $question)
                    <option 
                        value="{{ $question->id }}"
                        {{ old('question_id') == $question->id ? 'selected' : ''}}> 
                        {{ ucwords($question->question) }}
                    </option>
                @endforeach
            </select>
        </div>
            

            
                <!-- Answers -->
            
        
                <input type="hidden" name="selected_question" id="selected_question" value="">
                <span class="error text-red-600"></span>
            
            </div>
            


          <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>

        </form>
    </div>



    <script>

                

        $(document).ready(function(){
          $("#addQna").submit(function(e){
            e.preventDefault();

            // Check if all textareas are filled
            var isFilled = false;
            if ($("textarea").length > 0) {
              isFilled = true;
              $("textarea").each(function(){
                if($(this).val() == ""){
                  isFilled = false;
                  return false;
                }
              });
            }

            // If all textareas are filled, submit the form
            if (isFilled) 
            {
              this.submit();
            } 
            else 
            {
              $(".error").text("Please fill in answer")
              setTimeout(function(){
                $(".error").text("");
              }, 2000); 
            }
          });




                
                
                // Add answer
                $("#addAnswer").click(function(){

                    if ($(".answers").length >= 1) {
                        $(".error").text("Maximum 1 answers")
                        setTimeout(function(){
                            $(".error").text("");
                        }, 2000);
                    } 
                    else {
                      var html = `
                      <div class="mb-6 flex answers">
                            <div class="space-x-2 items-center">
                                    <textarea name="answers[]" placeholder="Enter answer!" required" id="" cols="30" rows="10"></textarea>
                                </div>
                        </div>`;
                        $("#qna-container").append(html);
                    }
                  
                });

              


            });
    </script>


@endsection
