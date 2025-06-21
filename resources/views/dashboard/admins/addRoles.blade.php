<div class="modal fade" id="add_role_{{ $admin->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{ $admin->name }}
                <form class="assign_role" id="{{$admin->id}}">
                    @foreach ($roles as $role)
                        <div class="my-2 mx-3">
                            <input type="checkbox" class="checkbox px-3" name="roles[]"value="{{ $role->id }}" @checked($admin->hasRole($role))>
                            <label for="">{{ $role->getTranslation('name', app()->getLocale()) }}</label>

                        </div>
                    @endforeach
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Assign Role</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<script>
    $(document).off('submit','.assign_role').on('submit','.assign_role',function(e){
        e.preventDefault()
       let id=$(this).attr('id')
       let url="{{route('admins.assignRole',':id')}}";
       url=url.replace(':id',id);
       let formData=new FormData($(this)[0]);
       formData.append("_token","{{csrf_token()}}")
       $.ajax({
        url:url,
        type:"POST",
        processData: false,
        contentType: false,
        data:formData,
        success:function(data){
            toastr.success(data.msg)
            $('#admins_table').DataTable().ajax.reload(null, false)
            let modalEl = document.getElementById(`add_role_${id}`);

                    let modal = bootstrap.Modal.getInstance(modalEl);
                    if (modal) {
                        modal.hide();

                        modalEl.addEventListener('hidden.bs.modal', function() {
                            console.log('Modal is fully hidden.');

                            // تأكد إنه مفيش backdrop فاضل
                            document.querySelectorAll('.modal-backdrop').forEach(el => el
                                .remove());

                            // تأكد من مسح كلاس modal-open لو لسه موجود
                            document.body.classList.remove('modal-open');
                            document.body.style.overflow =
                                ''; // ترجع الـ overflow للوضع الطبيعي
                        }, {
                            once: true
                        });
                    }
        },
        error:function(reject){
            let resp=JSON.parse(reject.responseText)
            $.each(resp.errors,function(key,value){
                toastr.error(value)
            })
        }

       })



    })
</script>
