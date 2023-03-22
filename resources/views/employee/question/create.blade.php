
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
              $(".error").text("Minimum 4 answers")
              setTimeout(function(){
                  $(".error").text("");
              }, 2000);
          } 
          else 
          {
             
     
                  this.submit();
              
         
          }
      });

        
        
      // Add answer
      $("#addAnswer").click(function(){

        if ($(".answers").length >= 4) {
            $(".error").text("Maximum 4 answers")
            setTimeout(function(){
                $(".error").text("");
            }, 2000);
        } 
        else {
              var html = `
                <div class="mb-6 flex answers">
                    <div class="flex space-x-2 items-center">
                    <input type="text" name="answers[]" placeholder="Enter answer!" required>
                  <div class="space-x-2 items-center">
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
