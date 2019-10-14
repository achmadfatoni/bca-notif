<?php

namespace BCA;

use BCAParser\BCAParser;
use Illuminate\Support\Facades\Log;

class Mutasi
{
    /**
     * @param $fromDate
     * @param null $toDate
     * @return array
     */
    public function getTransactions($fromDate, $toDate = null)
    {
        if (empty($toDate)) {
           $toDate = date('Y-m-d');
        }
        $parser = new BCAParser(config('klikbca.username'), config('klikbca.password'));
        $transactions = [];
        try {
            $transactions = $parser->getListTransaksi($fromDate, $toDate);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
        $parser->logout();

        return $transactions;
    }
}
