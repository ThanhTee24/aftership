@extends('master')
@section('content')

    <style>
        dataTables_wrapper .dataTables_processing {
            position: absolute;
            top: 30%;
            left: 50%;
            width: 30%;
            height: 40px;
            margin-left: -20%;
            margin-top: -25px;
            padding-top: 20px;
            text-align: center;
            font-size: 1.2em;
            background: none;
        }

        option {
            font-weight: normal;
            display: block;
            white-space: pre;
            min-height: 1.5em;
            padding: 5px;
        }

        td p {
            width: 200px;
            height: 40px;
            overflow: hidden;
            /*text-overflow: ellipsis;*/
            /*transition: width 1s, height 2s;*/

        }

    </style>

    <div class="card-body">
        <form id="search-form" method="POST" enctype="multipart/form-data">@csrf
            <div class="row">
                <div class="col-lg-2" id="filter_col1" data-column="0">
                    <label>Order date:</label>
                    <input type="date" class="form-control col-lg-12 column_filter" id="col0_filter" name="order_date"
                           placeholder="2020/05/20"/>
                </div>
                <div class="col-lg-2" id="filter_col2" data-column="1">
                    <label>Order ID:</label>
                    <input type="text" class="form-control col-lg-12 column_filter" id="col1_filter" name="order_id"
                           placeholder="489454894797"/>
                </div>
                <div class="col-lg-2" id="filter_col3" data-column="2">
                    <label>Courier:</label>
                    {{--                    <input type="text" class="form-control col-lg-12 column_filter" id="col2_filter" name="courier">--}}
                    <select class="form-control col-lg-12 column_filter" id="col2_filter" name="courier">
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
                <div class="col-lg-2" id="filter_col4" data-column="3">
                    <label>Tracking number:</label>
                    <input type="text" class="form-control col-lg-12 column_filter" id="col3_filter"
                           name="tracking_number"
                           placeholder="TO783237123"/>
                </div>
                <div class="col-lg-2" id="filter_col5" data-column="4">
                    <label>Supplier:</label>
                    <select class="form-control col-lg-12 column_filter" id="col4_filter">
                        <option></option>
                        <option value="null">Blank</option>
                        @foreach($list_supplier as $value)
                            <option>{{$value->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mb-8">
                <div class="col-lg-2" id="filter_col6" data-column="5">
                    <label>Status:</label>
                    <select class="form-control col-lg-12 column_filter" id="col5_filter">
                        <option selected></option>
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
                <div class="col-lg-2" id="filter_col7" data-column="6">
                    <label>Process date:</label>
                    <input type="date" class="form-control col-lg-12 column_filter" id="col6_filter"/>
                </div>
                <div class="col-lg-2" id="filter_col8" data-column="7">
                    <label>Total day:</label>
                    <select class="form-control col-lg-12 column_filter" id="col7_filter">
                        <option></option>
                        @foreach($list_total_day as $value)
                            <option value="{{$value->total_day}}">{{$value->total_day}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-2" id="filter_col9" data-column="8">
                    <label>Note:</label>
                    <input type="text" class="form-control col-lg-12 column_filter" id="col8_filter"/>
                </div>
            </div>
        </form>

        <table class="table table-bordered table-checkable display" id="myTable">
            <thead>
            <tr>
                <th>Order Date</th>
                <th width="2%">Order ID</th>
                <th>Courier</th>
                <th width="5%">Tracking number</th>
                <th>Supplier</th>
                <th>Status</th>
                <th>Process Date</th>
                <th>Total day</th>
                <th>Note</th>
                <th width="2%">Action</th>
            </tr>
            </thead>
        </table>
        <!--end: Datatable-->
        <div class="content-right">
        </div>
    </div>

    @include('modal.pageModal')

    @include('action.pageAction')

    @include('dataTables.pendingDataTables')


@endsection
