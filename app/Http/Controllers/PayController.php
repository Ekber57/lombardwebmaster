<?php

namespace App\Http\Controllers;

use App\Models\Credit;
use App\DTOS\PaymentDTO;
use Illuminate\Http\Request;
use App\Workers\PaymentWoker;
use App\Http\Requests\PayRequest;

class PayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Credit $credit)
    {
        return view("paymentform",
        [
            "credit" => $credit,
            "customer" => $credit->customer(),
        ]
    
    );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(PayRequest $payRequest)
    {
        $payment = new PaymentDTO($payRequest->amount,$payRequest->credit_id);
        $paymentWorker = new PaymentWoker();
        $paymentWorker->pay($payment);
        return view("payedcheck",[
            "payment" => $payment,
        ]);
    }    

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
