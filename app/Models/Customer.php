<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'lastname',
        'middlename',
        'fincode',
        'adress',
        'phone',
    ];
    public static function search($search)
    {
        // $search = explode(" ",$search);
        $customers = Customer::where(function ($query) use ($search) {
            $search = explode(" ",$search);
            $count = count($search);
            if($count == 1) {
                $query->where('name', 'like', '%' . $search[0] . '%')
                ->orWhere('middlename', 'like', '%' . $search[0] . '%')
                ->orWhere('lastname', 'like', '%' . $search[0] . '%')
                ->orWhere('phone', 'like', '%' . $search[0] . '%');
          
            }
            else if($count == 2) {
                
                $query->where('name', 'like', '%' . $search[0] . '%')
                ->where('lastname', 'like', '%' . $search[1] . '%');
               
            }
            else if($count == 3) {
                $query->where('name', 'like', '%' . $search[0] . '%')
                ->where('lastname', 'like', '%' . $search[1] . '%')
                ->where('middlename', 'like', '%' . $search[2] . '%');
            }
            else {
                $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('lastname', 'like', '%' . $search . '%');
            }
        })->paginate(10000);

        return $customers;
    }

}
