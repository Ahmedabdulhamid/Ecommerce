
<button class="btn btn-info btn-min-width btn-glow "data-bs-toggle="modal" data-bs-target="#slider_{{$slider->id}}" >{{__('admin.edit')}}</button>
@include('dashboard.sliders.edit')
<button class="btn btn-primary   "data-bs-toggle="modal" data-bs-target="#slide1r_{{$slider->id}}">
  {{__('admin.full_screen')}}  <i class="fa fa-expand"></i>
</button>
@include('dashboard.sliders.fullscreen')

<button type="button" class="btn btn-danger btn-min-width btn-glow  del"id={{$slider->id}}>{{__('admin.delete')}}</button>
<script>
     $(document).on('click', '.del', function() {
            let id = $(this).attr('id')
            let url = "{{ route('sliders.destroy', ':id') }}"
            url = url.replace(':id', id)
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
                           //$('.product-bar').html(data.count)
                           $('#Slider_table').DataTable().ajax.reload(null, false);
                        }

                    })

                }
            });



        })
</script>
