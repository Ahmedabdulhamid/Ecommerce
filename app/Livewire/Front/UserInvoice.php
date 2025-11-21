<?php

namespace App\Livewire\Front;

use App\Models\Invoice;
use Livewire\Component;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf;

class UserInvoice extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function downloadInvoice($invoiceId)
    {
        $invoice = Invoice::findOrFail($invoiceId);

        // تنظيف كل النصوص قبل PDF
        foreach ($invoice->getAttributes() as $key => $value) {
            if (is_string($value)) {
                $invoice->$key = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
            }
        }

        // توليد HTML مع التأكد من الترميز
        $html = view('front.invoices.pdf', compact('invoice'))->render();
        $html = mb_convert_encoding($html, 'UTF-8', 'UTF-8');

        $pdf = Pdf::loadHTML($html)
            ->setOptions([
                'defaultFont' => 'DejaVu Sans',
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled' => true,
                'isPhpEnabled' => true,
            ]);

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'invoice.pdf');
    }

    public function render()
    {
        $invoices = Invoice::where('user_id', auth()->id())
            ->latest()
            ->paginate(5);

        return view('livewire.front.user-invoice', [
            'invoices' => $invoices,
        ]);
    }
}
