<?php

namespace App\Console\Commands;

use App\Model\Paypal_acconut;
use App\Model\Tracking;
use Illuminate\Console\Command;

class PaypalAccount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Get:Paypal';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Lấy thông tin paypal account theo ngày';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $paypal = Paypal_acconut::orderBy('id', 'DESC')->limit(1)->get();
dd($paypal);
//        foreach ($paypal as $value){
//            Tracking::where('tracking_date', '>=', $value->to_date)
//                ->where('tracking_date', '<=', $value->from_date)
//                ->where('paypal_account', null)
//        }
    }
}
