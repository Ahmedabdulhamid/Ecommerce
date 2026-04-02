<?php

namespace App\Services;

use App\Repositories\InvoiceRepository;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class InvoiceService
{
    public function __construct(private readonly InvoiceRepository $invoices)
    {
    }

    public function paginateUserInvoices(int $userId, int $perPage = 5): LengthAwarePaginator
    {
        return $this->invoices->paginateUserInvoices($userId, $perPage);
    }

    public function generatePdfStream(int|string $invoiceId): array
    {
        $invoice = $this->invoices->findByIdOrFail($invoiceId);

        foreach ($invoice->getAttributes() as $key => $value) {
            if (is_string($value)) {
                $invoice->$key = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
            }
        }

        $html = view('front.invoices.pdf', compact('invoice'))->render();
        $html = mb_convert_encoding($html, 'UTF-8', 'UTF-8');

        $pdf = Pdf::loadHTML($html)->setOptions([
            'defaultFont' => 'DejaVu Sans',
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
            'isPhpEnabled' => true,
        ]);

        return ['pdf' => $pdf, 'filename' => 'invoice.pdf'];
    }
}
