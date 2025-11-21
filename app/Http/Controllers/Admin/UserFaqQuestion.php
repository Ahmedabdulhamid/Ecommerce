<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WebFaqQuestion;
use App\Notifications\AnswerUserQuestion;
use Illuminate\Http\Request;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Gate;
class UserFaqQuestion extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin','contact-manager'])) {
            abort(403);
        }
        return view('dashboard.user_faqs.index');
    }

    /**
     * Show the form for creating a new resource.
     */
   public function getData()
{
    $userQuestions = WebFaqQuestion::query();

    return DataTables::of($userQuestions)
        ->addIndexColumn()
        ->filter(function ($query) {
            if (request()->has('search') && !empty(request('search.value'))) {
                $search = request('search.value');
                $query->where(function ($q) use ($search) {
                    $q->whereAny(['name', 'email', 'subject', 'message'], '%' . $search . '%');
                });
            }
        })
        ->addColumn('name', function ($userQuestion) {
            return $userQuestion->name;
        })
        ->addColumn('email', function ($userQuestion) {
            return $userQuestion->email;
        })
        ->addColumn('message', function ($userQuestion) {
            return $userQuestion->message;
        })
        ->addColumn('subject', function ($userQuestion) {
            return $userQuestion->subject;
        })
        ->addColumn('created_at', function ($userQuestion) {
            return $userQuestion->created_at->format('Y-m-d');
        }) ->addColumn('actions', function ($userQuestion) {
            return view('dashboard.user_faqs.actions',compact('userQuestion'));
        })
        ->make(true); // ✅ الحل هنا
}

    public function create() {}

    public function store(Request $request)
    {
        //
    }
    public function answerQuestion(Request $request,string $id)
    {
        if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin','contact-manager'])) {
            abort(403);
        }
         $userQuestion=WebFaqQuestion::whereId(request('id'))->first();
         $data=$request->validate([
            'reply'=>'required'
         ]);

         $userQuestion->notify(new AnswerUserQuestion($request->reply,$userQuestion));

       return response()->json(['status'=>200,'msg'=>"Your Reply Submited Successfully!"]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
          if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin','contact-manager'])) {
            abort(403);
        }
      WebFaqQuestion::where('id',request('user_faq'))->delete();
      return response()->json(['status'=>200,'message'=>"The Question Deleted Successfully !",'count'=>WebFaqQuestion::count()]);
    }
}
