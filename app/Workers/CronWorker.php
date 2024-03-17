<?php
namespace App\Workers;


class CronWorker {
    public static  function run()
    {
        $penaltyWorker = new PenaltyWorker();
        $penaltyWorker->handle();
    }
}



?>