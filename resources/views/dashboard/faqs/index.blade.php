@section('title',__('admin.faqs_page'))
<!DOCTYPE html>
<html lang="en">
@include('dashboard.categories.partials.head')


<body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar" data-open="click"
    data-menu="vertical-menu-modern" data-col="2-columns">

    @include('dashboard.partials.nav')
    @include('dashboard.partials.sideBar')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">{{__('admin.faqs_page')}}</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">{{__('admin.home')}}</a>
                                </li>


                            </ol>
                        </div>
                    </div>
                </div>

            </div>
            <section id="sortable-collapsibles">
                <div class="row">
                    <div class="col-12 mt-1 mb-3">
                        <h4>{{__('admin.faqs_page')}}</h4>
                        <hr>
                    </div>

                </div>
                <button class="btn btn-primary my-5" data-bs-toggle="modal" data-bs-target="#exampleModal">{{__('admin.create_faqs')}}</button>
                @include('dashboard.faqs.create')
                <div class="row ">
                    <div class="col-xl-12 col-lg-12 parent">

                        @forelse ($faqs as $faq)
                            <div id="parent_{{ $faq->id }}">
                                <div id="heading0{{ $loop->iteration }}" role="tabpane" class="card-header">
                                    <div class="d-flex justify-content-between">
                                        <a data-toggle="collapse" data-parent="#accordionWrapa1"
                                            href="#accordion0{{ $loop->iteration }}" aria-expanded="true"
                                            aria-controls="accordion0{{ $loop->iteration }}" class="font-medium-1"
                                            id="ques_{{ $faq->id }}">{{ $faq->getTranslation('questions', app()->getLocale()) }}#{{ $loop->iteration }}</a>
                                        <div class="icons-action">
                                            <a href="#" data-bs-toggle="modal"
                                                data-bs-target="#faq_{{ $faq->id }}"><i
                                                    class="fa-solid fa-pen-to-square"></i></a>
                                            <a href="#" class="text-danger del_btn"id="{{ $faq->id }}"><i
                                                    class="fa-solid fa-xmark"></i></a>
                                        </div>

                                    </div>


                                </div>
                                <div id="accordion0{{ $loop->iteration }}" role="tabpane1"
                                    aria-labelledby="heading0{{ $loop->iteration }}"
                                    class="card-collapse collapse {{ $loop->index == 0 ? 'show' : '' }}"
                                    aria-expanded="true">
                                    <div class="card-body" id="ans_{{ $faq->id }}">
                                        {{ $faq->getTranslation('answers', app()->getLocale()) }}
                                    </div>
                                </div>
                            </div>

                            @include('dashboard.faqs.edit')
                        @empty
                            <h4>No Faqs Found !</h4>
                        @endforelse
                    </div>

                </div>

            </section>
        </div>
    </div>
    @include('dashboard.partials.footer')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @include('dashboard.categories.partials.scribts')
    <script>
        $(document).on('submit', '.create_faq', function(e) {
            e.preventDefault();
            let formData = new FormData($(this)[0]);
            formData.append('_token', '{{ csrf_token() }}');
            let location = "{{ app()->getLocale() }}";
            let uniqueId = new Date().getTime();

            $.ajax({
                url: "{{ route('faqs.store') }}",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {

                    if (data.status == 'success') {
                        $('.create_faq')[0].reset();
                        $('#exampleModal').modal('hide')

                        toastr.success(data.message)
                        $('.faq-bar').html(data.count)
                        let question = location == 'ar' ? data.faq.questions.ar : data.questions.en
                        let answer = location == 'ar' ? data.faq.answers.ar : data.answers.en

                        $('.parent').prepend(`

                   <div id="heading0${uniqueId}" role="tabpane" class="card-header">
                                <div class="d-flex justify-content-between">
                                    <a data-toggle="collapse" data-parent="#accordionWrapa1"
                                        href="#accordion0${uniqueId}" aria-expanded="true"
                                        aria-controls="accordion0"
                                        class="font-medium-1">${question}</a>
                                    <div class="icons-action">
                                        <a href="#">edit</a>
                                        <a href="#" class="text-danger">delete</a>
                                    </div>

                                </div>

                            </div>
                            <div id="accordion0${uniqueId}" role="tabpane1"
                                aria-labelledby="heading0${uniqueId}"
                                class="card-collapse collapse show"
                                aria-expanded="true">
                                <div class="card-body">
                                    ${answer}
                                </div>
                            </div>
                   `


                        )


                    } else {
                        toastr.error(data.message)
                    }

                },
                error: function(reject) {
                    var response = JSON.parse(reject.responseText);
                    $.each(response.errors, function(key, value) {
                        toastr.error(value);
                    });
                }
            });



        })
        $(document).on('submit', '.edit_faq', function(e) {
            e.preventDefault()
            let id = $(this).attr('id');
            let url = "{{ route('faqs.update', ':id') }}";
            url = url.replace(':id', id);

            let formData = new FormData($(this)[0]);
            formData.append('_method', 'PUT'); // تحديد الطريقة الصحيحة
            formData.append('_token', '{{ csrf_token() }}');
            formData.append('id', id);
            let location = "{{ app()->getLocale() }}";

            $.ajax({
                url: url,
                type: 'POST', // لا تستخدم PUT مباشرة مع FormData
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    let question = location == 'ar' ? data.faq.questions.ar : data.faq.questions.en
                    let answer = location == 'ar' ? data.faq.answers.ar : data.answers.en
                    $('.edit_faq')[0].reset();
                    $(`#faq_${id}`).modal('hide')
                    toastr.success(data.message)
                    $(`#ques_${id}`).html(question)
                    $(`#ans_{id}`).html(answer)
                },
                error: function(reject) {
                    var response = JSON.parse(reject.responseText);
                    $.each(response.errors, function(key, value) {
                        toastr.error(value);
                    });
                }
            });


        })
        $(document).on('click', '.del_btn', function() {
            let id = $(this).attr('id');

            let url = "{{ route('faqs.destroy', ':id') }}";
            url = url.replace(':id', id);
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
                            _token: "{{ csrf_token() }}" // أضف التوكن هنا
                        },
                        success: function(data) {
                            if (data.status == 'success') {
                                Swal.fire({
                                    title: "Deleted!",
                                    text: `${data.message}`,
                                    icon: "success"
                                });

                                $(`#parent_${id}`).remove();
                            }
                            $('.faq-bar').html(data.count)
                        }
                    });


                }
            });

        })
    </script>
</body>

</html>
