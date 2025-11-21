<form class="review-form" wire:submit.prevent='submit'>
    <h5 class="comment-title">Have Any Question</h5>
    <div class=" account-inner-form">
        <div class="review-form-name">
            <label for="fname" class="form-label">{{__('front.name')}}*</label>
            <input type="text" id="fname" class="form-control" placeholder="Name"wire:model='name'@if (auth()->user())
            disabled
        @endif>
        @error('name')
            <strong class="text-danger">{{$message}}</strong>
        @enderror
        </div>
        <div class="review-form-name">
            <label for="email" class="form-label">{{__('front.email')}}*</label>
            <input type="email" id="email" class="form-control" placeholder="user@gmail.com"wire:model='email'@if (auth()->user())
                disabled
            @endif>
            @error('email')
            <strong class="text-danger">{{$message}}</strong>
        @enderror
        </div>
        <div class="review-form-name">
            <label for="subject" class="form-label">{{__('front.subject')}}*</label>
            <input type="text" id="subject" class="form-control" placeholder="Subject" wire:model='subject'/>
            @error('subject')
            <strong class="text-danger">{{$message}}</strong>
        @enderror
        </div>
    </div>
    <div class="review-textarea">
        <label for="floatingTextarea">{{__('front.message')}}*</label>
        <textarea class="form-control" placeholder="Write Massage..........." id="floatingTextarea" rows="3" wire:model='message'></textarea>
        @error('message')
            <strong class="text-danger">{{$message}}</strong>
        @enderror
    </div>
    <div class="login-btn">
        <button type="submit" class="shop-btn">{{__('front.send_now')}}</button>
    </div>
</form>
<script>

    window.addEventListener('success_Msg', function(event) {
        var successMsg = event.detail;  // الحصول على المعاملات المرسلة
        toastr.success(successMsg);  // عرض رسالة النجاح
    });
     window.addEventListener('Error_Msg', function(event) {
        var successMsg = event.detail;  // الحصول على المعاملات المرسلة
        toastr.error("You Should Login First");  // عرض رسالة النجاح
    });
</script>
