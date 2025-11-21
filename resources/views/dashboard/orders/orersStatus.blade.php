<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('orders.updateStatus', $order->id) }}">
                    @csrf
                    @method('PATCH')

                    <select name="status" class="form-control" required>
                        @foreach (['pending', 'paid', 'processing', 'shipped', 'delivered', 'canceled', 'refunded', 'failed'] as $status)
                            <option value="{{ $status }}" {{ $order->status === $status ? 'selected' : '' }}>
                                {{ ucfirst($status) }}
                            </option>
                        @endforeach
                    </select>

                    <button type="submit" class="btn btn-primary mt-2">{{ __('admin.save') }}</button>
                </form>

            </div>

        </div>
    </div>
