<?php

namespace App\Workers;

use Carbon\Carbon;
use App\Models\Payment;
use App\DTOS\PaymentDTO;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PaymentWoker
{
    public function pay(PaymentDTO $paymentDTO)
    {
        DB::beginTransaction();
        try {
            $amount = $paymentDTO->amount;
            $paymentDTO->last_remainder = $paymentDTO->credit->remainder;
            $paymentDTO->credit = $paymentDTO->credit;
            if ($paymentDTO->amount  >= $paymentDTO->credit->percentage_amount) {
                //! Bir ayliq odenis et
                // echo "odenis " . $paymentDTO->amount . "<br>";
                $paymentDTO->amount = round($paymentDTO->amount -  $paymentDTO->credit->percentage_amount, 2);
            
                if ($paymentDTO->amount > 0) {
                    $paymentDTO->credit->remainder = round($paymentDTO->credit->remainder - $paymentDTO->amount, 2);
                    // echo "Remainder azaldi".$paymentDTO->credit->remainder;;
                }
                
                $monthly_percentage = ($paymentDTO->credit->percentage / (12    * 100));
                $paymentDTO->credit->percentage_amount = round(($paymentDTO->credit->remainder * $monthly_percentage), 2);
                $paymentDTO->credit->base_debt = $paymentDTO->credit->annuted - $paymentDTO->credit->percentage_amount;
                $paymentDTO->credit->payment_amount  =  round($paymentDTO->credit->percentage_amount + $paymentDTO->credit->base_debt, 2);
                $paymentDTO->credit->next_payment_date = (Carbon::parse($paymentDTO->credit->next_payment_date)->addMonth());
                $paymentDTO->payment = $this->addPayment($paymentDTO,$amount);
            } 
            
            else {
                $date = Carbon::parse($paymentDTO->credit->next_payment_date);
                $newDate = $date->addMonths(1);
                $paymentDTO->credit->next_payment_date = $newDate;
                $paymentDTO->payment = $this->addPayment($paymentDTO,$amount);
            }
    
            if($paymentDTO->credit->remainder == 0) {
                $paymentDTO->credit->base_debt = 0;
                $paymentDTO->credit->percentage_amount = 0;
                $paymentDTO->credit->status = 1;
                
            }
            $paymentDTO->credit->last_payment_date = Carbon::today();
            $paymentDTO->credit->save();
            DB::commit();    
            //code...
        } catch (\Throwable $th) {
            DB::rollBack();
        }
       
    }


    private function addPayment(PaymentDTO $paymentDTO,$amount)
    {
        $payment = new Payment();
        $payment->credit_id = $paymentDTO->credit->id;
        $payment->required_amount = round($paymentDTO->credit->payment_amount, 2);
        $payment->amount = $amount;
        $payment->deleted_amount = $paymentDTO->last_remainder - $paymentDTO->credit->remainder;
        $payment->payment_date = $paymentDTO->credit->next_payment_date;
        $payment->base_debt = $paymentDTO->credit->base_debt;
        $payment->percentage_amount = $paymentDTO->credit->percentage_amount;
        $payment->remainder = $paymentDTO->credit->remainder;
        $payment->payed_date = Carbon::today();
        $payment->user = Auth::user()->id;
        $payment->save();
        return $payment;
    }
}
