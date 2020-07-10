<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
// use RealRashid\SweetAlert\Facades\Alert;

class QuestionController extends Controller
{



    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::latest()->paginate(5);
        return view('questions.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $question = new Question();
        return view('questions.create', compact('question'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $this->validate($request, array(
        'body' => 'required',
        'title' => 'required'
         ));
        // other way to show validation error, but this is how to show in sweetalert
     
        // $validator = Validator::make($request->all(), [
        // 'title' => 'required|min:3',
        // 'body' => 'required|min:3'
        // ]);

        // if ($validator->fails()) {
        //     return back()->with('error', $validator->messages()->all()[0])->withInput();
        // }
       
        $request->user()->questions()->create($request->only('title', 'body'));
        // Alert::toast('Question Created Successfully!', 'success');  
        return redirect('questions')->with('success', 'Question Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        $question->increment('views');
        return view('questions.show', compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = Question::find($id);
        return view('questions.edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        $question->update($request->only('title', 'body'));
        return redirect('questions')->with('success', 'Question Updated  Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        $question->delete();
        return back()->with('success', 'Question Deleted Successfully!');
    }
}
