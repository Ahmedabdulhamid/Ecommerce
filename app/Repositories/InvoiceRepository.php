<?php

namespace App\Repositories;

use App\Models\Invoice;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class InvoiceRepository
{
    public function findByIdOrFail(int|string $id): Invoice
    {
        return Invoice::findOrFail($id);
    }

    public function paginateUserInvoices(int $userId, int $perPage = 5): LengthAwarePaginator
    {
        return Invoice::where('user_id', $userId)
            ->latest()
            ->paginate($perPage);
    }
}
