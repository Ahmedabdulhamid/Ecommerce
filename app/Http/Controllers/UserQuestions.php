<?php

namespace App\Http\Controllers;

use App\Models\WebFaqQuestion;
use App\Notifications\AnswerUsersQuestionsNotification;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
class UserQuestions extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

       return view('dashboard.questions.index');
    }
    public function getData(){
      $questions=WebFaqQuestion::query();
      return DataTables::of($questions)->addIndexColumn()->filter(function($query){
        if (request()->has('search') && !empty(request('search.value'))) {
            $search=request('search.value');
            $query->where(function($q) use($search){
              $q->whereAny(['name','email'],'like','%'.$search.'%');
            });
        }
      })->addColumn('name',function($question){
        return $question->name;
    })->addColumn('email',function($question){
        return $question->email;
    })->addColumn('actions',function($question){
        return view('dashboard.questions.action',compact('question'));
    })->make(true);
;

    }
    public function answer(Request $request,string $id){
         if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin','contact-manager'])) {
            abort(403);
        }
        $data=$request->validate([
            'reply'=>['required']
        ]);
        $question= WebFaqQuestion::find(request('question'));
        $question->notify(new AnswerUsersQuestionsNotification($question,$request->reply));
        return response()->json(['success_msg'=>__('front.success_msg')]);

    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }


    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WebFaqQuestion $question)

    {
        $question->delete();
        return response()->json(['msg'=>"The Questio Has Been Deleted Successfully!"]);
    }
}
