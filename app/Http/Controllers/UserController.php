<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.users.index');
    }
    public function getData()
    {
        $users = User::query()->with(['country', 'governorate']);
        return DataTables::of($users)->addIndexColumn()->filter(function ($query) {
            if (request()->has('search') && !empty(request('search.value'))) {
                $search = request('search.value');
                $query->where(function ($q) use ($search) {
                    $q->whereAny(['name', 'email'], 'like', '%' . $search . '%');
                });
            }
        })->addColumn('name', function ($user) {
            return $user->name;
        })->addColumn('email', function ($user) {
            return $user->email;
        })->addColumn('email_verification', function ($user) {
            return $user->email_verified_at ? $user->email_verified_at->format('d/m/Y h:i A') : 'Not Verified';

        })->addColumn('status', function ($user) {
            return $user->status == 'active' ? __('products.status_yes') : __('products.status_no');
        })->addColumn('country', function ($user) {
            return $user->country?$user->country->name:'Not Found';
        })->addColumn('governorate', function ($user) {
            return $user->governorate?$user->governorate->name:"Not Found";
        })->addColumn('action', function ($user) {
            return view('dashboard.users.action',['user'=>$user]);
        })->make(true);
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
    public function changeStatus (){
        $user=User::where('id',request('id'))->first();
        $user->update(['status'=>$user->status=='active'?'inactive':'active']);
        return response()->json(['msg'=>'The Status Updated Successfully']);

      }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user=User::find(request('user'));
        $user->delete();
        return response()->json(['msg'=>'The User Deleted Successfully!','count'=>User::count()]);

    }
}
