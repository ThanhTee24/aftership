<?php

namespace App\Http\Controllers;

use App\Model\Crawl_bighub;
use App\Model\Detail;
use App\Model\List_paypal_account;
use App\Model\List_supplier;
use App\Model\List_use_paypal;
use App\Model\Manage_big_com_sites;
use App\Model\Paypal_acconut;
use App\Model\Suppliers;
use App\Model\Tracking;
use Facades\App\Respository\Tracking_cache;
use App\Model\Delivery_status;
use Illuminate\Http\Request;
use Excel;
use App\Imports\TrackingImportFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Log;
use App\Export\TrackingExport;
use Validator;
use Response;
use App\DataTables\TrackingDataTable;


class PageController extends Controller
{

    public function index(TrackingDataTable $dataTable)
    {
        return $dataTable->render('datatables');
    }

    public function getPage()
    {
        $list_total_day = DB::table('detail')
            ->select('total_day')
            ->where('step_number', 0)
            ->groupBy('total_day')
            ->having(DB::raw("count(total_day)"), '>', 1)
            ->get();

        $list_supplier = List_supplier::all();
        return view('page', compact('list_supplier', 'list_total_day'));
    }

    public function getpending()
    {
        $list_total_day = DB::table('detail')
            ->select('total_day')
            ->where('step_number', 0)
            ->where('total_day', '>=', 15)
            ->groupBy('total_day')
            ->having(DB::raw("count(total_day)"), '>', 1)
            ->get();

        $list_supplier = List_supplier::all();
        return view('pending', compact('list_supplier', 'list_total_day'));
    }

    public function dataPage()
    {
        $data = DB::table('delivery_status')->Join('detail', function ($join) {
            $join->on('delivery_status.id', '=', 'detail.delivery_status')
                ->where('detail.step_number', '=', 0);
        })
            ->rightJoin('tracking', 'detail.tracking_number', '=', 'tracking.tracking_number')
            ->join('suppliers', 'tracking.supplier', 'suppliers.id')
            ->select('tracking.id', 'tracking.order_date', 'tracking.order_id', 'tracking.courier',
                'tracking.tracking_number', 'tracking.tracking_date', 'tracking.count_day', 'tracking.note', 'tracking.created_at',
                'suppliers.name as supplier', 'tracking.approved',
                'detail.process_content', 'detail.process_date', 'delivery_status.name as status',
                'detail.total_day as total');


        return $this->getdata($data);;
    }

    public function pendingPage()
    {
        $data = DB::table('delivery_status')->Join('detail', function ($join) {
            $join->on('delivery_status.id', '=', 'detail.delivery_status')
                ->where('detail.step_number', '=', 0);
        })
            ->rightJoin('tracking', 'detail.tracking_number', '=', 'tracking.tracking_number')
            ->join('suppliers', 'tracking.supplier', 'suppliers.id')
            ->where('delivery_status.id', '<>', 5)
            ->where('detail.total_day', '>=', 15)
            ->select('tracking.id', 'tracking.order_date', 'tracking.order_id', 'tracking.courier',
                'tracking.tracking_number', 'tracking.tracking_date', 'tracking.count_day', 'tracking.note', 'tracking.created_at',
                'suppliers.name as supplier', 'tracking.approved',
                'detail.process_content', 'detail.process_date', 'delivery_status.name as status',
                'detail.total_day as total');

//        $data->join('manage_big_com_sites', 'tracking.site', '=', 'manage_big_com_sites.id');

        return $this->getdata($data);;
    }

    public function getdata($data)
    {

        return DataTables()::of($data)
            ->addColumn('action', function ($value) {
                $button = '<a class="detail-modal btn btn-xs btn-clean btn-icon"
                                data-tracking_number="' . $value->tracking_number . '">
                                <i class="fa fa-history text-warning icon-md"></i>
                                </a>';
                $button .= '&nbsp;&nbsp;';
                $button .= '<a class="edit-modal btn btn-xs btn-clean btn-icon" title="Edit" data-id="' . $value->id . '"
                           data-order_date="' . $value->order_date . '" data-order_id="' . $value->order_id . '"
                           data-courier="' . $value->courier . '" data-tracking_number="' . $value->tracking_number . '"
                           data-tracking_date="' . $value->tracking_date . '" data-count_day="' . $value->count_day . '"
                           data-status="' . $value->status . '"
                           data-content="' . ucwords(strtolower($value->process_content)) . '"
                           data-process_date="' . $value->process_date . '" data-total="' . $value->total . '"
                           data-note="' . $value->note . '">
                           <i class="fa fa-pencil-alt icon-md text-danger"></i>
                        </a>';
                $button .= '&nbsp;&nbsp;';
                $button .= '<a class="update-modal btn btn-xs btn-clean btn-icon" title="Update" data-id="' . $value->id . '"
                           data-order_date="' . $value->order_date . '" data-order_id="' . $value->order_id . '"
                           data-courier="' . $value->courier . '" data-tracking_number="' . $value->tracking_number . '">
                            <i class="fa fa-upload icon-md text-update"></i>
                        </a>';

                return $button;
            })
            ->rawColumns(['action'])
            ->filterColumn('order_id', function ($query, $keyword) {
                $sql = "tracking.order_id like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->filterColumn('order_date', function ($query, $keyword) {
                $sql = "tracking.order_date like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->filterColumn('courier', function ($query, $keyword) {
                $sql = "tracking.courier like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->filterColumn('tracking_number', function ($query, $keyword) {
                $sql = "tracking.tracking_number like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->filterColumn('tracking_date', function ($query, $keyword) {
                $sql = "tracking.tracking_date like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->filterColumn('count_day', function ($query, $keyword) {
                $sql = "tracking.count_day like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->filterColumn('supplier', function ($query, $keyword) {
                if ($keyword == 'null') {
                    $query->where('tracking.supplier', '=', null);
                } else {
                    $sql = "tracking.supplier like ?";
                    $query->whereRaw($sql, ["%{$keyword}%"]);
                }
            })
            ->filterColumn('status', function ($query, $keyword) {
                $sql = "delivery_status.name like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->filterColumn('process_content', function ($query, $keyword) {
                $sql = "detail.process_content like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->filterColumn('process_date', function ($query, $keyword) {
                $sql = "detail.process_date like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->filterColumn('total', function ($query, $keyword) {
                $sql = "detail.total_day = ?";
                $query->whereRaw($sql, ["{$keyword}"]);
            })
            ->filterColumn('note', function ($query, $keyword) {
                $sql = "tracking.note like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })->setRowId('order_id')
//            ->skipTotalRecords(10)
//            ->setFilteredRecords(1000)
            ->toJson();
    }

    public function getSiteID($site_name)
    {
        $site_id = Suppliers::select('id')->where('name', $site_name)->limit(1)->get();
        foreach ($site_id as $value) {
            $id = $value->id;
        }

        return $id;
    }

    function csvToArray($filename = '', $delimiter = ',')
    {

        $file_handle = fopen($filename, 'r');

        while (!feof($file_handle)) {
            $data = fgetcsv($file_handle, 0, $delimiter);
            if ($data[5] != null) {

                if (strlen($data[0]) >= 11) {
                    $data[0] = substr($data[0], 3);
                }

                $order_id = array(
                    'order_id' => $data[1]
                );

                $time = strtotime($data[0] . "\n");
                $today = date("yy/m/d");

                $site_id = $this->getSiteID($data[6]);

                if ($time == false) {
                    $form_data = array(
                        'order_date' => $data[0],
                        'paypal_account' => $data[2],
                        'transaction_id' => $data[3],
                        'courier' => $data[4],
                        'tracking_number' => $data[5],
                        'supplier' => $site_id,
                        'tracking_date' => $today
                    );
                } else {
                    $newformat = date('yy/m/d', $time);

                    $form_data = array(
                        'order_date' => $newformat,
                        'paypal_account' => $data[2],
                        'transaction_id' => $data[3],
                        'courier' => $data[4],
                        'tracking_number' => $data[5],
                        'supplier' =>$site_id,
                        'tracking_date' => $today
                    );
                }

                Tracking::updateOrCreate($order_id, $form_data);

            }
        }
        fclose($file_handle);

        return 0;
    }

    public function import(Request $request)
    {
        $file = $request->file('files');

        $validator = Validator::make(
            [
                'file' => $file,
                'extension' => strtolower($file->getClientOriginalExtension()),
            ],
            [
                'file' => 'required',
                'extension' => 'required|in:csv',
            ]
        );

        if ($validator->passes()) {
            try {
                $customerArr = $this->csvToArray($file);
                return back();
            } catch (\Exception $e) {
                return $e;
            }

//        Excel::import(new TrackingImportFile, request()->file('file'));
        } else {
            return response()->json([
                'message' => $validator->errors()->all(),
                'message' => 'This not .csv file',
                'class_name' => 'alert-danger'
            ]);
        }
    }


    public function postEdit(Request $request)
    {

        $form_data = array(
            'order_date' => $request->order_date,
            'order_id' => $request->order_id,
            'courier' => $request->courier,
            'tracking_number' => $request->tracking_number,
            'tracking_date' => $request->tracking_date,
            'note' => $request->note
        );

        Tracking::whereId($request->id)->update($form_data);

        return response()->json(['success' => 'Data Added successfully.']);
    }

    public function Editpaypal(Request $request)
    {

        $from_data = array(
            'paypal_account' => $request->paypal_account,
            'transaction_id' => $request->transaction_id
        );

        Tracking::whereId($request->id)->update($from_data);

        return response()->json(['success' => 'Data Added successfully.']);
    }

    public function getPaypal_table()
    {
        $list_paypal_account = List_paypal_account::select('paypal_account')->get();
        return view('paypal', compact('list_paypal_account'));
    }

    public function getpaypal()
    {
        $data = Delivery_status::query()->Join('detail', function ($join) {
            $join->on('delivery_status.id', '=', 'detail.delivery_status')
                ->where('detail.step_number', '=', 0);
        })
            ->rightJoin('tracking', 'detail.tracking_number', 'tracking.tracking_number')
            ->where('tracking.tracking_number', '<>', null)
            ->select('tracking.id', 'tracking.order_date', 'tracking.order_id', 'tracking.courier',
                'tracking.tracking_number', 'tracking.tracking_date', 'tracking.paypal_account', 'tracking.update_status',
                'tracking.created_at', 'tracking.transaction_id',
                'detail.process_content', 'detail.process_date', 'delivery_status.name as status',
                'detail.total_day as total');


        return DataTables()::of($data)->addColumn('action', function ($value) {
            $button = '<a class="detail-modal btn btn-sm btn-clean btn-icon"
                                                      data-tracking_number="' . $value->tracking_number . '">
                                                      <i class="fa fa-history text-warning icon-md"></i></a>';
            $button .= '&nbsp;&nbsp;';
            $button .= '<a class="edit-modal btn btn-sm btn-clean btn-icon" title="Edit" data-id="' . $value->id . '"
                           data-paypal_account="' . $value->paypal_account . '" data-transaction_id="' . $value->transaction_id . '">
                            <i class="flaticon2-pen icon-md text-danger"></i>
                        </a>';
            $button .= '&nbsp;&nbsp;';
            $button .= '<a class="add-modal btn btn-sm btn-clean btn-icon" title="Add" data-id="' . $value->id . '"
                           data-order_date="' . $value->order_date . '" data-order_id="' . $value->order_id . '"
                           data-courier="' . $value->courier . '" data-tracking_number="' . $value->tracking_number . '"
                           data-paypal_account="' . $value->paypal_account . '" data-transaction_id="' . $value->transaction_id . '">
                            <i class="fa fa-plus-square icon-lg-2x text-success"></i>
                        </a>';
            $button .= '&nbsp;&nbsp;';
            $button .= '<a class="update-modal btn btn-sm btn-clean btn-icon" title="Update" data-id="' . $value->id . '"
                           data-order_date="' . $value->order_date . '" data-order_id="' . $value->order_id . '"
                           data-courier="' . $value->courier . '" data-tracking_number="' . $value->tracking_number . '"
                           data-paypal_account="' . $value->paypal_account . '" data-transaction_id="' . $value->transaction_id . '">
                            <i class="fa fa-upload icon-lg text-update"></i>
                        </a>';


            return $button;
        })
            ->rawColumns(['action'])
            ->filterColumn('order_id', function ($query, $keyword) {
                $sql = "tracking.order_id like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->filterColumn('order_date', function ($query, $keyword) {
                $sql = "tracking.order_date like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->filterColumn('paypal_account', function ($query, $keyword) {
                if ($keyword == 'null') {
                    $query->where('tracking.paypal_account', '=', null);
                } else {
                    $sql = "tracking.paypal_account like ?";
                    $query->whereRaw($sql, ["%{$keyword}%"]);
                }
            })
            ->filterColumn('transaction_id', function ($query, $keyword) {
                $sql = "tracking.transaction_id like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->filterColumn('courier', function ($query, $keyword) {
                $sql = "tracking.courier like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->filterColumn('tracking_number', function ($query, $keyword) {
                $sql = "tracking.tracking_number like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->filterColumn('process_date', function ($query, $keyword) {
                $sql = "detail.process_date like ?";
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->filterColumn('status', function ($query, $keyword) {
                if ($keyword == 'null') {
                    $query->where('tracking.paypal_account', '=', null);
                } else {
                    $sql = "delivery_status.name like ?";
                    $query->whereRaw($sql, ["%{$keyword}%"]);
                }
            })
            ->filterColumn('update_status', function ($query, $keyword) {
                if ($keyword == 'null') {
                    $query->where('tracking.update_status', '=', null);
                } else {
                    $sql = "tracking.update_status like ?";
                    $query->whereRaw($sql, ["%{$keyword}%"]);
                }
            })
            ->skipTotalRecords(10)
//            ->setFilteredRecords(1000)
            ->toJson(true);

    }

    public function Detail(Request $request)
    {

        $detail = Detail::where('tracking_number', $request->tracking_number)->orderBy('detail.process_date', 'desc')
            ->rightJoin('delivery_status', 'detail.delivery_status', '=', 'delivery_status.id')
            ->select('detail.process_content', 'detail.process_date', 'delivery_status.name as status', 'delivery_status.id')->get();

        $output_body = '';

        foreach ($detail as $value) {
            $output_body .= '<li id="c' . $value->id . '">
                                <a target="_blank" style="font-weight: bold;">' . $value->status . '</a>
                                <a class="float-right" style="font-weight: bold;">' . $value->process_date . '</a>
                                <p>' . $value->process_content . '</p>
                            </li>';
        }

        $data = '<ul class="timeline trackingdetail">
                    ' . $output_body . '
                </ul>';

        return response()->json($data);
    }

    public function export(Request $request)
    {
        $data_export = DB::table('delivery_status')
            ->Join('detail', function ($join) {
                $join->on('delivery_status.id', '=', 'detail.delivery_status')
                    ->where('detail.step_number', '=', 0);
            })
            ->rightJoin('tracking', 'detail.tracking_number', 'tracking.tracking_number')
            ->where('tracking.tracking_number', '<>', null)
            ->select('tracking.id as ID', 'tracking.order_date as Order date', 'tracking.order_id as Order ID', 'tracking.courier as Courier',
                'tracking.tracking_number as Tracking Number', 'tracking.tracking_date as Tracking Date',
                'tracking.supplier as Supplier', 'detail.process_content as Detail', 'detail.process_date as Process Date', 'delivery_status.name as Status',
                'detail.total_day as Total');

        return $data_export->get();
    }


    public function exportTracking(Request $request)
    {


        $rules = array(
            'to_date' => 'before:from_date',
            'from_date' => 'after:to_date',

        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toarray()));
        } else {

            $to_date = $request->to_date;
            $from_date = $request->from_date;
            $supplier = $request->supplier;
            $courier = $request->courier;
            $status = $request->status;

            $data_export = DB::table('delivery_status')
                ->Join('detail', function ($join) {
                    $join->on('delivery_status.id', '=', 'detail.delivery_status')
                        ->where('detail.step_number', '=', 0);
                })
                ->rightJoin('tracking', 'detail.tracking_number', 'tracking.tracking_number')
                ->where('order_date', '>=', $to_date)
                ->where('order_date', '<=', $from_date)
                ->select('tracking.id as ID', 'tracking.order_date as Order date', 'tracking.order_id as Order ID', 'tracking.courier as Courier',
                    'tracking.tracking_number as Tracking Number', 'tracking.tracking_date as Tracking Date',
                    'tracking.supplier as Supplier', 'detail.process_content as Detail', 'detail.process_date as Process Date', 'delivery_status.name as Status',
                    'detail.total_day as Total');

            if ($supplier != 'null') {
                $data_export->where('supplier', '=', $supplier);
            }
            if ($status != 'null') {
                $data_export->where('delivery_status.name', '=', $status);
            }

            if ($courier != 'null') {
                $data_export->where('tracking.courier', '=', $courier);
            }

            return $data_export->get();

        }
    }

    public function GetPaypalAccount()
    {
        $list_site = DB::table('tracking')
            ->select('site')
            ->groupBy('site')
            ->having(DB::raw("count(site)"), '>', 0)
            ->get();

        return view('paypal_account', compact('list_site'));
    }

    public function GetDataAccount()
    {

        $data_account = List_use_paypal::query();

        return DataTables()::of($data_account)->make(true);
    }

    public function AddAccount(Request $request)
    {

        $rules = array(
            'to_date' => 'required|before:from_date',
            'from_date' => 'required|after:to_date',
            'paypal_account' => 'required'
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toarray()));
        } else {

            $form_data = array(
                'to_date' => $request->to_date,
                'from_date' => $request->from_date,
                'paypal_account' => $request->paypal_account
            );

            List_use_paypal::create($form_data);
            return Response::json(array('success' => 'success'));
        }

    }

}
