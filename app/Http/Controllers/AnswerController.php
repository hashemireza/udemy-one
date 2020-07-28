<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Answer;
use App\Question;

class AnswerController extends Controller
{
   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Question $question, Request $request)
    {       
        // dd($request->all());
        $request->validate([
            'body' => 'required|min:4'
        ]);
        $question->answers()->create($request->validate(['body' => 'required']) + ['user_id' => \Auth::id()]);
        return  back()->with('success', 'Your Answer has been submitted successfully!');
    }

  

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question, Answer $answer, Request $request)
    {
        return view('answers.edit', compact('answer', 'question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  Question $question, Answer $answer)
    {
        $answer->update($request->validate([
            'body' => 'required'
        ]));
        return redirect()->route('questions.show', $question->id)->with('success', 'Your answer has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question, Answer $answer)
    {
        $answer->delete();
        return back()->with('success', 'Your answer has been deleted successfully!');
    }
}
