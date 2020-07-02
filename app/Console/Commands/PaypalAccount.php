<?php

namespace App\Console\Commands;

use App\Model\List_use_paypal;
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
        $paypal = List_use_paypal::orderby('id', 'DESC')->limit(1)->get();

        foreach ($paypal as $paypal){
            $null_account_paypal = Tracking::where('order_date', '>=', $paypal->to_date)
                ->where('order_date', '<=', $paypal->from_date)
                ->where('paypal_account', null)
                ->select('id')
                ->get();

            foreach ($null_account_paypal as $null_account_paypal){
                var_dump($null_account_paypal->id);
                Tracking::where('id', $null_account_paypal->id)->update(['paypal_account' => $paypal->paypal_account]);
            }
        }
    }
}
