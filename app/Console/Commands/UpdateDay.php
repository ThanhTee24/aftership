<?php

namespace App\Console\Commands;

use App\Model\Detail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdateDay extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Get:UpdateDay';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update count_day, total_day';

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
        DB::beginTransaction();
        try {
            DB::table('tracking')->update(['count_day' => DB::raw('DATEDIFF(now(), tracking_date)')]);

            DB::table('detail')->update(['total_day' => DB::raw('DATEDIFF(now(), process_date)')]);

            DB::commit();

            var_dump('Complete');
        } catch (Exception $e) {
            DB::rollBack();

            var_dump('Error');
            throw new Exception($e->getMessage());
        }

        //Chỉnh sửa đơn hàng 30 ngày không thêm tracking mới - Expired

//        $Expired = Detail::select('id', 'process_date')->where('step_number', 0)->where('delivery_status', '<>', 5)->get();
//
//        foreach ($Expired as $value){
//
//            $today = strtotime(date("yy/m/d"));
//            $first_date = strtotime($value->process_date);
//            $datediff = abs($first_date - $today);
//
//
//            if(floor($datediff / (60*60*24))>30){
//                var_dump("expired");
//                DB::table('detail')->where('id', $value->id)->update(['delivery_status' => 9]);
//            }
//        }


    }
}
