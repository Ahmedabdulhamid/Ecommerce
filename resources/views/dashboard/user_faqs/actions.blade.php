<button class="btn btn-success btn-min-width btn-glow mr-1 mb-1 text-white"data-bs-toggle="modal" data-bs-target="#exampleModal_{{$userQuestion->id}}">{{__('admin.answer')}}</button>
@include('dashboard.user_faqs.modal')


<button type="button" class="btn btn-danger btn-min-width btn-glow mr-1 mb-1 del"  id="{{$userQuestion->id}}">{{__('admin.delete')}}</button>

<script>
    $(document).off('click','.del').on('click','.del',function(){
        let id=$(this).attr('id');
        let url = "{{ route('user-faqs.destroy', ':id') }}"
        url = url.replace(":id", id)


         Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
       if (result.isConfirmed) {
    $.ajax({
        url: url,
        type: "DELETE",
        data: {
            "_token": "{{ csrf_token() }}", // ✅ CSRF صح
            "id": id
        },
        success: function (data) {
            if (data.status == 200) {
                console.log(data);

                toastr.success(data.message);
                $('.user-ques-bar').html(data.count)
                $('#UserFaq_table').DataTable().ajax.reload(null, false);

            } else {
                toastr.error(data.msgErr);
            }
        },
        error: function () {
            toastr.error("حدث خطأ أثناء الحذف");
        }
    });
}

    });

    })
</script>
