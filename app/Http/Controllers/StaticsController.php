<?php
namespace App\Http\Controllers;

use App\Workers\StaticsWoker;

class StaticsController extends Controller {

    public function index(StaticsWoker $staticsWoker) {
        print_r($staticsWoker->getData());
        return view("statics",[
        "creditData" => $staticsWoker->getData()],
    );
    }
}
?>