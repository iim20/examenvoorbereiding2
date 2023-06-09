<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Enquete;
use App\Models\Category;
use App\Models\Question;
use App\Models\Answer;
use App\Models\QtsEnquete;


class EmployeeController extends Controller
{
    public function index()
    {
        $role = Auth::user()->is_employee;
        if ($role == 1) {
            $alle = request('status_1');
            $beschikbaar = request('status_2');
            $ingevuld = request('status_3');
    
            $enquetes = Enquete::query(); // start building the query
            
            if ($beschikbaar) {
                $enquetes->where('status', '=', 'open');
            }
            
            elseif($ingevuld){
                $enquetes->where('status', '=', 'ingevuld');
            }
            else{
                $enquetes->get();
            }
            $enquetes = $enquetes->get();
                     
            return view('employee.enquete.index', compact('enquetes'));
        }
         else{
            return back()->with('role', 'Je bent een medewerker!');
        }
    }
    

    public function create()
    {
        $role = Auth::user()->is_employee;
        if ($role == 1) {
            return view('employee.enquete.create');
        }
        else{
            return back()->withErrors(['unauthenticated' => 'Je hebt geen toegeang!']);
        }
    }

    public function store(Request $request)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'title' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Create a new survey
        $enquete = new Enquete();
        $enquete->title = $validatedData['title'];
        $enquete->category_id = $validatedData['category_id'];
        $enquete->save();

        // Redirect the user to the survey index page
        return redirect()->route('employee.index');
    }

  
    public function edit($id)
    {
        $enquete = Enquete::findOrFail($id);
        return view('employee.enquete.edit', compact('enquete'));
    }

    public function update(Request $request, $id)
    {
        $enquete = Enquete::findorFail($id);

        $enquete->update([
            'title' => $request->input('title'),
            'category_id' => $request->input('category_id')
        ]);

        $enquete->save();


        return redirect()->route('employee.index', $enquete);
    }

    public function destroy($id)
    {
        $enquete = Enquete::findOrFail($id);
        $enquete->destroy($id);
        return redirect()->route('employee.index')->with('verwijderd', 'Enquete is verwijderd'); 
    }


    public function question_index()
    {
        $role = Auth::user()->is_employee;
        if ($role == 1) {
            $questions = Question::with('answers')->get();
            return view('employee.question.index', compact('questions'));
        }
         else{
            return back()->with('role', 'Je bent een medewerker!');
        }

    }

    public function question_create()
    {
        $role = Auth::user()->is_employee;
        if ($role == 1) {
            return view('employee.question.create');
        }
        else{
            return back()->withErrors(['unauthenticated' => 'Je hebt geen toegeang!']);
        }
    }

    public function question_store(Request $request)
    {
 
        // return response()->json($request->all());



            $question = Question::insertGetId([
                'question' => $request->question,
            ]);

            foreach ($request->answers as $answer) {
               
                Answer::insert([
                    "question_id" =>$question,
                    'option' =>$answer,
                ]);
            }

        return redirect()->route('employee.question.index');



    }

  
    public function question_edit($id)
    {
        $question = Question::findOrFail($id);
        return view('employee.question.edit', compact('question'));
    }

    public function question_update(Request $request, $id)
    {
        $question = Question::findorFail($id);

        $question->update([
            'question' => $request->input('question'),
        ]);

      
        $question->save();


        return redirect()->route('employee.question.index', $question);
    }

    public function question_destroy($id)
    {
        $question = Question::findOrFail($id);
        $question->destroy($id);
        return redirect()->route('employee.question.index')->with('verwijderd', 'Question is verwijderd'); 
    }

    public function question_enquete(Request $request)
    {

        // return response()->json($request->all());


   


    }

    public function enqueteQuestion($question_id)
    {
        $question = Question::find($question_id);
        return view('employee.question.enquetes', ['question_id' => $question]);
    }
    

    public function enqueteQuestion_store(Request $request)
{
    $enquete_id = $request->input('enquete_id');
    $question_id = $request->input('question_id');

    // Check if the given combination of enquete_id and question_id already exists
    $existingEnqueteQuestion = QtsEnquete::where('enquete_id', $enquete_id)
        ->where('question_id', $question_id)
        ->first();

    if ($existingEnqueteQuestion) {
        // Return an error message if the combination already exists
        return redirect('/employee/question')
            ->with('error', 'This question is already associated with the selected enquête.');
    }

    // If the combination does not exist, create a new QtsEnquete record
    $enqueteQuestion = new QtsEnquete();
    $enqueteQuestion->enquete_id = $enquete_id;
    $enqueteQuestion->question_id = $question_id;
    $enqueteQuestion->save();

    return redirect('/employee/question')
        ->with('success', 'The selected enquête has been associated with the question.');
}



    
    
    

    
    


    
}
