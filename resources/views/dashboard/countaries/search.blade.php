@php
    use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
    $lang = LaravelLocalization::getCurrentLocale();

    use Flasher\Prime\FlasherInterface;

@endphp
<table class="table mb-0">
    <thead>
        <tr>
            <th>{{ __('countaries.index') }}</th>
            <th>{{ __('countaries.governorate') }}</th>
            <th>{{ __('countaries.flag') }}</th>
            <th>{{ __('countaries.status') }}</th>
            <th>{{ __('countaries.price') }}</th>
            <th>{{ __('countaries.edit_charge') }}</th>
        </tr>
    </thead>
    <tbody>
        @if ($lang == 'en')
            @foreach ($country->governorates as $governorate => $value)
                <tr>
                    <td>{{ ++$governorate }}</td>
                    <td><a href=""
                            class="text-dark">{{ $value->getTranslation('name', 'en') }}</a>
                    </td>

                    <td><i
                            class="flag-icon flag-icon-{{ $country->flag_icon }}"></i>
                    </td>
                    <td>
                        <div class="card-body">
                            <input type="checkbox" class="switch"
                                value="{{ $value->id }}"
                                name="{{ $value->id }}"
                                id="switch-{{ $value->id }}"
                                data-group-cls="btn-group-sm"
                                @if ($value->status == 'active') checked @endif />
                            <label for="switch-{{ $value->id }}"
                                class="switch-label">
                                <span
                                    class="yes">{{ __('countaries.active') }}</span>
                                <span
                                    class="no">{{ __('countaries.inactive') }}</span>
                            </label>
                        </div>
                    </td>
                    <td class="td_price-{{ $value->id }}">
                        {{ $value->price }}
                    </td>
                    <td><!-- Button trigger modal -->
                        @include('dashboard.partials.modal')
                    </td>
                </tr>
            @endforeach
        @else
            @foreach ($country->governorates as $governorate => $value)
                <tr>
                    <td>{{ ++$governorate }}</td>
                    <td><a href=""
                            class="text-dark">{{ $value->getTranslation('name', 'ar') }}</a>
                    </td>
                    <td><i
                            class="flag-icon flag-icon-{{ $country->flag_icon }}"></i>
                    </td>

                    <td>
                        <div class="card-body">
                            <input type="checkbox" class="switch"
                                value="{{ $value->id }}"
                                id="switch-{{ $value->id }}"
                                name="{{ $value->id }}"
                                data-group-cls="btn-group-sm"
                                @if ($value->status == 'active') checked @endif>
                            <label for="switch-{{ $value->id }}"
                                class="switch-label">
                                <span
                                    class="yes">{{ __('countaries.active') }}</span>
                                <span
                                    class="no">{{ __('countaries.inactive') }}</span>
                            </label>
                        </div>
                    </td>
                    <td class="td_price-{{ $value->id }}">
                        {{ $value->price }}
                    </td>

                    <td><!-- Button trigger modal -->
                        @include('dashboard.partials.modal')
                    </td>


                </tr>
            @endforeach
        @endif



    </tbody>
</table>
