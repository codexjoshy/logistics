<?php

namespace App\Services;

use App\Interfaces\SmsInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class Messenger implements SmsInterface
{
   //"TLdf1BzVPvw67yvNOR4eEhMSQ1nLf6JljZVB6LneKyE64qchaefNNlOkH6rhll"
   //  protected $_from = "BOOK LGSTC";
   protected $_from = "BOOK LGSTC";
   protected $_channel = "dnd";

   private $API_KEY = "TLdf1BzVPvw67yvNOR4eEhMSQ1nLf6JljZVB6LneKyE64qchaefNNlOkH6rhll";

   public function sendSMS(int $to, string $message)
   {
      return $this->send($to, $message, $this->_channel);
   }

   private function send(int $to, string $message, string $channel = 'dnd')
   {
      $response  = Http::post('https://termii.com/api/sms/send', [
         "to" => $to,
         "from" => $this->_from,
         "sms" => $message,
         "type" => "plain",
         "channel" => $channel,
         "api_key" => $this->API_KEY
      ])->json();
      
      // if ($response['status'] === 'error') {
      //    return ['status' => false, 'error' => $response];
      // }
      // return ['status' => $response, 'error' => null];
   }
}
