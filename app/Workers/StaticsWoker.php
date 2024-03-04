<?php
namespace App\Workers;

use stdClass;
use App\Models\Credit;
use App\Models\Payment;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class StaticsWoker {

    public function getData() {
        $data = new stdClass;
        $data->creditDataAll  = Credit::all()->count();
        $data->creditDataSelleds  = $this->getSelleds();
        $data->creditDataCloseds  = $this->getCloseds();
        $data->creditDataActives = $this->getActives();

        // Amount
        $data->amountDataAllGivedAmount = $this->allAmount();
        $data->amountDataAllRecivedAmount = $this->allRecivedAmount();
        $data->amountDataAllRecivedAmountForOnlyPercentage = $this->allRecivedAmountForOnlyPercentage();
        $data->amountDataAllRemainderAmount = $this->allRemainderAmount();

        $data->amountDataAllWaited = $this->allWaitedAmount();
        return $data;
    }
    private static function getActives() {
        return DB::table('credits')
        ->where("credits.status","=",0)
        ->orderBy("credits.id","desc")
        ->count();
    }

    private static function getCloseds() {
        return DB::table('credits')
        ->where("credits.status","=",1)
        ->count();
    }
    private static function getSelleds() {
        return DB::table('credits')
        ->where("credits.status","=",2)
        ->count();
    }
    private static function allAmount() {
        return Credit::all()
        ->sum("amount");
    }
    private static function allRemainderAmount() {
        $amounts = Credit::all()->sum("amount");
        $payments = Payment::all()->sum("amount");
        return $amounts - $payments;
    }
    private static function allRecivedAmount() {
        return Payment::all()
        ->sum("amount");
    }   
    private static function allRecivedAmountForOnlyPercentage() {
        return Payment::where("deleted_amount","=",0)
        ->sum("amount");
    }
    private function allWaitedAmount() {
        $balances = Payment::where("deleted_amount",">",0)->sum("amount");

        $remainders = Credit::where("status","=",0)
        ->sum("balance");
        return   $remainders - $balances;
    }




    private function expectedAmountForThisMonth() {
        // Credit::where("payment_date")
    }

}


?>