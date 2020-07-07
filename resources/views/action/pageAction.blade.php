<script type="text/javascript">

    // function Edit
    $(document).on('click', '.edit-modal', function () {
        $('#footer_action_button').text("Save");
        $('#footer_action_button').addClass('icon-checkmark-cricle');
        $('#footer_action_button').removeClass('si-trash');
        $('.actionBtn').addClass('btn-success');
        $('.actionBtn').removeClass('btn-danger');
        $('.actionBtn').addClass('edit');
        $('.modal-title').text('Edit');
        $('.deleteContent').hide();
        $('.form-horizontal').show();
        $('#fid').val($(this).data('id'));
        $('#order_date').val($(this).data('order_date'));
        $('#order_id').val($(this).data('order_id'));
        $('#courier').val($(this).data('courier'));
        $('#tracking_number').val($(this).data('tracking_number'));
        $('#tracking_date').val($(this).data('tracking_date'));
        $('#count_day').val($(this).data('count_day'));
        $('#status').val($(this).data('status'));
        $('#content').val($(this).data('content'));
        $('#process_date').val($(this).data('process_date'));
        $('#total').val($(this).data('total'));
        $('#note').val($(this).data('note'));
        $('#Edit_modal').modal('show');
    });

    $('.modal-footer').on('click', '.edit', function () {
        $.ajax({
            type: 'POST',
            url: 'Edit_tracking',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $("#fid").val(),
                'order_date': $('#order_date').val(),
                'order_id': $('#order_id').val(),
                'courier': $('#courier').val(),
                'tracking_number': $('#tracking_number').val(),
                'tracking_date': $('#tracking_date').val(),
                'note': $('#note').val()
            },
            success: function (data) {
                $('.progress-bar').text('Uploaded');
                $('.progress-bar').css('width', '100%');
                $('#myTable').DataTable().ajax.reload(null, false);
            }
        });
    });


    $(document).on('click', '.update-modal', function () {
        $('#footer_action_button_1').text("Update");
        $('#footer_action_button').removeClass('si-check');
        $('#footer_action_button').addClass('si-trash');
        $('.actionBtn').removeClass('btn-success');
        $('.actionBtn').addClass('btn-danger');
        $('.actionBtn').addClass('update');
        $('.modal-title').text('update');
        $('.form-horizontal').show();
        $('#fid').val($(this).data('id'));
        $('#courier_update').val($(this).data('courier'));
        $('#tracking_number_update').val($(this).data('tracking_number'));
        $('#update').modal('show');
    });

    $('.modal-footer').on('click', '.update', function () {
        $.ajax({
            type: 'POST',
            url: '{{ URL::to('api/update-tracking') }}',
            // http://localhost/aftership/public/api/update-tracking
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $("#fid").val(),
                'courier': $('#courier_update').val(),
                'tracking': $('#tracking_number_update').val()
            },
            success: function (data) {

                $('#myTable').DataTable().ajax.reload(null, false);
            }
        });
    });

    // Show function
    $(document).on('click', '.detail-modal', function () {
        $('#tracking_number_detail').val($(this).data('tracking_number'));
        // $('#process_date_detail').val($(this).data('process_date'));
        // $('#process_content_detail').val($(this).data('content'));
        // $('#status_detail').val($(this).data('status'));
        $('.modal-title').text('Detail');
        $.ajax({
            type: 'POST',
            url: 'Detail_tracking',
            data: {
                '_token': $('input[name=_token]').val(),
                'tracking_number': $('#tracking_number_detail').val()
            },
            success: function (data) {
                console.log(data);
                $('.trackingdetail').replaceWith(data)
            }
        });
        $('#detail').modal('show');

    });


</script>

<script type="text/javascript">
    $(document).on('click', '.export-modal', function () {
        $('#show').modal('show');
        $('.modal-title').text('Export');
    });

    $("#export-file-select").click(function () {

        //TODO: set loading display: block;
        document.querySelector(".pendingload").style.display = "flex";
        

        $.ajax({
            type: 'POST',
            url: 'exportTracking',
            data: {
                '_token': $('input[name=_token]').val(),
                'to_date': $('input[name=export_todate]').val(),
                'from_date': $('input[name=export_fromdate]').val(),
                'supplier': $('select[name=export_supplier]').val(),
                'courier': $('select[name=export_courier]').val(),
                'status': $('select[name=export_status]').val(),
            },
            success: function (data) {

                document.querySelector(".pendingload").style.display = "none";
                    //TODO: set loading display: none;

                console.log(data);
                if ((data.errors)) {
                    $('error1').removeClass('hidden');
                    $('error2').removeClass('hidden');
                    $('.error1').text(data.errors.to_date);
                    $('.error2').text(data.errors.from_date);
                } else {
                    const workbook = XLSX.utils.book_new();
                    const myHeader = [];
                    const worksheet = XLSX.utils.json_to_sheet(data, {header: myHeader});

                    const range = XLSX.utils.decode_range(worksheet['!ref']);
                    range.e['c'] = myHeader.length - 1;
                    worksheet['!ref'] = XLSX.utils.encode_range(range);

                    XLSX.utils.book_append_sheet(workbook, worksheet, 'Tracking');
                    XLSX.writeFile(workbook, 'Tracking.xlsx');
                }

            }
        });

    });
</script>

<script type="text/javascript">

    $("#export-file").click(function () {

        //TODO: set loading display: block;
        document.querySelector(".pendingload").style.display = "flex";
        

        $.ajax({
            type: 'POST',
            url: 'export',
            data: {
                '_token': $('input[name=_token]').val(),
            },
            success: function (data) {

                document.querySelector(".pendingload").style.display = "none";
                
                    //TODO: set loading display: none;

                console.log(data);
                if ((data.errors)) {
                    $('error1').removeClass('hidden');za
                    $('error2').removeClass('hidden');
                    $('.error1').text(data.errors.to_date);
                    $('.error2').text(data.errors.from_date);
                } else {
                    const workbook = XLSX.utils.book_new();
                    const myHeader = [];
                    const worksheet = XLSX.utils.json_to_sheet(data, {header: myHeader});

                    const range = XLSX.utils.decode_range(worksheet['!ref']);
                    range.e['c'] = myHeader.length - 1;
                    worksheet['!ref'] = XLSX.utils.encode_range(range);

                    XLSX.utils.book_append_sheet(workbook, worksheet, 'Tracking');
                    XLSX.writeFile(workbook, 'Tracking.xlsx');
                }
            }
        });

    });

    // get click button action
    document.getElementById("myBtn").onclick = function () {
        myFunction()
    };
    /* show my button */
    function myFunction() {
        document.getElementById("myDropdown").classList.toggle("show");
    }
</script>
