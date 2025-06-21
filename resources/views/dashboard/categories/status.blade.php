<style>
    /* إخفاء الـ checkbox */
    .switch {
        display: none;
    }

    /* تصميم الـ switch container */
    .switch-label {
        display: flex;
        align-items: center;
        justify-content: space-between;
        cursor: pointer;
        width: 120px;
        height: 30px;
        background: #dc3545;

        border-radius: 50px;
        position: relative;
        transition: background 0.3s ease;
        padding: 2px;
        font-family: Arial, sans-serif;
        font-size: 14px;
        font-weight: bold;
        color: white;
    }

    /* نص الـ YES / NO */
    .switch-label span {
        position: absolute;
        width: 100%;
        text-align: center;
        transition: opacity 0.3s ease;
    }

    .switch-label .yes {
        opacity: 0;
    }

    .switch-label .no {
        opacity: 1;
    }

    /* تصميم النقطة المتحركة */
    .switch-label::before {
        content: "";
        position: absolute;
        width: 26px;
        height: 26px;
        background: white;
        border-radius: 50%;
        top: 50%;
        left: 2px;
        transform: translateY(-50%);
        transition: 0.3s;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    /* عند تفعيل الـ switch */
    .switch:checked+.switch-label {
        background: #28a745;
        /* اللون الأخضر (YES) */
    }

    .switch:checked+.switch-label::before {
        left: calc(100% - 28px);
    }

    .switch:checked+.switch-label .yes {
        opacity: 1;
    }

    .switch:checked+.switch-label .no {
        opacity: 0;
    }
</style>
<div class="card-body">
    <input type="checkbox" class="switch"
        value="{{ $category->id }}"
        id="switch-{{ $category->id }}"
        name="{{ $category->id }}"
        data-group-cls="btn-group-sm"
        @if ($category->status == 'active') checked @endif>
    <label for="switch-{{ $category->id }}"
        class="switch-label">
        <span class="yes">{{__("countaries.active")}}</span>
        <span class="no">{{__("countaries.inactive")}}</span>
    </label>
</div>

