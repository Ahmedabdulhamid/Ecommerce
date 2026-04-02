<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserFaqAnswerRequest;
use App\Services\WebFaqQuestionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;

class UserFaqQuestion extends Controller
{
    public function __construct(private readonly WebFaqQuestionService $questionService)
    {
    }

    public function index()
    {
        if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin', 'contact-manager'])) {
            abort(403);
        }

        return view('dashboard.user_faqs.index');
    }

    public function getData()
    {
        $userQuestions = $this->questionService->query();

        return DataTables::of($userQuestions)
            ->addIndexColumn()
            ->filter(function ($query) {
                if (request()->has('search') && !empty(request('search.value'))) {
                    $search = request('search.value');
                    $query->where(function ($q) use ($search) {
                        $q->whereAny(['name', 'email', 'subject', 'message'], 'like', '%' . $search . '%');
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
            })
            ->addColumn('actions', function ($userQuestion) {
                return view('dashboard.user_faqs.actions', compact('userQuestion'));
            })
            ->make(true);
    }

    public function create()
    {
    }

    public function store(Request $request)
    {
    }

    public function answerQuestion(UserFaqAnswerRequest $request, string $id)
    {
        if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin', 'contact-manager'])) {
            abort(403);
        }

        $this->questionService->answerAdminFaqQuestion(request('id', $id), $request->validated('reply'));

        return response()->json(['status' => 200, 'msg' => 'Your Reply Submited Successfully!']);
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

    public function destroy(string $id)
    {
        if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin', 'contact-manager'])) {
            abort(403);
        }

        $count = $this->questionService->delete(request('user_faq', $id));

        return response()->json([
            'status' => 200,
            'message' => 'The Question Deleted Successfully !',
            'count' => $count,
        ]);
    }
}
