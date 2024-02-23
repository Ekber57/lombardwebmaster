<?php
namespace App\Http\Controllers;

use App\Workers\StaticsWoker;

class StaticsController extends Controller {

    public function index(StaticsWoker $staticsWoker) {
   
        return view("statics",[
        "creditData" => $staticsWoker->getData()],
    );
    }
}
?>