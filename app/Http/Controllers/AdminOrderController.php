<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminOrderStatusUpdateRequest;
use App\Services\OrderService;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;

class AdminOrderController extends Controller
{
    public function __construct(private readonly OrderService $orderService)
    {
    }

    public function index()
    {
        if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin', 'order-manger'])) {
            abort(403);
        }

        return view('dashboard.orders.index');
    }

    public function getData()
    {
        $orders = $this->orderService->latestQuery();

        return DataTables::of($orders)
            ->addIndexColumn()
            ->filter(function ($query) {
                $search = request('search.value');

                if (request()->has('search') && !empty($search)) {
                    $query->where(function ($q) use ($search) {
                        $q->where('l_name', 'like', "%$search%")
                            ->orWhere('f_name', 'like', "%$search%")
                            ->orWhere('email', 'like', "%$search%")
                            ->orWhere('phone', 'like', "%$search%")
                            ->orWhere('status', 'like', "%$search%")
                            ->orWhere('country', 'like', "%$search%")
                            ->orWhere('governorate', 'like', "%$search%")
                            ->orWhere('street', 'like', "%$search%");
                    });
                }

                return $query;
            })
            ->addColumn('user_name', fn ($order) => $order->f_name . ' ' . $order->l_name)
            ->addColumn('country', fn ($order) => $order->country)
            ->addColumn('governorate', fn ($order) => $order->governorate)
            ->addColumn('city', fn ($order) => $order->city)
            ->addColumn('email', fn ($order) => $order->email)
            ->addColumn('phone', fn ($order) => $order->phone)
            ->addColumn('status', fn ($order) => $order->status)
            ->addColumn('street', fn ($order) => $order->street)
            ->addColumn('total_price', fn ($order) => $order->total_price)
            ->addColumn('shipping_price', fn ($order) => $order->shipping_price)
            ->addColumn('actions', fn ($order) => view('dashboard.orders.actions', ['order' => $order])->render())
            ->rawColumns(['actions'])
            ->make(true);
    }

    public function destroy()
    {
        if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin', 'order-manger'])) {
            abort(403);
        }

        $count = $this->orderService->deletePendingOrFailed(request('id'));

        if ($count !== null) {
            return response()->json([
                'msg' => 'Order deleted successfully',
                'status' => 200,
                'countOrders' => $count,
            ]);
        }

        return response()->json(['msgErr' => 'You can\'t delete this order']);
    }

    public function show(string $id)
    {
        if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin', 'order-manger'])) {
            abort(403);
        }

        return view('dashboard.orders.show', [
            'order' => $this->orderService->getAdminOrder($id),
        ]);
    }

    public function update(string $id)
    {
        if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin', 'order-manger'])) {
            abort(403);
        }

        if ($this->orderService->markDelivered($id)) {
            Flasher::addSuccess('Status Updated Successfully!');
        } else {
            Flasher::addError('You can\'t update status of this order!');
        }

        return redirect()->back();
    }

    public function updateStatus(AdminOrderStatusUpdateRequest $request, string $id)
    {
        if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin', 'order-manger'])) {
            abort(403);
        }

        $result = $this->orderService->updateStatus($id, $request->validated('status'));

        if ($result['type'] === 'success') {
            Flasher::addSuccess($result['message']);
        } elseif ($result['type'] === 'info') {
            Flasher::addInfo($result['message']);
        } else {
            Flasher::addError($result['message']);
        }

        return redirect()->back();
    }
}
