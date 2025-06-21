 <div class="col-lg-6">
     <div class="form-section">
         <form wire:submit.prevent='submit'>

             <div class="currentpass form-item">
                 <label for="currentpass" class="form-label">Current Password*</label>
                 <input type="password" class="form-control" id="currentpass"
                     placeholder="******"wire:model='current_password'>
                 @error('current_password')
                     <span class="text-danger fs-4">{{ $message }}</span>
                 @enderror
             </div>
             <div class="password form-item">
                 <label for="pass" class="form-label">Password*</label>
                 <input type="password" class="form-control" id="pass" placeholder="******"
                     wire:model='new_password'>
                 @error('new_password')
                     <span class="text-danger fs-4">{{ $message }}</span>
                 @enderror

             </div>
             <div class="re-password form-item">
                 <label for="repass" class="form-label">Re-enter Password*</label>
                 <input type="password" class="form-control" id="repass"
                     placeholder="******"wire:model='new_password_confirmation'>

             </div>
             <div class="form-btn">
                 <button type="submit" class="shop-btn">Upldate Password</button>
                 <button type="reset" class="shop-btn cancel-btn">Cancel</button>
             </div>
         </form>

     </div>
 </div>
<script>
    window.addEventListener('passwordChanged',function(){
        toastr.success('Your Password Changed Successfully')
    })
</script>
