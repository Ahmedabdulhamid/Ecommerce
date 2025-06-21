<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    var $j = jQuery.noConflict();
</script>

<!-- Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- DataTables -->
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.2/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/select/1.6.2/js/dataTables.select.min.js"></script>

<!-- Export Support -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/vfs_fonts.js"></script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Toastr (تأكد أنك ضايف ملفات CSS الخاصة به أيضًا) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    var couponTable = $j('#Coupon_table').DataTable({
        processing: true,
        serverSide: true,
        responsive: true,

        ajax: {
            url: "{{ route('coupones.index') }}",
            type: "GET",
            complete: function () {
                $j('#Coupon_table').DataTable().processing(false);
            }
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'code', name: 'code' },
            { data: 'discount_precentage', name: 'discount_precentage' },
            { data: 'start_at', name: 'start_at' },
            { data: 'end_at', name: 'end_at' },
            { data: 'limit', name: 'limit' },
            { data: 'status', name: 'status' },
            { data: 'time_used', name: 'time_used' },
            { data: 'actions', name: 'actions' }
        ],
        pageLength: 10,
        dom: 'Bfrtip',
        buttons: ['colvis', 'print', 'copyHtml5', 'excelHtml5', 'pdfHtml5']
    });

    // تحديث الكوبون
    $j(document).off('submit', '.coupon_update_form').on('submit', '.coupon_update_form', function (e) {
        e.preventDefault();

        let coupon_id = $j(this).data('coupon-id');

        $j.ajax({
            url: "{{ route('coupons.edit') }}",
            type: "POST",
            data: {
                'id': coupon_id,
                'code': $j('#code_' + coupon_id).val(),
                'discount_precentage': $j('#discount_precentage_' + coupon_id).val(),
                'start_at': $j('#start_at_' + coupon_id).val(),
                'end_at': $j('#end_at_' + coupon_id).val(),
                'limit': $j('#limit_' + coupon_id).val(),
                'status': $j('input[name="status_' + coupon_id + '"]:checked').val(),
            },
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            success: function (data) {
                couponTable.ajax.reload(null, false);
                toastr.success(data.message);

                var modalEl = document.getElementById('coupon_' + coupon_id);
                var modalInstance = bootstrap.Modal.getOrCreateInstance(modalEl);
                modalInstance.hide();

                modalEl.addEventListener('hidden.bs.modal', function () {
                    $j('.modal-backdrop').remove();
                    $j('body').removeClass('modal-open').removeAttr('style');
                });
            },
            error: function (reject) {
                let response = JSON.parse(reject.responseText);
                $j.each(response.errors, function (key, value) {
                    toastr.error(value);
                });
            }
        });
    });

    // حذف الكوبون
    $j(document).off('click', '.del').on('click', '.del', function () {
        let id = $j(this).attr('id');

        Swal.fire({
            title: 'هل أنت متأكد؟',
            text: "لن تتمكن من التراجع عن هذا الإجراء!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'نعم، احذف!',
            cancelButtonText: 'إلغاء'
        }).then((result) => {
            if (result.isConfirmed) {
                $j.ajax({
                    url: "{{ route('coupons.destroy', ':id') }}".replace(':id', id),
                    type: "GET",
                    success: function (response) {
                        couponTable.ajax.reload(null, false);
                        toastr.success(response.message);

                        Swal.fire('تم الحذف!', 'تم حذف العنصر بنجاح.', 'success');
                        $j('.coupon-bar').html(response.count);
                    },
                    error: function () {
                        toastr.error("حدث خطأ أثناء عملية الحذف.");
                    }
                });
            }
        });
    });
</script>
