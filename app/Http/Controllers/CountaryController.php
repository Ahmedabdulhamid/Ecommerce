<?php

namespace App\Http\Controllers;
use Flasher\Laravel\Facade\Flasher;
use App\Models\Countary;
use App\Models\Governorate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CountaryController extends Controller
{
    public function index()
    {
        if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin','admin'])) {
            abort(403);
        }
         $countaries = Countary::with("governorates")->paginate(10);


        return view('dashboard.countaries.countary', ['countaries' => $countaries]);
    }
    public function edit(Request $request)
    {
         if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin','admin'])) {
            abort(403);
        }
        $countary = Countary::findOrFail($request->id);
        $countary->update([
            'status' => $countary->status == "active" ? "inactive" : "active"
        ]);
        return response()->json(['message' => "Your Status Edited "]);
    }
    public function editGovernorate(Request $request)
    {
         if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin','admin'])) {
            abort(403);
        }
        $governorate = Governorate::findOrFail($request->id);
        $governorate->update([
            'status' => $governorate->status == "active" ? "inactive" : "active"
        ]);
        return response()->json(['message' => "Your Status Edited "]);
    }
    public function show($id)
    {
         if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin','admin'])) {
            abort(403);
        }
        $country = Countary::where('id', $id)->with('governorates')->firstOrFail();
        //$country=$country->with('governorates')->get()-;
        //return $country->governorates;
        return view('dashboard.countaries.governorate', ['country' => $country]);
    }
    public function searchByGovernorates(Request $request)
    {
        if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin','admin'])) {
            abort(403);
        }
        $country = Countary::where('name->en', 'like', '%' . $request->search . '%')->orWhere('name->ar', 'like', '%' . $request->search . '%')->with('governorates')->first();

        if (!$country) {

            $country = Countary::where('id', $request->id)->with('governorates')->firstOrFail();
            Flasher::addError('The Countary Not found!');
            return view('dashboard.countaries.governorate', ['country' => $country]);
        } else {
            return view('dashboard.countaries.governorate', ['country' => $country]);
        }


    }
    public function search(Request $request)
    {
         if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin','admin'])) {
            abort(403);
        }
        $country = Countary::where('name->en', 'like', '%' . $request->key . '%')
            ->orWhere('name->ar', 'like', '%' . $request->key . '%')
            ->orWhereHas('governorates', function ($query) use ($request) {
                $query->where('name->en', 'like', '%' . $request->key . '%')
                    ->orWhere('name->ar', 'like', '%' . $request->key . '%');
            })
            ->with('governorates')
            ->first();
        return view('dashboard.countaries.search', ['country' => $country]);

    }
    public function editGovernoratePrice(Request $request)
    {
         if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin','admin'])) {
            abort(403);
        }
        $governorate = Governorate::find($request->id);
        $governorate = $governorate->update([
            'price' => $request->price
        ]);
        return response()->json([
            'msgPriceShipping' => __('countaries.msgPriceShipping'),
            "data" => ['id' => $request->id, 'price' => $request->price]
        ]);

    }


}
