<div id="myModal" class="modal fade" role="dialog">
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
                        <label class="control-label col-sm-6" for="name">Paypal account</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="paypal_account">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-6" for="name">Transaction ID</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="transaction_id">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">

                <button type="button" class="btn actionBtn" data-dismiss="modal">
                    <span id="footer_action_button" class="si"></span>
                </button>

                <button type="button" class="btn btn-warning" data-dismiss="modal">
                    <span class="si si"></span>Thoát
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
                    <div class="col-sm-10">
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

<div id="update" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <div class="form-group" hidden>
                    <label class="control-label col-sm-6" for="name">Tracking number</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="tracking_number_update" disabled>
                    </div>
                </div>
                <div class="form-group" hidden>
                    <label class="control-label col-sm-6" for="name">Courier</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="courier_update" disabled>
                    </div>
                </div>
                <div class="form-group" hidden>
                    <label class="control-label col-sm-6" for="name">Paypal</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="paypal_account_update" disabled>
                    </div>
                </div>
                <div class="form-group" hidden>
                    <label class="control-label col-sm-6" for="name">Transaction</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="transaction_id_update" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-6" for="name">Update!s</label>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn actionBtn" data-dismiss="modal">
                        <span id="footer_action_button_1" class="si">Update</span>
                    </button>

                    <button type="button" class="btn btn-warning" data-dismiss="modal">
                        <span class="si si"></span>Close
                    </button>

                </div>
            </div>
        </div>
    </div>
</div>

<div id="add" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <div class="form-group" hidden>
                    <label class="control-label col-sm-6" for="name">Tracking number</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="tracking_number_add" disabled>
                    </div>
                </div>
                <div class="form-group" hidden>
                    <label class="control-label col-sm-6" for="name">Courier</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="courier_add" disabled>
                    </div>
                </div>
                <div class="form-group" hidden>
                    <label class="control-label col-sm-6" for="name">Paypal</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="paypal_account_add" disabled>
                    </div>
                </div>
                <div class="form-group" hidden>
                    <label class="control-label col-sm-6" for="name">Transaction</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="transaction_id_add" disabled>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-6" for="name">Do you want to add?</label>
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
