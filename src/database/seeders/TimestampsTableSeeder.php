<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class TimestampsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $today = Carbon::today()->toDateString();

        DB::table('timestamps')->insert([
            [
            'user_id'=> '1',
            'start_work'=>'09:00:00',
            'end_work'=>'18:00:00',
            'day' => $today,
            'totalwork'=>'09:00:00',
            'worktime' => '09:00:00',
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now(),
            ],
            [
            'user_id'=> '2',
            'start_work'=>'09:00:00',
            'end_work'=>'18:00:00',
            'day' => $today,
            'totalwork'=>'09:00:00',
            'worktime'=>'09:00:00',
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now(),
            ],
            [
            'user_id'=> '3',
            'start_work'=>'09:00:00',
            'end_work'=>'18:00:00',
            'day' => $today,
            'totalwork'=>'09:00:00',
            'worktime'=>'09:00:00',
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now(),
            ],
            [
            'user_id'=> '4',
            'start_work'=>'09:00:00',
            'end_work'=>'18:00:00',
            'day' => $today,
            'totalwork'=>'09:00:00',
            'worktime'=>'09:00:00',
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now(),
            ],
            [
            'user_id'=> '5',
            'start_work'=>'09:00:00',
            'end_work'=>'18:00:00',
            'day' => $today,
            'totalwork'=>'09:00:00',
            'worktime'=>'09:00:00',
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now(),
            ],
            [
            'user_id'=> '6',
            'start_work'=>'09:00:00',
            'end_work'=>'18:00:00',
            'day' => $today,
            'totalwork'=>'09:00:00',
            'worktime'=>'09:00:00',
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now(),
            ],
            [
            'user_id'=> '7',
            'start_work'=>'09:00:00',
            'end_work'=>'18:00:00',
            'day' => $today,
            'totalwork'=>'09:00:00',
            'worktime'=>'09:00:00',
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now(),
            ],
            [
            'user_id'=> '8',
            'start_work'=>'09:00:00',
            'end_work'=>'18:00:00',
            'day' => $today,
            'totalwork'=>'09:00:00',
            'worktime'=>'09:00:00',
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now(),
            ],
            [
            'user_id'=> '9',
            'start_work'=>'09:00:00',
            'end_work'=>'18:00:00',
            'day' => $today,
            'totalwork'=>'09:00:00',
            'worktime'=>'09:00:00',
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now(),
            ],
            [
            'user_id'=> '10',
            'start_work'=>'09:00:00',
            'end_work'=>'18:00:00',
            'day' => $today,
            'totalwork'=>'09:00:00',
            'worktime'=>'09:00:00',
            'created_at'=> Carbon::now(),
            'updated_at'=> Carbon::now(),
            ],
        ]);
    }
}