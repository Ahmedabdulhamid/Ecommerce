<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function __construct(private readonly UserService $userService)
    {
    }

    public function index()
    {
        return view('dashboard.users.index');
    }

    public function getData()
    {
        $users = $this->userService->queryWithLocation();

        return DataTables::of($users)
            ->addIndexColumn()
            ->filter(function ($query) {
                if (request()->has('search') && !empty(request('search.value'))) {
                    $search = request('search.value');
                    $query->where(function ($q) use ($search) {
                        $q->whereAny(['name', 'email'], 'like', '%' . $search . '%');
                    });
                }
            })
            ->addColumn('name', function ($user) {
                return $user->name;
            })
            ->addColumn('email', function ($user) {
                return $user->email;
            })
            ->addColumn('email_verification', function ($user) {
                return $user->email_verified_at ? $user->email_verified_at->format('d/m/Y h:i A') : 'Not Verified';
            })
            ->addColumn('status', function ($user) {
                return $user->status == 'active' ? __('products.status_yes') : __('products.status_no');
            })
            ->addColumn('country', function ($user) {
                return $user->country ? $user->country->name : 'Not Found';
            })
            ->addColumn('governorate', function ($user) {
                return $user->governorate ? $user->governorate->name : 'Not Found';
            })
            ->addColumn('action', function ($user) {
                return view('dashboard.users.action', ['user' => $user]);
            })
            ->make(true);
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
    }

    public function show(string $id)
    {
    }

    public function edit(string $id)
    {
    }

    public function update(Request $request, string $id)
    {
    }

    public function changeStatus()
    {
        $this->userService->toggleStatus(request('id'));

        return response()->json(['msg' => 'The Status Updated Successfully']);
    }

    public function destroy(string $id)
    {
        $count = $this->userService->delete(request('user', $id));

        return response()->json(['msg' => 'The User Deleted Successfully!', 'count' => $count]);
    }
}
