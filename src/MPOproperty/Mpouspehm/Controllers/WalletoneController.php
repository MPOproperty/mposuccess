<?php

namespace MPOproperty\Mpouspehm\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use MPOproperty\Mpouspehm\Models\TypeTransaction;
use MPOproperty\Mpouspehm\Repositories\Transaction\TransactionRepository;
use MPOproperty\Mpouspehm\Repositories\Transaction\TypeTransactionRepository;
use MPOproperty\Mpouspehm\WalletOne\Request as WelletonRequest;
use MPOproperty\Mpouspehm\WalletOne\Response;

class WalletoneController extends Controller{

    const fileName = 'file.txt';

    public function paymentLog()
    {
        $current = file_get_contents(self::fileName);
        echo 'log';

        echo '<pre>' . $current . '</pre>';
    }

    public function transactionResult(Request $request)
    {
        $this->logToFile('transaction result');

        $response = new Response();
        $response->checkResponse($request);
    }

    // Our custom error handler
    function logToFile($text)
    {
        $fp = fopen(self::fileName, 'a');
        fwrite($fp, $text . PHP_EOL);
        fclose($fp);
//        chmod(self::fileName, 0777);  //changed to add the zero
    }

}