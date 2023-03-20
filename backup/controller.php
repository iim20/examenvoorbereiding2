public function store(Request $request)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'title' => 'required|string',
            'questions' => 'required|array|min:1',
            'questions.*' => 'required|string',
            'answers' => 'required|array|min:1',
            'answers.*' => 'required|array|min:1',
            'answers.*.*' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Create a new survey
        $enquete = new Enquete();
        $enquete->title = $validatedData['title'];
        $enquete->category_id = $validatedData['category_id'];
        $enquete->save();

        /// Create new questions and answers
        foreach ($validatedData['questions'] as $questionIndex => $questionText) {
            // Create a new question
            $question = new Question();
            $question->question = $questionText;
            $question->enquete_id = $enquete->id;
            $question->save();

            // Create new answers for the question
            if (isset($validatedData['answers'][$questionIndex])) {
                foreach ($validatedData['answers'][$questionIndex] as $answerIndex => $answerText) {
                    $answer = new Answer();
                    $answer->option = $answerText;
                    $answer->question_id = $question->id;
                    $answer->save();
                }
            }
        }


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

        collect($request->input('questions'))->each(function ($question) {
            $q = Question::findOrFail($question['id']);
            $q->update([
                'question' => $question['question']
            ]);

            collect($question['options'])->each(function ($answer) {
                $a = Answer::findOrFail($answer['id']);
                $a->update([
                    'answer' => $answer['answer']
                ]);
            });
        });

        $enquete->save();


        return redirect()->route('employee.index', $enquete);
    }


    public function question_index()
    {
        $role = Auth::user()->is_employee;
        if ($role == 1) {
            $questions = Question::all();
            return view('employee.question.index', compact('questions'));
        }
         else{
            return back()->with('role', 'Je bent een medewerker!');
        }

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
            'title' => $request->input('title'),
            'enquete_id' => $request->input('enquete_id')
        ]);

      
        $question->save();


        return redirect()->route('employee.question.index', $question);
    }
    
    

    
    


    
}
