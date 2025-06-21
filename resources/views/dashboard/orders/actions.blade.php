<button class="btn btn-social-icon mr-1 mb-1 btn-outline-google del"id="{{ $order->id }}">
    <span class="la la-trash font-medium-4"></span>
</button>
<button class="btn btn-social-icon mr-1 mb-1 btn-outline-facebook"data-bs-toggle="modal" data-bs-target="#exampleModal"><span class="la la-edit"></span>
</button>

<a href="{{ route('orders.show', $order->id) }}" class="btn btn-social-icon mr-3 mb-1 btn-outline-dropbox">
    <span class="la la-eye font-medium-4"></span>
</a>
@include('dashboard.orders.orersStatus',['order'=>$order])
<script>


    $(document).off('click', '.del').on('click', '.del', function() {
        let id = $(this).attr('id');
        let url = "{{ route('orders.destroy', ':id') }}"
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
                type: "GET",
                success: function(data) {
                   if (data.status==200) {
                    toastr.success(data.msg)
                    $('.order-bar').html(data.countOrders)
                    $('#Order_table').DataTable().ajax.reload(null, false);
                   }else{
                    toastr.error(data.msgErr)
                   }

                },
                error: function() {

                }
            })

        }
    });




    })
</script>
