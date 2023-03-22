<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Question;
use App\Models\Answer;
use App\Models\QtsEnquete;
use App\Models\Enquete;



class CustomerController extends Controller
{
    public function index()
    {
        $role=Auth::user()->is_employee;
        $users = User::all();
        if($role==0){
            $enquetes = Enquete::all();
            $user = Auth::user();
            $answers = Answer::where('user_id', $user->id)->where('is_correct', true)->get();
            return view('customer.index', [
                'enquetes' => $enquetes,
                'answers' => $answers
            ]);

        }
        else{
            return back()->with('unauthenticated', 'Je hebt geen toegang');
        }
    }

    public function create()
    {
        $role = Auth::user()->is_employee;
        if ($role == 0) {
            return view('customer.create');
        }
        else{
            return back()->withErrors(['unauthenticated' => 'Je hebt geen toegeang!']);
        }
    }

    public function store(Request $request)
    {
        $questionId = $request->input('question_id');
    
        foreach ($request->input('answers') as $answer) {
            Answer::insert([
                "question_id" => $questionId,
                'option' => $answer,
            ]);
        }
    
        return redirect()->route('customer.index');
    }



    public function enqueteQuestion($enquete_id)
    {
        $enquete = Enquete::findOrFail($enquete_id);
        $questions = QtsEnquete::where('enquete_id', $enquete_id)->with('question')->get();


        return view('customer.questions', ['enquete' => $enquete, 'questions' => $questions]);
    }
    public function showAnswerForm($enquete_id, $question_id)
    {
        $enquete = Enquete::findOrFail($enquete_id);
        $question = Question::findOrFail($question_id);
        $qtsEnquete = QtsEnquete::where('enquete_id', $enquete_id)
            ->where('question_id', $question_id)
            ->firstOrFail();
    
        return view('customer.answers', compact('enquete', 'question', 'qtsEnquete'));
    }
    
    

    public function submitAnswer(Request $request, $enquete_id, $question_id)
    {
        // get the selected answer and its ID from the request
        $selectedAnswerId = $request->input('answer');

        // get the selected answer instance and update the is_correct and user_id columns
        $selectedAnswer = Answer::findOrFail($selectedAnswerId);
        $selectedAnswer->is_correct = true;
        $selectedAnswer->user_id = auth()->user()->id;
        $selectedAnswer->save();

        // get all the answers for the question and mark the other answers as incorrect
        $answers = Answer::where('question_id', $question_id)->get();
        foreach ($answers as $answer) {
            if ($answer->id != $selectedAnswerId) {
                $answer->is_correct = false;
                $answer->save();
            }
        }

        return redirect()->route('customer.enquetequestion', ['enquete_id' => $enquete_id]);
    }

    
    

    



    


}
