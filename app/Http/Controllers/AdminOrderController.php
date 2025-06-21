<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Validation\Rule;
class AdminOrderController extends Controller
{
     protected $allowedTransitions = [
        'pending'    => ['canceled'],               // فقط يمكن إلغاء الطلب
        'paid'       => ['processing', 'canceled','delivered'], // من المدفوع ممكن ينتقل لمعالجة أو إلغاء
        'processing' => ['shipped', 'canceled'],    // أثناء المعالجة ممكن يشحن أو يُلغى
        'shipped'    => ['delivered'],               // بعد الشحن فقط يمكن التوصيل
        'delivered'  => [],                           // توصيل لا يمكن تغييره
        'canceled'   => [],                           // ملغي لا يمكن تغييره
        'refunded'   => [],                           // مُردود لا يمكن تغييره
        'failed'     => ['pending'],                  // ممكن نعيده لـ pending لو الدفع فشل
    ];
    public function index()
    {
        return view('dashboard.orders.index');
    }
    public function getData()
    {
        $orders = Order::latest();

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
                // لا تنسى إرجاع الـ query دائمًا
                return $query;
            })
            ->addColumn('user_name', fn($order) => $order->f_name . ' ' . $order->l_name)
            ->addColumn('country', fn($order) => $order->country)
            ->addColumn('governorate', fn($order) => $order->governorate)
            ->addColumn('city', fn($order) => $order->city)
            ->addColumn('email', fn($order) => $order->email)
            ->addColumn('phone', fn($order) => $order->phone)
            ->addColumn('status', fn($order) => $order->status)
            ->addColumn('street', fn($order) => $order->street)
            ->addColumn('total_price', fn($order) => $order->total_price)
            ->addColumn('shipping_price', fn($order) => $order->shipping_price)
            ->addColumn('actions', fn($order) => view('dashboard.orders.actions', ['order' => $order])->render())
            ->rawColumns(['actions'])
            ->make(true);
    }
    public function destroy()
    {
        $order = Order::find(request('id'));

        if (in_array($order->status, ['pending', 'failed'])) {
            $order->delete();
            return response()->json([
                'msg' => 'Order deleted successfully',
                'status' => 200,
                'countOrders' => Order::count()
            ]);
        }


        return response()->json(['msgErr' => 'You can\'t delete this order']);
    }

    private function hideEmail($email)
    {
        list($user, $domain) = explode('@', $email);
        $start = substr($user, 0, 2);
        return $start . '****@' . $domain;
    }
    public function show(String $id)
    {
        $order = Order::where('id', $id)->with('items.product')->first();
        if ($order) {
            // أضف خاصية جديدة للايميل المخفي
            $order->email_hidden = $this->hideEmail($order->email);
        }

        return view('dashboard.orders.show', ['order' => $order]);
    }
    public function update(string $id)
    {
        $order = Order::find($id);
        if (in_array($order->status, ['processing', 'shipped','paid'])) {

            $order->update([
                'status'=>'delivered'
            ]);


             Flasher::addSuccess('Status Updated Successfully!');

        }else {
           Flasher::addError('You can\'t update status of this order!');
        }

        return redirect()->back();
    }
 public function updateStatus(Request $request, string $id)
{
    $order = Order::findOrFail($id);

    $request->validate([
        'status' => ['required', Rule::in(array_keys($this->allowedTransitions))],
    ]);

    $oldStatus = $order->status;
    $newStatus = $request->status;

    if ($oldStatus === $newStatus) {
        Flasher::addInfo('Order is already in this status.');
        return redirect()->back();
    }

    if (!in_array($newStatus, $this->allowedTransitions[$oldStatus])) {
        Flasher::addError("Transition from '$oldStatus' to '$newStatus' is not allowed.");

    }else {
         Flasher::addSuccess("Order status updated to '$newStatus' successfully.");
    }

    $order->status = $newStatus;
    $order->save();


    return redirect()->back();
}

}
