<?php
namespace App\Services;

use App\Interfaces\SmsInterface;
use Illuminate\Http\JsonResponse;
use Zeevx\LaraTermii\LaraTermii;

class TermiiService implements SmsInterface
{
    public LaraTermii $termii;
   //  protected $_from = "BOOK LGSTC";
    protected $_from = "N-Alert";

    public function __construct() {
       $this->termii =  new LaraTermii(config('services.sms.termii.key'));
    }
    public function sendSMS(string $from, int $to, string $message){
      //  $this->termii->allSenderId();
       return $this->termii->sendMessage($to, $from, $message);
    }

    public function balance(){
      $response =  json_decode($this->termii->balance());
      if ($response->balance) {
         $data = ["balance"=> $response->balance];
         return respondWithSuccess($data, "Successful", 200);
      }
   }
   public function sendToRider($to, $address, $senderName, $senderPhone, $receiverName, $receiverPhone, $receiverAddress) 
   {
      $message = "Pick up: $senderName($senderPhone) at  $address

      Deliver: $receiverName($receiverPhone) $receiverAddress
      Item:  ";
      return $this->sendSMS($this->_from, $to, $message);
   }
   public function sendToReceiver($to, $senderName, $receiverName, $otp, $amount=null) 
   {
      $showAmt = $amount ? "Amount: $amount" : '';
      $message = "Hi, $receiverName, your item from $senderName is in transit.
      Confirmation code: $otp, $showAmt";"
      
      booklogistic.com";
      return $this->sendSMS($this->_from, $to, $message);
   }
   public function sendToSender($to, $senderName, $riderPhone, $companyName,  $otp, $order) 
   {
      $message = "Hi $senderName, riders_name ($riderPhone) of $companyName has been assigned to pick your item.
      Confirmation code: $otp
      Order_id: $order
      
      booklogistic.com";
      return $this->sendSMS($this->_from, $to, $message);
   }
   public function deliveryMessage($to, $senderName, $riderPhone, $receiverName, $companyName) 
   {
      $message = "Hi $senderName, your item has been successfully delivered to $receiverName.
      Thanks for your patronage
      
      $companyName
      booklogistic.com";
      return $this->sendSMS($this->_from, $to, $message);
   }
   
    
}

