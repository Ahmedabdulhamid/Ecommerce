<button type="button" class="btn btn-danger btn-min-width btn-glow mr-1 mb-1 del" id="{{ $role->id }}">{{__('admin.delete')}}</button>
<button class="btn btn-success btn-min-width btn-glow mr-1 mb-1 text-white show" data-bs-toggle="modal" data-bs-target="#role_{{$role->id}}">{{__('admin.show')}}</button>
@include('dashboard.Roles.show')
<a class="btn btn-info btn-min-width btn-glow mr-1 mb-1 text-white" href="{{ route('roles.show', $role->id) }}">{{__('admin.edit')}}</a>
<script>
    $(document).off('click', '.del').on('click', '.del', function() {
        let id = $(this).attr('id')
        console.log(id);

        let url = "{{ route('roles.destroy', ':id') }}"
        url = url.replace(':id', id)
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
                    type: "DELETE",
                    data: {
                        '_token': "{{ csrf_token() }}",

                    },
                    success: function(data) {
                        toastr.success(data.msg)

                        $('#Role_table').DataTable().ajax.reload(null, false);
                    }

                })

            }
        });

    })



</script>
