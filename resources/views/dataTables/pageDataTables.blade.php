<script>
    $(document).ready(function () {
        $('#myTable').DataTable({
            dom: "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>><'row'<'col-sm-12'B>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-4'i><'col-sm-12 col-md-8'p>>",
            buttons: ["colvis"
            ],
            serverSide: true,
            ajax: {
                url: '{{route('dataPage')}}',
                type: 'GET'
            },
            columns: [
                {"data": "order_date"},
                {"data": "order_id"},
                {"data": "courier"},
                {
                    "data": "tracking_number",
                    render: function (data) {
                        if (data != null) {
                            dataRender = '<label style=" width: 130px; height: 50px;text-overflow: ellipsis;">' + data + '</label>';
                        }
                        else{
                            dataRender = '<label style=" width: 130px; height: 50px;text-overflow: ellipsis;"></label>';
                        }
                        return dataRender;
                    }
                },
                {"data": "tracking_date"},
                {"data": "count_day"},
                {"data": "supplier"},
                {"data": "status"},
                {
                    "data": "process_content",
                    render: function (data) {
                        if (data == null) {
                            dataRender = '<p></p>';
                        } else {
                            dataRender = '<p>' + data + '</p>';
                        }
                        return dataRender;
                    }
                },
                {"data": "process_date"},
                {"data": "total"},
                {"data": "note"},
                {
                    "data": "approved",
                    render: function (data) {
                        if (data == 1) {
                            dataRender = '<i class="ki ki-bold-check-1 text-success">';
                        } else {
                            dataRender = '';
                        }
                        return dataRender;
                    }
                },
                {"data": "action", orderable: false, searchable: false}
            ],
            lengthMenu: [10, 25, 50, 75, 100, 1000],
            deferRender: true,
            responsive: true,
            processing: true,
            language: {
                "infoFiltered": "",
                "processing": "'<i class=\"fa fa-spinner fa-spin fa-3x fa-fw text-success\"></i><span class=\"sr-only\" style='position: fixed; top: 0px;left: 500px; vertical-align: middle; text-align: center;'>Loading...</span> '"
            },
        });

    });


    function filterColumn(i) {
        $('#myTable').DataTable().column(i).search(
            $('#col' + i + '_filter').val()
        ).draw();
    }


    $(document).ready(function () {
        $('#myTable').DataTable();

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
