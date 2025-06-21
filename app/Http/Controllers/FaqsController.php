<?php

namespace App\Http\Controllers;

use App\Http\Requests\FaqRequest;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class FaqsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin','contact-manager'])) {
            abort(403);
        }
        $faqs=Faq::orderBy('id','desc')->get();
       return view ('dashboard.faqs.index',['faqs'=>$faqs]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }


    public function store(FaqRequest $request)
    {
        if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin','contact-manager'])) {
            abort(403);
        }
        $data=$request->validated();
        $faq=Faq::create($data);
        if ($faq) {
            return response()->json([
                'message'=>"Your Faq has been created successfully!",
                "faq"=>$faq,
                'count'=>Faq::count(),
                'status'=>"success"
            ]);
        }
        else{
            return response()->json([
                'message'=>"Something Error has happen",

                'status'=>"error"
            ]);
        }
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
    public function update(FaqRequest $request, string $id)
    {
        if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin','contact-manager'])) {
            abort(403);
        }
      $data=$request->validated();
      $faq=Faq::where('id',$request->id)->first();
      if ($faq) {
        $faq->update($data);
        return response()->json(['message'=>'success','faq'=>$faq]);

      }
      else{
        return response()->json(['message'=>'Not Found']);
      }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin','contact-manager'])) {
            abort(403);
        }
        $faq=Faq::where('id',request('faq'))->first();
        $faq_del=$faq->delete();
        if ($faq_del) {
            return response()->json(['message'=>"Faq has been deleted Successfully!",'status'=>"success",'count'=>Faq::count()]);

        } else{
            return response()->json(['message'=>"Faild To Delete This Faq",'status'=>'error']);
        }


    }
}
