@extends('master')
@section('content')

    <div class="card-body">
        <!--begin: Datatable-->
        <table class="table table-bordered table-checkable" id="account">
            <thead>
            <tr>
                <th>ID</th>
                <th>To Date</th>
                <th>From Date</th>
                <th>Account</th>
                <th>Created At</th>
                <th>Updated At</th>
            </tr>
            </thead>
        </table>
        <!--end: Datatable-->
    </div>

    {{--Add new--}}
    <div id="add-account" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group" >
                        <span class="error1 text-center text-danger hidden"></span>
                        <label class="control-label col-sm-6" for="name">To date</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name="to_date">
                        </div>
                    </div>
                    <div class="form-group">
                        <span class="error2 text-center text-danger hidden"></span>
                        <label class="control-label col-sm-6" for="name">From date</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" name="from_date">
                        </div>
                    </div>
                    <div class="form-group" >
                        <span class="error3 text-center text-danger hidden"></span>
                        <label class="control-label col-sm-6" for="name">Account Paypal</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="paypal_acconut">
                        </div>
                    </div>
                    <div class="form-group" >

                        <label class="control-label col-sm-6" for="name">Site</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="site">
                                @foreach($list_site as $value)
                                    <option value="{{$value->id}}">{{$value->site_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn actionBtn" data-dismiss="modal">
                            <span id="footer_action_button_1" class="si">Add</span>
                        </button>

                        <button type="button" class="btn btn-warning" data-dismiss="modal">
                            <span class="si si"></span>Close
                        </button>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).on('click', '.add-account-modal', function () {
            $('#footer_action_button').text("Save");
            $('#footer_action_button').addClass('icon-checkmark-cricle');
            $('#footer_action_button').removeClass('si-trash');
            $('.actionBtn').addClass('btn-success');
            $('.actionBtn').removeClass('btn-danger');
            $('.actionBtn').addClass('add-account');
            $('.modal-title').text('Add');
            $('.deleteContent').hide();
            $('.form-horizontal').show();
            $('#add-account').modal('show');
        });

        $('.modal-footer').on('click', '.add-account', function () {
            $.ajax({
                type: 'POST',
                url: '{{route('add_account')}}',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'to_date': $('input[name=to_date]').val(),
                    'from_date': $('input[name=from_date]').val(),
                    'paypal_account': $('input[name=paypal_acconut]').val(),
                },
                success: function (data) {
                    if ((data.errors)) {
                        $('error1').removeClass('hidden');
                        $('error2').removeClass('hidden');
                        $('error3').removeClass('hidden');
                        $('.error1').text(data.errors.to_date);
                        $('.error2').text(data.errors.from_date);
                        $('.error3').text(data.errors.paypal_account);
                    }else {
                        $('#account').DataTable().ajax.reload(null, false);
                    }
                }
            });
        });
        document.getElementById("myBtn").onclick = function () {
        myFunction()
    };
    /* show my button */
    function myFunction() {
        document.getElementById("myDropdown").classList.toggle("show");
    }
    </script>


    <script>
        $(document).ready(function () {
            document.querySelector(".btn_export ").style.display = "none";
            document.querySelector(".dropdown ").style.display = "none";
            $('#upfile-button').attr('style', 'display: none !important');

            $('#account').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('data_acconut') }}",
                columns: [
                    {"data": "id"},
                    {"data": "to_date"},
                    {"data": "from_date"},
                    {"data": "paypal_account"},
                    {"data": "created_at"},
                    {"data": "updated_at"}
                ]
            });
        });
    </script>

@endsection
 