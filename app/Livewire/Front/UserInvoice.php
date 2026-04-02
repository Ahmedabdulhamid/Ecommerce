<?php

namespace App\Livewire\Front;

use App\Services\InvoiceService;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithPagination;

class UserInvoice extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function downloadInvoice($invoiceId, InvoiceService $invoiceService)
    {
        $generated = $invoiceService->generatePdfStream($invoiceId);

        return response()->streamDownload(function () use ($generated) {
            echo $generated['pdf']->stream();
        }, $generated['filename']);
    }

    public function render(InvoiceService $invoiceService)
    {
        $invoices = auth()->id()
            ? $invoiceService->paginateUserInvoices(auth()->id(), 5)
            : new Collection();

        return view('livewire.front.user-invoice', [
            'invoices' => $invoices,
        ]);
    }
}
