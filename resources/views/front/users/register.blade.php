<!DOCTYPE html>
<html lang="en">
<style>
    /* تصميم الزر الأساسي */
    .google-btn {
        display: inline-flex;
        align-items: center;
        background-color: #fff;
        border: 1px solid #dcdcdc;
        border-radius: 4px;
        padding: 8px 16px;
        text-decoration: none;
        transition: box-shadow 0.3s ease;
        font-family: Roboto, Arial, sans-serif;
    }

    /* تأثير hover عشان يظهر للمستخدم إن في تفاعل */
    .google-btn:hover {
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16);
    }

    /* لف المحيط اللي فيه أيقونة جوجل */
    .google-icon-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        background: #fff;
        border-radius: 50%;
        margin-right: 12px;
    }

    /* خصائص أيقونة جوجل */
    .google-icon {
        width: 18px;
        height: 18px;
    }

    /* نص الزر */
    .btn-text {
        font-size: 14px;
        color: #757575;
        font-weight: 500;
    }
</style>

@include('front.layouts.head')>

<body style="@if (app()->getLocale() == 'ar') direction:rtl; @endif">
    @include('front.layouts.header')

    @livewire('create-account')

    @include('front.layouts.footer')

    @include('front.layouts.script')
</body>

</html>
