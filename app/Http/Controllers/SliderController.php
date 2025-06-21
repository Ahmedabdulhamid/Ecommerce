<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin','designer'])) {
            abort(403);
        }
        return view('dashboard.sliders.index');
    }
    public function getData()
    {
        $sliders = Slider::query();
        return DataTables::of($sliders)->addIndexColumn()->filter(function ($query) {
            if (request()->has('search') && !empty(request('search.value'))) {
                $search = request('search.value');
                $query->where(function ($q) use ($search) {
                    $q->whereAny(['note->en', 'note->ar'], 'like', '%' . $search . '%');
                });

                # code...
            }
        })->addColumn('note', function ($slider) {
            return $slider->getTranslation('note', app()->getLocale());
        })->addColumn('image', function ($slider) {
            return view('dashboard.sliders.image', ['slider' => $slider]);
        })->addColumn('actions', function ($slider) {
            return view('dashboard.sliders.action', ['slider' => $slider]);
        })->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin','designer'])) {
            abort(403);
        }
        $data = $request->validate([
            'note' => ['required', 'array'],
            'note.en' => ['required', 'string'],
            'note.ar' => ['required', 'string'],
            'image' => "required|image|mimes:png,jpg,svg,jpeg,webp"
        ]);
        $fileName = $request->image;
        $newFileName = time() . '-' . $fileName->getClientOriginalName();
        $fileName->storeAs('slider', $newFileName, 'public');
        $data['file_name'] = $newFileName;
        $slider = Slider::create($data);
        if ($slider) {

            return response()->json(['status' => 201, 'message' => "Slider Added Successfully"]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin','designer'])) {
            abort(403);
        }
        $slider = Slider::find(request('slider'));
        $data = $request->validate([
            'note' => ['required', 'array'],
            'note.en' => ['required', 'string'],
            'note.ar' => ['required', 'string'],
            'image' => "nullable|image|mimes:png,jpg,svg,jpeg,webp"
        ]);

        if ($request->image) {
            // حذف الصورة القديمة إذا كانت موجودة
            if ($slider->file_name && Storage::exists('public/slider/' . $slider->lfile_name)) {
                Storage::delete('public/logo/' . $slider->file_name);
            }

            // حفظ الصورة الجديدة
            $image = $request->image;
            $newImage = time() . '-' . $image->getClientOriginalName();
            $image->storeAs('slider', $newImage, 'public');
            $data['file_name'] = $newImage;
        }
        $slider->update($data);
        return response()->json(['message'=>"The Slider Has Been Updated",'status'=>201]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin','designer'])) {
            abort(403);
        }
       $slider=Slider::find(request('slider'));
       Storage::delete('public/logo/' . $slider->file_name);
       $slider->delete();
       return response()->json(['msg'=>'The Slider Has Been Deleted Successfully']);
    }
}
