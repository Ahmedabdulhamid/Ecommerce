<div class="review-form">
    <h5 class="comment-title">Get In Touch</h5>
    <form wire:submit.prevent='submit'>
        <div class="account-inner-form">
            <div class="review-form-name">
                <label for="fname" class="form-label">{{__('front.name')}}*</label>
                <input type="text" id="fname" class="form-control" placeholder="Name" wire:model='name' />
                @error('name')
                 <span class="fs-4 text-danger">{{$message}}</span>

                @enderror
            </div>
            <div class="review-form-name">
                <label for="email" class="form-label">{{__('front.email')}}*</label>
                <input type="email" id="email" class="form-control" placeholder="user@gmail.com" wire:model='email'/>
                 @error('email')
                 <span class="fs-4 text-danger">{{$message}}</span>

                @enderror
            </div>
            <div class="review-form-name">
                <label for="subject" class="form-label">{{__('front.subject')}}*</label>
                <input type="text" id="subject" class="form-control" placeholder="Subject"wire:model='subject' />
                 @error('subject')
                 <span class="fs-4 text-danger">{{$message}}</span>
                @enderror
            </div>
        </div>
        <div class="review-textarea">
            <label for="floatingTextarea">{{__('front.message')}}*</label>
            <textarea class="form-control" placeholder="Write Massage..........." id="floatingTextarea" rows="3"wire:model='message'></textarea>
             @error('message')
                 <span class="fs-4 text-danger">{{$message}}</span>
                @enderror
        </div>
        <div class="login-btn">
            <button class="shop-btn" type="submit">{{__('front.send_now')}}</button>
        </div>

    </form>

</div>
<script>
    window.addEventListener('Contact_Created',function(){
        toastr.success('Contect Created Successfully!')
    })
</script>
