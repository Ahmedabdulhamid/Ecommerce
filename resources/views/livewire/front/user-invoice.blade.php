<div>
    <h2 class="mb-4">{{__('front.invoices')}}</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>{{__('front.invoice_id')}}</th>
                <th>{{__('front.price')}}</th>
                <th>{{__('front.currency')}}</th>
                <th>{{__('admin.status')}}</th>
                <th>{{__('front.date')}}</th>
                <th>{{__('front.action')}}</th>
            </tr>
        </thead>
        <tbody>
            @forelse($invoices as $invoice)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $invoice->invoice_id }}</td>
                    <td>{{ number_format($invoice->amount, 2) }}</td>
                    <td>{{ $invoice->currency }}</td>
                    <td>{{ $invoice->status }}</td>
                    <td>{{ $invoice->created_at->format('Y-m-d H:i') }}</td>
                    <td>
                        <button wire:click='downloadInvoice({{$invoice->id}})' class="btn btn-sm btn-primary">
                           {{__('front.download_pdf')}}
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">{{__('front.no_invoices')}}</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-3">
        {{ $invoices->links() }}
    </div>
</div>
