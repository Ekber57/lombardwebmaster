<?php
namespace App\DTOS;

use App\Models\Credit;

class PaymentDTO {
    public  $credit;
    public  $amount;
    public function __construct($amount,$credit)
    {
        $this->amount = $amount;
        $this->credit  =  Credit::find($credit);
    }
}

?>