<?php
namespace App\Workers;

use App\DTOS\Annuitet;
use Illuminate\Support\Carbon;


class CalculatorWorker {
 
    public static function calculateAnnuitet(Annuitet $annuitet) {
        $table = array();
        $FM = ($annuitet->percentage / (12 * 100)) ;
        $AO_top  = ($annuitet->amount * $FM);
        $AO_bootom = 1 - (1 / pow(1 + $FM,$annuitet->duration));
        $AO = $AO_top / $AO_bootom;


        $date = Carbon::now()->addMonth(1); // or any other Carbon instance

// Add 3 months to the current date


        for($i = 0; $i < $annuitet->duration; $i++) {
       
            if($i == 0) {
                $table[] = array(
                    "payment" => $AO,
                    "percentage" => $annuitet->amount * $FM,
                    "base_debt" =>  $AO -  ($annuitet->amount * $FM),
                    "remainder" => $annuitet->amount -( $AO -  $annuitet->amount * $FM),
                    "payment_date" =>  $date->format("d.m.y"),

                );
            }
           else if($i == 1) {
                $table[] = array(
                    "payment" => $AO,
                    "percentage" =>( $annuitet->amount -  $table[($i - 1)]["base_debt"] )* $FM,
                    "base_debt" =>$AO -  ( $annuitet->amount -  $table[($i - 1)]["base_debt"] )* $FM,
                    "remainder" => $table[($i - 1)]["remainder"] - ($AO -  ( $annuitet->amount -  $table[($i - 1)]["base_debt"] )* $FM),
                    "payment_date" =>  $date->format("d.m.y"),

                );
            }
           else {

                $table[] = array(
                    "payment" => $AO,
                     "percentage" =>($table[($i - 2)]["remainder"] - $table[($i - 1)]["base_debt"]) *$FM,
                    "base_debt" =>$AO - ($table[($i - 2)]["remainder"] - $table[($i - 1)]["base_debt"]) *$FM,
                    "remainder" => ($table[($i - 1)]["remainder"]) - ($AO - ($table[($i - 2)]["remainder"] - $table[($i - 1)]["base_debt"]) *$FM),
                    "payment_date" =>  $date->format("d.m.y"),

                );
            }
            $date = $date->addMonth();
        }
        
        return $table;    
   }
}



// $a = new Annuitet();
// $a->duration = 12;
// $a->percentage = 36;
// $a->amount = 1000;
// foreach(CalculatorWorker::calculateAnnuitet($a) as $c) {
// 	// // $a =;
// 	// echo   ;
    
//   echo number_format(round($c["base_debt"],2),2). number_format(round($c["base_debt"],2),2)." | ".number_format(round($c["base_debt"],2),2)." | ".number_format(round($c["base_debt"],2),2)."<br>";
// }