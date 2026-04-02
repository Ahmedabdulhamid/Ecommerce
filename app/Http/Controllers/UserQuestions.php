<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserQuestionAnswerRequest;
use App\Models\WebFaqQuestion;
use App\Services\WebFaqQuestionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;

class UserQuestions extends Controller
{
    public function __construct(private readonly WebFaqQuestionService $questionService)
    {
    }

    public function index()
    {
        return view('dashboard.questions.index');
    }

    public function getData()
    {
        $questions = $this->questionService->query();

        return DataTables::of($questions)
            ->addIndexColumn()
            ->filter(function ($query) {
                if (request()->has('search') && !empty(request('search.value'))) {
                    $search = request('search.value');
                    $query->where(function ($q) use ($search) {
                        $q->whereAny(['name', 'email'], 'like', '%' . $search . '%');
                    });
                }
            })
            ->addColumn('name', function ($question) {
                return $question->name;
            })
            ->addColumn('email', function ($question) {
                return $question->email;
            })
            ->addColumn('actions', function ($question) {
                return view('dashboard.questions.action', compact('question'));
            })
            ->make(true);
    }

    public function answer(UserQuestionAnswerRequest $request, string $id)
    {
        if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin', 'contact-manager'])) {
            abort(403);
        }

        $this->questionService->answerDashboardQuestion(request('question', $id), $request->validated('reply'));

        return response()->json(['success_msg' => __('front.success_msg')]);
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

    public function destroy(WebFaqQuestion $question)
    {
        $this->questionService->delete($question->id);

        return response()->json(['msg' => 'The Questio Has Been Deleted Successfully!']);
    }
}
