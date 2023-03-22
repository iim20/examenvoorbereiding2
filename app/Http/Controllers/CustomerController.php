<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Question;
use App\Models\Answer;
use App\Models\QtsEnquete;



class CustomerController extends Controller
{
    public function index()
    {
        $role=Auth::user()->is_employee;
        $users = User::all();
        if($role==0){
            $qtsEnquetes= QtsEnquete::all();
            $questions = Question::with('answers')->get();

            return view('customer.index', compact('qtsEnquetes', 'questions'));

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
    


}
