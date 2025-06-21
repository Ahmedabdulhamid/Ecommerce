<button type="button" class="btn btn-danger btn-min-width btn-glow mr-1 mb-1 del "id="{{$permission->id}}">Delete</button>
<button class="btn btn-info btn-min-width btn-glow mr-1 mb-1" data-bs-toggle="modal"
    data-bs-target="#exampleModal_{{$permission->id}}">Edit</button>
    @include('dashboard.permissions.edit')

<script>
   $(document).off('click','.del').on('click','.del',function(){
        let id=$(this).attr('id')
        let url="{{route('permissions.destroy',':id')}}"
        url=url.replace(':id',id)
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

                           $('#Permission_table').DataTable().ajax.reload(null, false);
                        }

                    })

                }
            });

    })
</script>
