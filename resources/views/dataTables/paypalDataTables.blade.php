<script>
    $(document).ready(function () {
        $('#paypal_table').DataTable({
            dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>><'row'<'col-sm-12'B>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-4'i><'col-sm-12 col-md-8'p>>",
            buttons: [
                "colvis"
            ],
            ajax: "{{ route('getpaypal') }}",
            serverSide: true,
            columns: [
                {"data": "order_date"},
                {"data": "order_id"},
                {"data": "paypal_account"},
                {"data": "transaction_id"},
                {"data": "courier"},
                {"data": "tracking_number",
                    render: function (data) {
                        dataRender = '<label style=" width: 130px; height: 50px;text-overflow: ellipsis;">' + data + '</label>';

                        return dataRender;
                    }},
                {"data": "process_date"},
                {"data": "status"},
                {
                    "data": "update_status",
                    render: function (data) {
                        switch (data) {
                            case "Updated":
                                dataRender = '<a class="label label-lg font-weight-bold label-light-primary label-inline" style="text-align: center">Updated</a>';
                                break;
                            case "Added":
                                dataRender = '<a class="label label-lg font-weight-bold label-light-primary label-inline" style="text-align: center">Added</a>';
                                break;
                            case null:
                                dataRender = ''
                                break
                            default:
                                dataRender = '<td> <a class="label label-lg font-weight-bold label-light-danger label-inline" style="text-align: center">Error</a></td>'
                        }

                        return dataRender;
                    }
                },
                {"data": "action"}
            ],
            lengthMenu: [10, 25, 50, 75, 100, 1000],
            deferRender: true,
            responsive: true,
            processing: true,
            language: {
                "infoFiltered":"",
                "processing": "'<i class=\"fa fa-spinner fa-spin fa-3x fa-fw text-success\"></i><span class=\"sr-only\">Loading...</span> '"
            },

        });
    });

    function filterGlobal() {
        $('#paypal_table').DataTable().search(
            $('#global_filter').val()

        ).draw();
    }

    function filterColumn(i) {
        $('#paypal_table').DataTable().column(i).search(
            $('#col' + i + '_filter').val()

        ).draw();
    }

    $(document).ready(function () {
        $('#paypal_table').DataTable();

        $('input.global_filter').on('keyup change', function () {
            filterGlobal();
        });

        $('input.column_filter').on('keyup change', function () {
            filterColumn($(this).parents('div').attr('data-column'));
        });
    });

    $('select.column_filter').on('change', function () {
        filterColumn($(this).parents('div').attr('data-column'));
    });
</script>
