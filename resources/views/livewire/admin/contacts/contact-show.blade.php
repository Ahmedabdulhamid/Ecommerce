<div class="content-right w-75">
    @if ($contactMsg)
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="card email-app-details  d-lg-block">
                    <div class="card-content">
                        <div class="email-app-options card-body">
                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" class="btn btn-sm btn-outline-secondary"
                                            data-toggle="tooltip" data-placement="top" data-original-title="Replay"
                                            data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                                                class="la la-reply"></i></button>
                                        @include('dashboard.contacts.modal')


                                        @if ($contactMsg['deleted_at'] == null)
                                            <button type="button" class="btn btn-sm btn-outline-secondary"
                                                data-toggle="tooltip" data-placement="top" data-original-title="Delete"
                                                wire:click='deleteContact({{ $contactMsg['id'] }})'><i
                                                    class="ft-trash-2"></i></button>

                                        @else
                                        <button
                                        type="button"
                                        class="btn btn-sm btn-outline-secondary"
                                        x-data
                                        x-on:click="$dispatch('confirm-delete', {{ $contactMsg['id'] }})"
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        data-original-title="Delete">
                                        <i class="ft-trash-2"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary"
                                    data-toggle="tooltip" data-placement="top" data-original-title="Delete"
                                    wire:click='restoreContact({{ $contactMsg['id'] }})'><i class="ft-rotate-ccw"></i></i></button>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6 col-12 text-right">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" class="btn btn-sm btn-outline-secondary"
                                            data-toggle="tooltip" data-placement="top" data-original-title="Previous"><i
                                                class="la la-angle-left"></i></button>
                                        <button type="button" class="btn btn-sm btn-outline-secondary"
                                            data-toggle="tooltip" data-placement="top" data-original-title="Next"><i
                                                class="la la-angle-right"></i></button>
                                    </div>
                                    <div class="btn-group ml-1">
                                        <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle"
                                            data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">More</button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#">Mark as unread</a>
                                            <a class="dropdown-item" href="#">Mark as unimportant</a>
                                            <a class="dropdown-item" href="#">Add star</a>
                                            <a class="dropdown-item" href="#">Add to task</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Filter mail</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="email-app-title card-body">
                            <h3 class="list-group-item-heading">Project ABC Status Report</h3>
                            <p class="list-group-item-text">
                                <span class="primary">
                                    <span class="badge badge-primary">Previous</span> <i
                                        class="float-right font-medium-3 ft-star warning"></i></span>
                            </p>
                        </div>
                        <div class="media-list">
                            <div id="headingCollapse1" class="card-header p-0">
                                <a data-toggle="collapse" href="#collapse1" aria-expanded="true"
                                    aria-controls="collapse1"
                                    class="collapsed email-app-sender media border-0 bg-blue-grey bg-lighten-5">


                                </a>
                            </div>
                            <div id="collapse1" role="tabpanel" aria-labelledby="headingCollapse1"
                                class="card-collapse collapse" aria-expanded="true">
                                <div class="card-content">

                                </div>
                            </div>
                            <div id="headingCollapse2" class="card-header p-0">
                                <a data-toggle="collapse" href="#collapse2" aria-expanded="false"
                                    aria-controls="collapse2" class="email-app-sender media border-0">
                                    <div class="media-left pr-1">
                                        <span class="avatar avatar-md">
                                            <img src="https://ui-avatars.com/api/?name=Ahmed+Mostafa&background=random&size=64"
                                                class="rounded-circle avatar avatar-md" />
                                        </span>
                                    </div>
                                    <div class="media-body w-100">


                                        <h6 class="list-group-item-heading">{{ $contactMsg['name'] }}</h6>
                                        <p class="list-group-item-text">to me
                                            <span>Today</span>
                                            <span class="float-right">
                                                <i class="la la-reply mr-1"></i>
                                                <i class="la la-arrow-right mr-1"></i>
                                                <i class="la la-ellipsis-v"></i>
                                            </span>
                                        </p>
                                    </div>
                                </a>
                            </div>
                            <div id="collapse2" role="tabpanel" aria-labelledby="headingCollapse2"
                                class="card-collapse" aria-expanded="false">
                                <div class="card-content">
                                    <div class="email-app-text card-body">
                                        <div class="email-app-message">


                                            <p>Subject : {{ $contactMsg['subject'] }}</p>
                                            <p>Message: {{ $contactMsg['message'] }}</p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="email-app-text-action card-body">
                                {{ \Carbon\Carbon::parse($contactMsg['created_at'])->diffForHumans() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    window.addEventListener('deleteMsg', function() {
        toastr.success('This Message Deleted')
    })
    window.addEventListener('hideModal', function() {
        $('#exampleModal').modal('hide')
        let modal = bootstrap.Modal.getInstance(document.getElementById(`#exampleModal`));
        if (modal) {
            modal.hide();
        }
    })
</script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        window.addEventListener('confirm-delete', event => {


            const contactId = event.detail;
            console.log(contactId);


            Swal.fire({
                title: 'هل أنت متأكد؟',
                text: "لن تتمكن من التراجع بعد الحذف!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'نعم، احذفها!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch('deleteConfirmed', { id: contactId });
                }
            });
        });

        Livewire.on('confirmDelete', () => {
            Swal.fire(
                'تم الحذف!',
                'تم حذف الرسالة نهائيًا.',
                'success'
            );
        });
    });
</script>
<script>
    window.addEventListener('showMsg',function(){
        toastr.success('This Message Restored')
    })
</script>
