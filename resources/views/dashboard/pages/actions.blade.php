<a class="btn btn-primary" href="{{route('pages.show',$page->id)}}">
  {{__('sliders.show_page')}}
</a>

<button type="button" class="btn btn-danger btn-min-width btn-glow  del"id="{{$page->id}}">{{__('sliders.delete_page')}}</button>
<a href="{{route('pages.edit',$page->id)}}" class="btn btn-warning btn-min-width btn-glow  text-white">{{__('sliders.update_page')}}</a>
<script>
    $(document).on('click', '.del', function() {
           let id = $(this).attr('id')
           let url = "{{ route('pages.destroy', ':id') }}"
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
                         $('#Page_table').DataTable().ajax.reload(null, false);
                       }

                   })

               }
           });



       })
</script>
