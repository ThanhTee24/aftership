@extends('master')
@section('content')

    <div class="card-body">
        <form>
            <div class="row">
                <div class="col-lg-2" id="filter_col1" data-column="0">
                    <label>Order date:</label>
                    <input type="date" class="form-control col-lg-12 column_filter" id="col0_filter"
                           placeholder="2020/05/20"/>
                </div>
                <div class="col-lg-2" id="filter_col2" data-column="1">
                    <label>Order ID:</label>
                    <input type="text" class="form-control col-lg-12 column_filter" id="col1_filter"
                           placeholder="489454894797"/>
                </div>
                <div class="col-lg-2" id="filter_col3" data-column="2">
                    <label>Paypal account:</label>
                    <select class="form-control col-lg-12 column_filter" id="col2_filter">
                        <option></option>
                        <option value="null">Blank</option>
                        @foreach($list_paypal_account as $value)
                            <option>{{$value->paypal_account}}</option>
                        @endforeach
                    </select>
{{--                    <input type="text" class="form-control col-lg-12 column_filter" id="col2_filter">--}}
                </div>
                <div class="col-lg-2" id="filter_col4" data-column="3">
                    <label>Transaction Id:</label>
                    <input type="text" class="form-control col-lg-12 column_filter" id="col3_filter"
                           placeholder="TO783237123"/>
                </div>
                <div class="col-lg-2" id="filter_col5" data-column="4">
                    <label>Courier:</label>
                    {{--                    <input type="text" class="form-control col-lg-12 column_filter" id="col4_filter"/>--}}
                    <select class="form-control col-lg-12 column_filter" id="col4_filter">
                        <option selected></option>
                        <option>DHL</option>
                        <option>Yun Express</option>
                        <option>USPS</option>
                        <option>Epacket</option>
                        <option>UPS</option>
                        <option>Fedex</option>
                        <option>Yanwen</option>
                    </select>
                </div>
                <div class="col-lg-2" id="filter_col6" data-column="5">
                    <label>Tracking number:</label>
                    <input type="text" class="form-control col-lg-12 column_filter" id="col5_filter"/>
                </div>
            </div>
            <div class="row mb-8">

                <div class="col-lg-2" id="filter_col7" data-column="6">
                    <label>Tracking date:</label>
                    <input type="date" class="form-control col-lg-12 column_filter" id="col6_filter"/>
                </div>
                <div class="col-lg-2" id="filter_col8" data-column="7">
                    <label>Tracking status:</label>
{{--                    <input type="text" class="form-control col-lg-12 column_filter" id="col7_filter"/>--}}
                    <select class="form-control col-lg-12 column_filter" id="col7_filter">
                        <option></option>
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
                </div>
                <div class="col-lg-2" id="filter_col9" data-column="8">
                    <label>Update:</label>
                    <select class="form-control col-lg-12 column_filter" id="col8_filter">
                        <option ></option>
                        <option value="null">Blank</option>
                        <option>Updated</option>
                        <option>Added</option>
                        <option>Error</option>
                    </select>
{{--                    <input type="text" class="form-control col-lg-12 column_filter" id="col8_filter"/>--}}
                </div>
            </div>
        </form>
        <!--begin: Datatable-->
        <table class="table table-bordered table-checkable" id="paypal_table">
            <thead>
            <tr>
                <th>Order Date</th>
                <th>Order ID</th>
                <th>Paypal account</th>
                <th>Transaction ID</th>
                <th>Courier</th>
                <th>Tracking number</th>
                <th>Tracking date</th>
                <th>Tracking Status</th>
                <th>Update</th>
                <th>Action</th>
            </tr>
            </thead>
        </table>
        <!--end: Datatable-->
    </div>

   @include('modal.paypalModal')

    @include('action.paypalAction')

    @include('dataTables.paypalDataTables')



@endsection
