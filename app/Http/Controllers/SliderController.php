<?php

namespace App\Http\Controllers;

use App\Http\Requests\SliderStoreRequest;
use App\Http\Requests\SliderUpdateRequest;
use App\Services\SliderService;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;

class SliderController extends Controller
{
    public function __construct(private readonly SliderService $sliderService)
    {
    }

    public function index()
    {
        if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin', 'designer'])) {
            abort(403);
        }

        return view('dashboard.sliders.index');
    }

    public function getData()
    {
        $sliders = $this->sliderService->query();

        return DataTables::of($sliders)
            ->addIndexColumn()
            ->filter(function ($query) {
                if (request()->has('search') && !empty(request('search.value'))) {
                    $search = request('search.value');
                    $query->where(function ($q) use ($search) {
                        $q->whereAny(['note->en', 'note->ar'], 'like', '%' . $search . '%');
                    });
                }
            })
            ->addColumn('note', function ($slider) {
                return $slider->getTranslation('note', app()->getLocale());
            })
            ->addColumn('image', function ($slider) {
                return view('dashboard.sliders.image', ['slider' => $slider]);
            })
            ->addColumn('actions', function ($slider) {
                return view('dashboard.sliders.action', ['slider' => $slider]);
            })
            ->make(true);
    }

    public function create()
    {
    }

    public function store(SliderStoreRequest $request)
    {
        if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin', 'designer'])) {
            abort(403);
        }

        $slider = $this->sliderService->create($request->validated(), $request->file('image'));

        if ($slider) {
            return response()->json(['status' => 201, 'message' => 'Slider Added Successfully']);
        }
    }

    public function show(string $id)
    {
    }

    public function edit(string $id)
    {
    }

    public function update(SliderUpdateRequest $request, string $id)
    {
        if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin', 'designer'])) {
            abort(403);
        }

        $this->sliderService->update(request('slider', $id), $request->validated(), $request->file('image'));

        return response()->json(['message' => 'The Slider Has Been Updated', 'status' => 201]);
    }

    public function destroy(string $id)
    {
        if (!Gate::forUser(auth()->guard('admin')->user())->any(['super-admin', 'designer'])) {
            abort(403);
        }

        $this->sliderService->delete(request('slider', $id));

        return response()->json(['msg' => 'The Slider Has Been Deleted Successfully']);
    }
}
