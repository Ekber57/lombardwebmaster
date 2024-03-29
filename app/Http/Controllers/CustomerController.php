<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Credit;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Policies\CustomerPolicy;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\CustomerAddRequest;
use App\Models\Delaying;

class CustomerController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter  = $request->query("filter");
        $this->authorize('show customer list',self::class);

        if(!empty($filter)) {
            $customers = Customer::search($filter);
        }
        else {
            $customers = Customer::paginate(8); 
        }
   
        return view("customerlist",[
            "customers" => $customers,
            "filter" => $filter
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create customer',self::class);
        return view("customerform");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerAddRequest $request)
    {
        $this->authorize('create customer',self::class);
        $customer = Customer::create($request->only([
            "name",
            "lastname",
            "middlename",
            "phone",
            "fincode",
            "adress"
        ]));
        return redirect('/customers/show/'.$customer->id);
    }

    /**
     * Display the specified resource.
     */
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $this->authorize('edit customer',self::class);
        return view("customereditform",["customer"=>Customer::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->authorize('edit customer',self::class);
        $customer = Customer::find($id);
        $customer->name = $request->name;
        $customer->lastname = $request->lastname;
        $customer->middlename = $request->middlename;
        $customer->phone = $request->phone;
        $customer->adress = $request->adress;
        $customer->fincode = $request->fincode;
        $customer->save();
        return view("customereditform",["message" => "Müştəri məlumatları yeniləndi"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function show(Customer $customer)
    {
    $this->authorize('show customer list',self::class);
        $credits = Credit::where("customer_id","=",$customer->id)->paginate(5);
        $delaings = Delaying::where("customer_id","=",$customer->id)->paginate(5);
        return view("customershow",[
            "credits" => $credits,
            "delayings" => $delaings,
            "customer"=>$customer
        ]);
    
    }
}
