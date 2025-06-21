<button class="btn btn-primary" type="button"data-bs-toggle="modal" data-bs-target="#exampleModal_{{ $question->id }}">
    {{ __('front.show_question') }}
</button>
@include('dashboard.questions.show')
<button class="btn btn-success text-white" type="button" data-bs-toggle="modal"
    data-bs-target="#reply_{{ $question->id }}">
    {{ __('front.reply') }}
</button>
@include('dashboard.questions.reply')

<button type="button"
    class="btn btn-danger btn-min-width btn-glow  del"id="{{ $question->id }}">{{ __('front.delete') }}</button>

<script>
    $(document).on('click', '.del', function() {
        let id = $(this).attr('id')
        let url = "{{ route('questions.destroy', ':id') }}"
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
                        $('#Question_table').DataTable().ajax.reload(null, false);
                    }

                })

            }
        });



    })
</script>
