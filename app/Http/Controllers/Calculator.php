<?php

namespace App\Http\Controllers;



use App\DTOS\Annuitet;
use App\Http\Requests\CalculatorRequest;
use Illuminate\Http\Request;
use App\Workers\CalculatorWorker;
use App\Workers\PercentageWorker;

class Calculator extends Controller
{
    public function index() {
        return view("calculator",["percentage" => PercentageWorker::getPercentage()]);
    }
    public function calculate(CalculatorRequest $request) {
        $annuitet = new Annuitet();
        $annuitet->percentage = $request->percentage;
        $annuitet->duration = $request->duration;
        $annuitet->amount = $request->amount;
       $t =  CalculatorWorker::calculateAnnuitet(
           $annuitet
        );
        
        
        return view("calculator",["result" => $t,"percentage" => PercentageWorker::getPercentage()]);
    }
}
