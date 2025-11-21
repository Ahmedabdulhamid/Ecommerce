<form class="number-tab-steps wizard-circle" enctype="multipart/form-data" wire:submit='submit'>
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
    {{-- First Step --}}
    <fieldset class="@if ($currentStep != 1) displayNone @endif">
        <h6>{{__('admin.step_1')}}</h6>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name_ar">{{__('admin.name_in_ar')}}:</label>
                    <input type="text" class="form-control" wire:model='name_ar' id="name_ar">
                </div>
                @error('name_ar')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name_en">{{__('admin.name_in_en')}}</label>
                    <input type="text" class="form-control" id="name_en" wire:model='name_en'>
                </div>
                @error('name_en')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="small_desc_ar">{{__('admin.sm_desc_ar')}}:</label>
                    <textarea type="text" class="form-control" id="desc_ar" wire:model='small_desc_ar' rows="6"></textarea>
                </div>
                @error('small_desc_ar')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="small_desc_ar">{{__('admin.sm_desc_en')}}:</label>
                    <textarea type="text" class="form-control" id="desc_ar" wire:model='small_desc_en' rows="6"></textarea>
                </div>
                @error('small_desc_en')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>


        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="desc_ar">{{__('admin.desc_ar')}} :</label>
                    <textarea type="text" class="form-control" id="desc_ar" wire:model='desc_ar' rows="8"></textarea>
                </div>
                @error('desc_ar')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="desc_en">{{__('admin.desc_en')}} :</label>
                    <textarea type="text" class="form-control" id="desc_ar" wire:model='desc_en' rows="8"></textarea>
                </div>
                @error('desc_en')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="location1">{{__('admin.select_cat')}}:</label>
                    <select class="custom-select form-control" wire:model='category_id'>
                        <option value="" selected>{{__('admin.select')}}</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">
                                {{ $category->getTranslation('name', app()->getLocale()) }}</option>
                        @endforeach
                    </select>
                </div>
                @error('category_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="location1">{{__('admin.select_br')}} :</label>
                    <select class="custom-select form-control" wire:model='brand_id'>
                        <option value="" selected>{{__('admin.select')}}</option>
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}">
                                {{ $brand->getTranslation('name', app()->getLocale()) }}</option>
                        @endforeach
                    </select>
                </div>
                @error('brand_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <button class="btn btn-primary" type="button" wire:click='secondStep'>{{__('admin.next')}}</button>

    </fieldset>
    {{-- End First Step --}}


    {{-- Second Step --}}
    <fieldset class="@if ($currentStep != 2) displayNone @endif">
        <h6>{{__('admin.step_2')}}</h6>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="hasVar">{{__('admin.has_variants')}} :</label>
                    <select class="custom-select form-control" wire:model.live='hasVar'>

                        <option value="0">{{__('admin.no')}}</option>
                        <option value="1">{{__('admin.yes')}}</option>

                    </select>
                </div>
                @error('hasVar')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <div class="form-group">
                    <label for="tages">{{__('admin.tags')}} :</label>
                    <input type="text" class="form-control" id="tages" wire:model='tags'>
                </div>
                @error('tags')
                    <span class="text-danger">{{ $message }}</span>
                @enderror

            </div>
            <div class="col-md-6">
                @if ($hasVar == 0)
                    <div class="form-group">
                        <label for="price">{{__('admin.price')}} :</label>
                        <input type="number" class="form-control" id="price" wire:model='price'>

                    </div>
                    @error('price')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                @endif
                <div class="form-group">
                    <label for="manage_stock">{{__('admin.manage_quantity')}} :</label>
                    <select class="custom-select form-control" wire:model.live='manage_stock'>

                        <option value="0">{{__('admin.no')}}</option>
                        <option value="1">{{__('admin.yes')}}</option>

                    </select>
                </div>
                @error('manage_stock')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                @if ($manage_stock == 1 && !$hasVar)
                    <div class="form-group">
                        <label for="quantity1">{{__('admin.quantity')}} :</label>
                        <input id="quantity1" type="number" min="1" wire:model='quantity'
                            class="form-control">
                    </div>
                    @error('quantity')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                @endif
                <div class="form-group">
                    <label for="sku">{{__('admin.sku')}} :</label>
                    <input type="string" class="form-control" id="sku" wire:model='sku'>

                </div>
                @error('sku')
                    <span class="text-danger">{{ $message }}</span>
                @enderror


            </div>
        </div>
        <div class="row">

            @if ($hasVar == 1)

                <hr class="bf-black">

                @if (count($prices) > 0 )
                    @for ($i = 0; $i < $valueRowCount; $i++)
                        <div class="row">
                            <hr>
                            <div class="col-3">
                                <label for="prices">{{__('admin.product_price')}} :</label>
                                <input type="string" class="form-control" id="prices"
                                    wire:model='prices.{{ $i }}'>
                                @error('prices')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                @error('prices.' . $i)
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="col-3">
                                <label for="quantities">{{__('admin.product_quantity')}} :</label>
                                <input type="string" class="form-control" id="quantities"
                                    wire:model='quantities.{{ $i }}'>
                                @error('quantities')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                @error('quantities.' . $i)
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            @foreach ($productAttributes as $index => $attr)
                                <div class="col-3">
                                    <label for="hasVar">{{ $attr->name }} :</label>
                                    <select class="custom-select form-control"
                                        wire:model='attributeValues.{{ $i }}.{{ $attr->id }}'>

                                        <option value="">{{__('admin.select')}}</option>
                                        @foreach ($attr->attr_values as $item)
                                            <option value="{{ $item->id }}">
                                                {{ $item->value }}
                                            </option>
                                        @endforeach

                                    </select>
                                    @error('attributeValues')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    @error('attributeValues.' . $i)
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    @error('attributeValues.' . $i . '.' . $attr->id)
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            @endforeach
                        </div>
                    @endfor
                @endif

                <hr>
                <div class="d-inline-block my-3">
                    <button class="btn btn-success  d-inline-block" type="button"
                        wire:click='addNewVariant'style='color:white;'>
                       {{__('admin.add_product_var')}} <i class="fa-solid fa-plus"></i>
                    </button>
                    <button class="btn btn-danger d-inline-block" type="button" wire:click='removeVariant'
                        @if ($valueRowCount == 1) disabled @endif>
                        {{__('admin.rm_product_var')}} <i class="fa-solid fa-minus"></i>
                    </button>
                </div>
            @endif



        </div>
        <button class="btn btn-primary" type="button" wire:click='thirdStep'>{{__('admin.next')}}</button>
        <button class="btn btn-light" type="button" wire:click='back(1)'>{{__('admin.previous')}}</button>
    </fieldset>
    {{-- End Secon Step --}}
    {{-- Third Step --}}
    <fieldset class="@if ($currentStep != 3) displayNone @endif">
        <h6>{{__('admin.step_3')}}</h6>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="eventName1">{{__('admin.has_discount')}} :</label>
                    <select class="custom-select form-control" wire:model.live='has_discount'>

                        <option value="0">{{__('admin.no')}}</option>
                        <option value="1">{{__('admin.yes')}}</option>


                    </select>
                </div>

                @error('has_discount')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                @if ($has_discount == 1)
                    <div class="form-group">
                        <label for="discount">{{__('admin.discount')}} :</label>
                        <input type="number" id="discount" class="form-control datetime" wire:model='discount'>

                    </div>
                    @error('discount')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                @endif
                @if ($has_discount == 1)
                    <div class="form-group">
                        <label for="start_discount">{{__('admin.start_date')}} :</label>
                        <input type="date" id="start_discount" class="form-control datetime"
                            wire:model='start_discount'>

                    </div>
                    @error('start_discount')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                @endif


                @if ($has_discount == 1)
                    <div class="form-group">
                        <label for="end_discount">{{__('admin.end_date')}} :</label>
                        <input type="date" id="end_discount" class="form-control datetime"
                            wire:model='end_discount'>

                    </div>
                    @error('end_discount')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                @endif


            </div>
            <div class="col-md-6">


                <div class="form-group">
                    <label for="available_for">{{__('admin.availabe_for')}} :</label>
                    <input type="date" id="available_for" class="form-control datetime"
                        wire:model='available_for'>

                </div>
                @error('available_for')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <button class="btn btn-primary" type="button" wire:click='fourthStep'>{{__('admin.next')}}</button>
        <button class="btn btn-light" type="button" wire:click='back(2)'>{{__('admin.previous')}}</button>
    </fieldset>
    {{-- End Third Step --}}
    {{-- Fourth Step --}}
    <fieldset class="@if ($currentStep != 4) displayNone @endif">
        <h6>{{__('admin.step_4')}}</h6>
        <div class="row">

            <div class="col-12">
                <div class="form-group">
                    <label for="decisions1">{{__('admin.upload_images_pro')}}</label>
                    <input type="file" class="form-control" wire:model.live="images2" multiple>

                </div>

            </div>
            @error('images2.*')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            @error('images2')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            @if ($images)



                <div class="d-flex flex-wrap gap-2">
                    @foreach ($images as $index => $image)
                        <div class="position-relative m-2">
                            <img src="{{ asset('storage/products/' . $image->file_name) }}" alt=""
                                class="img-thumbnail rounded-md" width="300" height="300">
                            <button class="btn btn-danger btn-sm position-absolute top-0 end-0" type="button"
                                wire:click="deleteImage({{ $index }},'{{ $image->id }}')">
                                <i class='fa fa-trash'></i>
                            </button>

                        </div>
                    @endforeach

                </div>


            @endif
            @if ($images2)
                <div class="d-flex flex-wrap gap-2">
                    @foreach ($images2 as $index => $image)
                        @if (Str::startsWith($image->getMimeType(), 'image/'))
                            <div class="position-relative m-2">
                                <img src="{{ $image->temporaryUrl() }}" alt=""
                                    class="img-thumbnail rounded-md" width="300" height="300">
                                <button class="btn btn-danger btn-sm position-absolute top-0 end-0" type="button"
                                    wire:click="deleteImage2({{ $index }})">
                                    <i class='fa fa-trash'></i>
                                </button>
                                <button class="btn btn-primary btn-sm position-absolute top-0">
                                    <i class="fa fa-expand"></i>
                                </button>
                            </div>
                        @endif
                    @endforeach

                </div>
            @endif

        </div>
        <button class="btn btn-primary" type="button" wire:click='fivthStep'>{{__('admin.next')}}</button>
        <button class="btn btn-light" type='button' wire:click='back(3)'>{{__('admin.previous')}}</button>
    </fieldset>
    {{-- End Fourth Step --}}
    {{-- END STEP --}}
    <fieldset class="@if ($currentStep != 5) displayNone @endif">
        <h6>{{__('admin.step_5')}}</h6>


        <button class="btn btn-primary" type="submit">{{__('admin.submit')}}</button>
        <button class="btn btn-light" type='button' wire:click='back(4)'>{{__('admin.previous')}}</button>
    </fieldset>
</form>
