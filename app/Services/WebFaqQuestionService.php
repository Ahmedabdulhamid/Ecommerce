<?php

namespace App\Services;

use App\Notifications\AnswerUserQuestion;
use App\Notifications\AnswerUsersQuestionsNotification;
use App\Repositories\WebFaqQuestionRepository;
use Illuminate\Database\Eloquent\Builder;

class WebFaqQuestionService
{
    public function __construct(private readonly WebFaqQuestionRepository $questions)
    {
    }

    public function query(): Builder
    {
        return $this->questions->query();
    }

    public function answerDashboardQuestion(int|string $id, string $reply): void
    {
        $question = $this->questions->findByIdOrFail($id);
        $question->notify(new AnswerUsersQuestionsNotification($question, $reply));
    }

    public function create(array $data)
    {
        return \App\Models\WebFaqQuestion::create($data);
    }

    public function answerAdminFaqQuestion(int|string $id, string $reply): void
    {
        $question = $this->questions->findByIdOrFail($id);
        $question->notify(new AnswerUserQuestion($reply, $question));
    }

    public function delete(int|string $id): int
    {
        $question = $this->questions->findByIdOrFail($id);
        $this->questions->delete($question);

        return $this->questions->count();
    }
}
