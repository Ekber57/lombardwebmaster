<?php

namespace App\Workers;

use App\Models\Credit;
use App\Models\Delaying;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class PenaltyWorker
{
    private $credits;

    public  function handle()
    {
        $this->detectCreditsForPenalty();
        $this->penal();
    }


    private function penal()
    {
        DB::beginTransaction();
        try {
            foreach ($this->credits as $credit) {

                // Create Carbon instances from the date strings
                $currenDate = Carbon::parse(\Carbon\Carbon::today('Asia/Baku')->format('Y-m-d'));
                $paymentDate = Carbon::parse($credit->next_payment_date);

                // Calculate the difference in days
                $diffInDays = $paymentDate->diffInDays($currenDate);
                $delaying = new Delaying();
                $delaying->credit_id = $credit->id;
                $delaying->customer_id = $credit->customer_id;
                $delaying->amount = $credit->payment_amount;
                $delaying->penalty_amount = 1;
                $delaying->delayed_days = $diffInDays;
                $delaying->save();
                DB::commit();
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
    private function detectCreditsForPenalty()
    {
        $this->credits = Credit::getDelayeds();
    }
}
