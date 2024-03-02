<?php

namespace App\Http\Controllers;

use App\DTOS\Annuitet;
use App\Http\Requests\CreditAddRequest;
use App\Models\Credit;
use App\Models\Customer;
use App\Workers\CalculatorWorker;
use App\Workers\PercentageWorker;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use stdClass;

class CreditController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request,string $filter = "")
    {
        $this->authorize('show credit',self::class);
        $filter =  $request->query("filter");      
        switch($filter) {
            case 'active':
                return view("creditlist",["credits" => Credit::getActives(),"filter"=>$filter]);
                break;
            case 'delayed':
                echo "2";
                return view("creditlist",["credits" => Credit::getDelayeds(),"filter"=>$filter]);
                break;
            case 'closed':
                return view("creditlist",["credits" => Credit::getCloseds(),"filter"=>$filter]);
                break;
            case 'selled':
                return view("creditlist",["credits" => Credit::getSelleds(),"filter"=>$filter]);
                break;
            case 'today':
                return view("creditlist",["credits" => Credit::getTodays(),"filter"=>$filter]);
                break;
            default:
                return view("creditlist",["credits" => Credit::getAll(),"filter"=>$filter]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Customer $customer)
    {
        $this->authorize('create credit',self::class);
        return view("creditcreateform",[
            "customer" => $customer,
            "percentage" => PercentageWorker::getPercentage()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreditAddRequest $request)
    {
        //
        $this->authorize('create credit',self::class);
        // percentage logic
        $percentage = PercentageWorker::getPercentage();

        if((Auth::user())->hasPermissionTo("change percentage")){
            $percentage = $request->percentage;
        }
        //
        $creditDatas = $this->countCreditDatas($request->amount,$request->duration,$percentage);
        if(!empty($request->note)) {
            $note = $request->note;
        }
        else {
            $note = "hec bir qeyd daxil edilmeyib";
        }
        $credit = Credit::create([
            "customer_id" => $request->customer_id,
            "amount" => $request->amount,
            "remainder" => $creditDatas->remainder,
            "balance" => $creditDatas->balance,
            "percentage" => $percentage,
            "percentage_amount" => $creditDatas->percentage,
            "base_debt" => $creditDatas->baseDebt,
            "next_payment_date" => $creditDatas->nextPaymentDate,
            "payment_amount" => $creditDatas->paymentAmount,
            "data" => $creditDatas->data,
            "annuted" => round($creditDatas->annuted,2),
            "duration" => $request->duration,
            "user" => Auth::user()->id,
            "note" => $note
        ]);
        return redirect("/credits/showcheck/".$credit->id);
    }

    /**
     * Display the specified resource.
     */

    public function showCehck(Credit $credit) {
        $credit = Credit::find($credit->id);
        $data = json_decode($credit->data);
        return view("creditshow",[
            'credit' => $credit,'data' => $data]);
    }
    public function show(Credit $credit)
    {
        echo $credit->id;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Credit $credit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Credit $credit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Credit $credit)
    {
        //
    }

    private function countCreditDatas($amount,$duration,$percentage) {
        $curentDate = Carbon::now();
        $annuitet = new Annuitet();
        $annuitet->percentage = $percentage;
        $annuitet->duration = $duration;
        $annuitet->amount = $amount;
        $calculate = CalculatorWorker::calculateAnnuitet($annuitet);
        $datas = new stdClass();
        $datas->paymentAmount = $calculate[0]["payment"];
        $datas->baseDebt = $calculate[0]["base_debt"];
        $datas->percentage = $calculate[0]["percentage"]; ;
        $datas->balance =  $calculate[0]["payment"] * $duration;
        $datas->nextPaymentDate = $curentDate->addMonth();
        $datas->annuted = $calculate[0]["payment"];
        $datas->data = json_encode($calculate);
        $datas->remainder = $amount;
        return $datas;
    }
}
