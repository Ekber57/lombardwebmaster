<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = [
        'amount',
        'remainder',
        'credit_id',
        'required_amount',
        'payment_date',
        'payed_date',
        'user'
 
       ];
       public function credit()
       {
           return Credit::find($this->credit_id);
       }

       public static function getByCreditId(Credit $credit) {
        return self::where("credit_id",'=',$credit->id)->orderBy("created_at","DESC")->paginate(7);
       }
}
