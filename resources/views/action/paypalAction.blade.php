<script type="text/javascript">

    // function Edit POST
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
        $('#paypal_account').val($(this).data('paypal_account'));
        $('#transaction_id').val($(this).data('transaction_id'));
        $('#myModal').modal('show');
    });

    $('.modal-footer').on('click', '.edit', function () {
        $.ajax({
            type: 'POST',
            url: 'Edit_paypal',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $("#fid").val(),
                'paypal_account': $('#paypal_account').val(),
                'transaction_id': $('#transaction_id').val()
            },
            success: function (data) {
                $('#paypal_table').DataTable().ajax.reload(null, false);
            }
        });
    });

    $(document).on('click', '.add-modal', function () {
        $('#footer_action_button').text("Save");
        $('#footer_action_button').addClass('icon-checkmark-cricle');
        $('#footer_action_button').removeClass('si-trash');
        $('.actionBtn').addClass('btn-success');
        $('.actionBtn').removeClass('btn-danger');
        $('.actionBtn').addClass('add');
        $('.modal-title').text('Add');
        $('.deleteContent').hide();
        $('.form-horizontal').show();
        $('#fid').val($(this).data('id'));
        $('#tracking_number_add').val($(this).data('tracking_number'));
        $('#courier_add').val($(this).data('courier'));
        $('#paypal_account_add').val($(this).data('paypal_account'));
        $('#transaction_id_add').val($(this).data('transaction_id'));
        $('#add').modal('show');
    });

    $('.modal-footer').on('click', '.add', function () {
        $.ajax({
            type: 'POST',
            url: '{{ URL::to('api/add-tracking') }}',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $("#fid").val(),
                'tracking': $('#tracking_number_add').val(),
                'carrier': $('#courier_add').val(),
                'paypal_account': $('#paypal_account_add').val(),
                'transaction_id': $('#transaction_id_add').val()
            },
            success: function (data) {
                $('#paypal_table').DataTable().ajax.reload(null, false);
            }
        });
    });

    $(document).on('click', '.update-modal', function () {
        $('#footer_action_button').text("Save");
        $('#footer_action_button').addClass('icon-checkmark-cricle');
        $('#footer_action_button').removeClass('si-trash');
        $('.actionBtn').addClass('btn-success');
        $('.actionBtn').removeClass('btn-danger');
        $('.actionBtn').addClass('update');
        $('.modal-title').text('Update');
        $('.deleteContent').hide();
        $('.form-horizontal').show();
        $('#fid').val($(this).data('id'));
        $('#tracking_number_update').val($(this).data('tracking_number'));
        $('#courier_update').val($(this).data('courier'));
        $('#paypal_account_update').val($(this).data('paypal_account'));
        $('#transaction_id_update').val($(this).data('transaction_id'));
        $('#update').modal('show');
    });

    $('.modal-footer').on('click', '.update', function () {
        $.ajax({
            type: 'POST',
            url: '{{ URL::to('api/paypal-tracking') }}',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $("#fid").val(),
                'tracking': $('#tracking_number_update').val(),
                'carrier': $('#courier_update').val(),
                'paypal_account': $('#paypal_account_update').val(),
                'transaction_id': $('#transaction_id_update').val()
            },
            success: function (data) {
                $('#paypal_table').DataTable().ajax.reload(null, false);
            }
        });
    });


    // Show function
    $(document).on('click', '.detail-modal', function () {
        $('#tracking_number_detail').val($(this).data('tracking_number'));

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
