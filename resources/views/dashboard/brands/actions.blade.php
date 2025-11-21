<a href="{{ route('brands.edit', $brand->slug) }}" class="btn  btn-primary">{{ __('categories.edit') }}</a>




<button class="deleteFN-btn btn  btn-danger" data-id="{{ $brand->id }}">{{trans('admin.final_delete')}}</button>
<button class=" delete-btn btn  btn-warning text-white" data-id="{{ $brand->id }}">{{trans('admin.soft_delete')}}</button>

<!-- Hidden forms -->
<form action="{{ route('brands.forcedelete', $brand->id) }}" id="deleteFormFinal-{{ $brand->id }}" class="d-none">

</form>

<form action="{{ route('brands.destroy', $brand->id) }}" id="deleteForm-{{ $brand->id }}" method="POST"
    class="d-none">
    @csrf
    @method('DELETE')
</form>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
    integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
    integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).on('click', '.deleteFN-btn', function(e) {
        e.preventDefault()
        let brand_id = $(this).attr('data-id')
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-success",
                cancelButton: "btn btn-danger"
            },
            buttonsStyling: false
        });
        swalWithBootstrapButtons.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it! ",
            cancelButtonText: "No, cancel!",
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $(`#deleteFormFinal-${brand_id}`).submit()
                swalWithBootstrapButtons.fire({
                    title: "Deleted!",
                    text: "Your file has been deleted.",
                    icon: "success"
                });

            } else if (

                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire({
                    title: "Cancelled",
                    text: "Your imaginary file is safe :)",
                    icon: "error"
                });
            }
        });
    })
</script>

<script>
    $(document).on('click', '.delete-btn', function(e) {
        e.preventDefault()
        let brand_id = $(this).attr('data-id')
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-success",
                cancelButton: "btn btn-danger"
            },
            buttonsStyling: false
        });
        swalWithBootstrapButtons.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it! ",
            cancelButtonText: "No, cancel!",
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                $(`#deleteForm-${brand_id}`).submit()
                swalWithBootstrapButtons.fire({
                    title: "Deleted!",
                    text: "Your file has been deleted.",
                    icon: "success"
                });

            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire({
                    title: "Cancelled",
                    text: "Your imaginary file is safe :)",
                    icon: "error"
                });
            }
        });
    })
</script>
