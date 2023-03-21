
@extends('layouts.app')
@section('title', 'Questions')


@section('content')
    <div class="max-w-7xl mx-auto mt-20 ml-24">
        <div class="flex justify-between">

            <h1 class="text-2xl mb-4">Create questions</h1>
            <button id="addAnswer" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Add answer</button>
        </div>


        <form id="addQna" method="POST" action="{{ route('employee.question.store')}}">
            @csrf

            <div id="qna-container">

                <div class="mb-6">
                    <label class="block mb-2 text-sm font-medium text-gray-900" for="question">Question</label>
                    <input type="text" name="question" id="question" class="form-control">
                </div>

           <!-- DIT is omgekeerd!    <div class="mb-6">
                    <label for="enquete_id" class="block mb-2 text-sm font-medium text-gray-900">Enquete</label>
                    <select class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block  p-2.5" name="enquete_id" id="enquete_id">
                        @foreach(\App\Models\Enquete::all() as $enquete)
                            <option 
                            value="{{ $enquete->id }}"
                            {{ old('enquete_id') == $enquete->id ? 'selected' : ''}}> 
                            {{ ucwords($enquete->title) }}
                            </option>
                        @endforeach
                    </select>
                </div>--> 
            
                <!-- Answers -->
            
        
                
                <span class="error text-red-600"></span>
            
            </div>
            


          <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>

        </form>
    </div>



<script>
    $(document).ready(function(){
        $("#addQna").submit(function(e){
            e.preventDefault();
            

            if ($(".answers").length < 2) 
            {
                $(".error").text("Maximum 6 answers")
                setTimeout(function(){
                    $(".error").text("");
                }, 2000);
            } 
            else 
            {
                var checkIsCorrect = false;
               
                for(let i = 0; i < $(".is_correct").length; i++)
                {
                   if( $(".is_correct:eq("+i+")").prop('checked') == true)
                   {
                        checkIsCorrect = true;
                        $(".is_correct:eq("+i+")").val($(".is_correct:eq("+i+")").prop('checked', true).closest('.answers').find('input[type="text"]').val());



                   }
                }

                if (checkIsCorrect) 
                {
                    this.submit();
                
                } 
                else 
                {
                    $(".error").text("Please select a correct answer!")
                    setTimeout(function(){
                        $(".error").text("");
                    }, 2000); 
                }
            }
        });


        
        
        // Add answer
        $("#addAnswer").click(function(){

            if ($(".answers").length >= 6) {
                $(".error").text("Maximum 6 answers")
                setTimeout(function(){
                    $(".error").text("");
                }, 2000);
            } 
            else {
              var html = `
              <div class="mb-6 flex answers">
                <input type="radio" name="is_correct" class="is_correct">
                    <div class="flex space-x-2 items-center">
                        <input type="text" name="answers[]" placeholder="Enter answer!" required>
                        </div>
                        <button type="button" class="text-white focus:outline-none bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 removeBtn">Remove</button>
                </div>`;
                $("#qna-container").append(html);
            }
          
        });

        // Remove answer
        $(document).on("click", ".removeBtn", function(){
            $(this).closest('.answers').remove();
        });


    });
</script>



@endsection
