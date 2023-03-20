
try {
    $questions = Question::all();
    if(count($questions) > 0)
    {
        $data = [];
        $counter = 0;

        foreach ($questions as $question) 
        {
            $qnsEnquete = QtsEnquete::where([
                'enquete_id' => $request->enquete_id,
                'question_id' => $question->id
                ])->get();
            if(count($qnsEnquete) == 0)
            {
                $data[$counter]['id'] = $question->id;
                $data[$counter]['questions'] = $question->question;
                $counter++;
            }
        }

        return response()->json(['success' => true, 'data' => $data, 'msg' => 'Questions data!']);


    }
    else
    {
    return response()->json(['success'=>false, 'msg'=> 'Questions not found!']);

    }
} catch (\Excetion $e) {
    return response()->json(['success'=>false, 'msg'=> $e->getMessage()]);
}