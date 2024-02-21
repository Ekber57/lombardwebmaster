<?php

namespace App\Workers;


class PercentageWorker
{
    public static function getPercentage() {
        return env("PERCENTAGE");
    }

    public static function setPercentage(int $percentage) {
       $percentage = preg_replace('/\s+/', '',$percentage); //replace special ch
        $key = strtoupper("PERCENTAGE"); //force upper for security
        $env = file_get_contents(isset($env_path) ? $env_path : base_path('.env')); //fet .env file
        $env = str_replace("$key=" . env($key), "$key=" .$percentage, $env); //replace 
        $env = file_put_contents(isset($env_path) ? $env_path : base_path('.env'), $env);
    }
}
