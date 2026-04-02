<?php

namespace App\Repositories;

use App\Models\WebFaqQuestion;
use Illuminate\Database\Eloquent\Builder;

class WebFaqQuestionRepository
{
    public function query(): Builder
    {
        return WebFaqQuestion::query();
    }

    public function findByIdOrFail(int|string $id): WebFaqQuestion
    {
        return WebFaqQuestion::findOrFail($id);
    }

    public function delete(WebFaqQuestion $question): ?bool
    {
        return $question->delete();
    }

    public function count(): int
    {
        return WebFaqQuestion::count();
    }
}
