{{-- resources/views/cards/index.blade.php --}}




<div class="container mx-auto p-4">
    <h1 class="text-2xl mb-4">بطاقاتي المحفوظة</h1>
    <form action="{{route('cards.create')}}" method="POST">
        @csrf
        <select name="payment_method_id">
            @foreach ($paymentMethods as $method)
                <option value="{{ $method['PaymentMethodId'] }}">{{ $method['PaymentMethodEn'] }}</option>
            @endforeach
        </select>
        <button type="submit">Continue</button>
    </form>
    @if (session('success'))
        <div class="bg-green-100 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('cards.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-6 inline-block">
        أضف بطاقة جديدة
    </a>

    @if (count($cards) == 0)
        <p>لا توجد لديك بطاقات محفوظة.</p>
    @else
        <table class="w-full table-auto border">
            <thead>
                <tr class="bg-gray-200">
                    <th class="px-4 py-2">الماركة</th>
                    <th class="px-4 py-2">آخر 4 أرقام</th>
                    <th class="px-4 py-2">افتراضية؟</th>
                    <th class="px-4 py-2">إجراءات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cards as $card)
                    <tr>
                        <td class="border px-4 py-2">{{ $card->brand }}</td>
                        <td class="border px-4 py-2">**** **** **** {{ $card->last_four }}</td>
                        <td class="border px-4 py-2">
                            @if ($card->is_default)
                                نعم
                            @else
                                لا
                            @endif
                        </td>
                        <td class="border px-4 py-2 space-x-2">
                            @if (!$card->is_default)
                                <form action="{{ route('cards.default', $card) }}" method="POST" class="inline">
                                    @csrf
                                    <button class="text-blue-600">اجعلها افتراضية</button>
                                </form>
                            @endif

                            <form action="{{ route('cards.destroy', $card) }}" method="POST" class="inline"
                                onsubmit="return confirm('هل أنت متأكد؟');">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600">حذف</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
