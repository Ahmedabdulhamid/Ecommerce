<a href="{{ route('categories.edit', $category->slug) }}" class="btn btn-sm btn-primary">{{ __('categories.edit') }}</a>
<button class="btn btn-sm btn-outline-danger dropdown-toggle" type="button" data-bs-toggle="dropdown"
    aria-expanded="false">{{ __('categories.delete') }}</button>
<ul class="dropdown-menu">
    <form action="{{ route('categories.forcedelete',$category->id) }}"
        id="deleteFormFinal-{{ $category->id }}" class="d-inline">
        <button class="dropdown-item delete-btnr deleteFN-btn"
        data-id="{{ $category->id }}"
        >Final
            Delete
        </button>
    </form>

    <form id="deleteForm-{{ $category->id }}" action="{{ route('categories.destroy', $category->id) }}"method="POST"
        class="soft_delete">
        @csrf
        @method('DELETE')
        <button class="dropdown-item delete-btn" data-id="{{ $category->id }}">Soft
            Deletes</button>

    </form>





</ul>
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
        let category_id = $(this).attr('data-id')
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
                $(`#deleteFormFinal-${category_id}`).submit()
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

<script>
    $(document).on('click', '.delete-btn', function(e) {
        e.preventDefault()
        let category_id = $(this).attr('data-id')
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
                $(`#deleteForm-${category_id}`).submit()
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
