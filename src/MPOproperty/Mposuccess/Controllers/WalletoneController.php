<?php

namespace MPOproperty\Mposuccess\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use MPOproperty\Mposuccess\Models\TypeTransaction;
use MPOproperty\Mposuccess\Repositories\Transaction\TransactionRepository;
use MPOproperty\Mposuccess\Repositories\Transaction\TypeTransactionRepository;
use MPOproperty\Mposuccess\WalletOne\Request as WelletonRequest;
use MPOproperty\Mposuccess\WalletOne\Response;

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