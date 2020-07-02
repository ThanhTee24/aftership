<div id="Edit_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <div class="progress">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                         role="progressbar" style="width: 0%" aria-valuenow="100" aria-valuemin="0"
                         aria-valuemax="100"></div>
                </div>
                <form class="form-horizontal" method="post" enctype="multipart/form-data" role="modal">@csrf
                    <div class="form-group" hidden>
                        <label class="control-label col-sm-6" for="id">ID</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="fid" disabled>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-6" for="name">Order Date</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="order_date">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-6" for="name">Order ID</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="order_id">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-6" for="name">Courier</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="courier">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-6" for="name">Tracking Number</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="tracking_number">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-6" for="name">Tracking Date</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="tracking_date">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-6" for="name">Note</label>
                        <div class="col-sm-10">
                            <textarea name="note" class="form-control" id="note"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">

                <button type="button" class="btn actionBtn" data-dismiss="modal">
                    <span id="footer_action_button" class="si"></span>
                </button>

                <button type="button" class="btn btn-warning" data-dismiss="modal">
                    <span class="si si"></span>Close
                </button>

            </div>

        </div>
    </div>
</div>

<div id="update" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="post" enctype="multipart/form-data" role="modal">@csrf
                    <div class="form-group" hidden>
                        <label class="control-label col-sm-6" for="id">ID</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="fid" disabled>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-6" for="name">Tracking Number</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="tracking_number_update" disabled>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-6" for="name">Courier</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="courier_update" disabled>
                        </div>
                    </div>


                </form>
            </div>
            <div class="modal-footer">

                <button type="button" class="btn actionBtn" data-dismiss="modal">
                    <span id="footer_action_button_1" class="si"></span>
                </button>

                <button type="button" class="btn btn-warning" data-dismiss="modal">
                    <span class="si si"></span>Close
                </button>

            </div>
        </div>
    </div>
</div>

<div id="detail" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <div class="form-group" hidden>
                    <label class="control-label col-sm-6" for="name">Courier</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="tracking_number_detail" disabled>
                    </div>
                </div>
                <ul class="timeline trackingdetail">
                    <li id="">
                        <a target="_blank" href="https://www.totoprayogo.com/#">New Web Design</a>
                        <a href="#" class="float-right">21 March, 2014</a>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque scelerisque diam non nisi semper, et elementum lorem ornare. Maecenas placerat facilisis mollis. Duis sagittis ligula in sodales vehicula....</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

{{--    Export modal--}}
<div id="show" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <form class="form-horizontal" role="form">@csrf
                <div class="modal-body">
                    <div class="div_check">
                        <div class="form-group">
                            <span class="error1 text-center text-danger hidden"></span><br>
                            <span class="error2 text-center text-danger hidden"></span>
                        </div>
                        <div class="form-group" style="width: 100%;display: flex">
                            <label>Order Date</label><br>
                            <div style="width: 50%;display: flex">
                                <label>Từ ngày:</label>
                                <input type="date" name="export_todate" class="form-control" required>
                            </div>
                            <div style="width: 50%;display: flex">
                                <label>Đến ngày</label>
                                <input type="date" name="export_fromdate" class="form-control" required>

                            </div>

                        </div>
                        <div class="form-group">
                            <label>Supplier</label>
                            <select name="export_supplier" class="form-control">
                                <option value="null">All</option>
                                @foreach($list_supplier as $value)
                                    <option value="{{$value->name}}">{{$value->name}}</option>
                                @endforeach
                            </select>
                            {{--                                <input type="text" name="export_supplier" class="form-control">--}}
                        </div>
                        <div class="form-group">
                            <label>Courier</label>
                            <select name="export_courier" class="form-control">
                                <option value="null">All</option>
                                <option>DHL</option>
                                <option>Yun Express</option>
                                <option>USPS</option>
                                <option>Epacket</option>
                                <option>UPS</option>
                                <option>Fedex</option>
                                <option>Yanwen</option>
                            </select>
                            {{--                                <input type="text" name="export_supplier" class="form-control">--}}
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select name="export_status" class="form-control">
                                <option value="null">All</option>
                                <option>Info Received</option>
                                <option>In Transit</option>
                                <option>Out for Delivery</option>
                                <option>Delivered</option>
                                <option>Failed Attempt</option>
                                <option>Available for Pickup</option>
                                <option>Alert</option>
                                <option>Expired</option>
                                <option>Pending</option>
                            </select>
                            {{--                                <input type="text" name="export_supplier" class="form-control">--}}
                        </div>
                    </div>
                </div>
            </form>

            <div class="modal-footer">
                <button class="btn btn-success" type="submit" id="export-file-select">
                    <span class=""></span>Export file
                </button>
                <button class="btn btn-warning" type="button" data-dismiss="modal">
                    <span class="si si-remobe"></span>Close
                </button>
            </div>
        </div>
    </div>
</div>
