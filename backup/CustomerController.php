<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Categorie;
use App\Models\Enquete;
use App\Models\EnqueteQuestion;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $role=Auth::user()->is_employee;
        if($role==0){
            $qtsEnquetes= EnqueteQuestion::all();
            $questions = Question::with('answers')->get();
            $totaleQuestions = $qtsEnquetes->count();

            return view('customer.index', compact('qtsEnquetes', 'questions', 'totaleQuestions'));

        }
        else{
            return back()->with('unauthenticated', 'Je hebt geen toegang');
        }
    }

  

   
    

    /**
     * Show the form for creating a new resource.
     */
    public function create($question_id)
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show($enquete_id)
    {
            $role = Auth::user()->is_employee;
            if ($role == 0) {
                $enqueteQuestions = Question::find($enquete_id);
                $qtsEnquetes = EnqueteQuestion::all();
                return view('customer.questions', [
                    'enquete_id' => $enqueteQuestions,
                    'qtsEnquetes' => $qtsEnquetes
                ]);
            }
            else{
                return back()->withErrors(['unauthenticated' => 'Je hebt geen toegeang!']);
            }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
