<button type="button"
    class="btn btn-danger btn-min-width btn-glow mr-1 mb-1 del "id="{{ $admin->id }}">{{trans('admin.delete')}}</button>

<button class="btn btn-success btn-min-width btn-glow mr-1 mb-1 text-white" data-bs-toggle="modal"
    data-bs-target="#add_role_{{ $admin->id }}">{{trans('admin.assign_role')}}</button>
@include('dashboard.admins.addRoles')
<script>
    $(document).off('click', '.del').on('click', '.del', function () {
    let id = $(this).attr('id');
    let url = "{{ route('admins.destroy', ':id') }}";
    url = url.replace(":id", id);
    console.log(url);

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
                type: "DELETE", // <-- هنا التعديل
                data: {
                    _token: "{{ csrf_token() }}" // <-- مهم جدًا
                },
                success: function (data) {
                    if (data.status == 200) {
                        toastr.success(data.msg)
                        $('.admins-bar').html(data.countadmins)
                        $('#admins_table').DataTable().ajax.reload(null, false);
                    }
                },
                error: function () {
                    toastr.error("Something went wrong.")
                }
            });
        }
    });
});

</script>
