@php
    use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
    $lang = LaravelLocalization::getCurrentLocale();

    use Flasher\Prime\FlasherInterface;

@endphp
@section('title',__('admin.roles_page'))
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="rtl">
@include('dashboard.categories.partials.head')

<body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar" data-open="click"
    data-menu="vertical-menu-modern" data-col="2-columns">


    @include('dashboard.partials.nav')
    @include('dashboard.partials.sideBar')
    <div class="app-content content">
        {!! Flasher::render() !!}
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>اسم الأدمن</th>

                    <th>إدارة الأدوار</th>
                    <th>إدارة الصلاحيات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($admins as $admin)
                    <tr>

                        <td>{{ $admin->name }}</td>

                        <td>
                            <form method="POST" action="{{ route('superadmins.assignRole') }}">
                                <input type="hidden" name="admin_id" value="{{ $admin->id }}">
                                @csrf

                                @foreach ($roles as $role)
                                    <div>
                                        @if ($lang == 'en')
                                            <input type="checkbox"class="checkbox px-3"
                                                name="roles[]"value="{{ $role->id }}">
                                            <label for="">{{ $role->getTranslation('name', 'en') }}</label>
                                        @else
                                            <input type="checkbox"class="checkbox px-3"
                                                name="roles[]"value="{{ $role->id }}">
                                            <label for="">{{ $role->getTranslation('name', 'ar') }}</label>
                                        @endif


                                    </div>
                                @endforeach


    </div>

    <button type="submit" class="btn btn-primary btn-sm mt-2">حفظ</button>
    </form>
    </td>
    <td>

        <form method="POST" action="{{ route('superadmins.assignPermission') }}"
            style="max-height: 300px;overflow-y:scroll">
            <input type="hidden" name="admin_id" value="{{ $admin->id }}">
            @csrf

            @foreach ($permissions as $permission)
                <div>
                    @if ($lang == 'en')
                        <input type="checkbox"class="checkbox px-3" name="permissions[]"value="{{ $permission->id }}">
                        <label for="">{{ $permission->getTranslation('name', 'en') }}</label>
                    @else
                        <input type="checkbox"class="checkbox px-3" name="permissions[]"value="{{ $permission->id }}">
                        <label for="">{{ $permission->getTranslation('name', 'ar') }}</label>
                    @endif

                </div>
            @endforeach



            <button type="submit" class="btn btn-success btn-sm mt-2">حفظ</button>
        </form>
    </td>
    </tr>
    @endforeach
    </tbody>
    </table>
    </div>

    @include('dashboard.partials.footer')
    <!-- BEGIN VENDOR JS-->
    @include('dashboard.partials.scripts')
</body>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
</script>

</body>

</html>
