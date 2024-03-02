<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Credit extends Model
{
    use HasFactory;
    protected $fillable = [
     'amount',
     'annuted',
     'remainder',
     'percentage',
     'percentage_amount',
     'base_debt',
     'customer_id',
     'balance',
     'next_payment_date',
     'payment_amount',
     'last_payment_date',
     'duration',
     'data',
     'user',
     'note'
    ];
    public function customer()
    {
        return Customer::find($this->customer_id);
    }

    public static function getAll() {
        return DB::table('credits')
        ->join("customers","credits.customer_id","customers.id")
        ->select(["credits.*","customers.phone","customers.id as customer_id","customers.lastname","customers.middlename","customers.name"])
       
        ->paginate(2);
    }
    public static function getActives() {
        return DB::table('credits')
        ->join("customers","credits.customer_id","customers.id")
        ->select(["credits.*","customers.phone","customers.id as customer_id","customers.lastname","customers.middlename","customers.name"])
        ->where("credits.status","=",0)
        ->orderBy("credits.id","desc")
        ->paginate();
    }
    public static function getDelayeds() {
        return DB::table('credits')
        ->join("customers","credits.customer_id","customers.id")
        ->whereDate("next_payment_date","<",Carbon::today("Asia/Baku")->format("Y-m-d"))
        ->select(["credits.*","customers.phone","customers.id as customer_id","customers.lastname","customers.middlename","customers.name"])
        ->where("credits.status","=",0)
        ->paginate(15);
    }
    public static function getTodays() {
        return DB::table('credits')
        ->join("customers","credits.customer_id","customers.id")
        ->whereDate("next_payment_date","=",Carbon::today("Asia/Baku")->format("Y-m-d"))
        ->select(["credits.*","customers.phone","customers.id as customer_id","customers.lastname","customers.middlename","customers.name"])
        ->where("credits.status","=",0)
        ->paginate(15);
    }
    public static function getCloseds() {
        return DB::table('credits')
        ->join("customers","credits.customer_id","customers.id")
        ->select(["credits.*","customers.phone","customers.id as customer_id","customers.lastname","customers.middlename","customers.name"])
        ->where("credits.status","=",1)
        ->paginate(15);
    }
    public static function getSelleds() {
        return DB::table('credits')
        ->join("customers","credits.customer_id","customers.id")
        ->select(["credits.*","customers.phone","customers.id as customer_id","customers.lastname","customers.middlename","customers.name"])
        ->where("credits.status","=",2)
        ->paginate(15);
    }


 
}
