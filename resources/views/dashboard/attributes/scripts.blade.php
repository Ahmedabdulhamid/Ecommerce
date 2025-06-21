<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- 2. Popper.js (مطلوب لـ Bootstrap) -->

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>

<!-- 3. Bootstrap كامل -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- 4. DataTables الأساسي -->

<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

<!-- 5. إضافات DataTables (الترتيب مهم) -->

<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>

<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.colVis.min.js"></script>

<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>

<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>

<!-- 6. مكتبات الدعم لتصدير الملفات -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/pdfmake.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/vfs_fonts.js"></script>

<!-- 7. إضافات متقدمة (إذا لزم الأمر) -->

<script src="https://cdn.datatables.net/responsive/2.2.2/js/dataTables.responsive.min.js"></script>

<script src="https://cdn.datatables.net/select/1.6.2/js/dataTables.select.min.js"></script>

<script src="{{ asset('vendor/excel/jszip.js') }}"></script>
<script src="{{ asset('vendor/excel/jszip.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function () {
        var attributeTable = $('#attribute_table').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: "{{ route('attributes.index') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'name', name: 'name' },
                { data: 'actions', name: 'actions' }
            ],
            dom: 'Bfrtip',
            buttons: ['colvis', 'print', 'copyHtml5', 'excelHtml5', 'pdfHtml5']
        });

        window.addEventListener('refreshDatatable', function () {

            attributeTable.ajax.reload(null, false); // تحديث بدون إعادة تحميل الصفحة
        });

    });
</script>

<script>

</script>
