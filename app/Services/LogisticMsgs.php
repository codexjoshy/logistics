<?php
    namespace App\Services;


class LogisticMsgs extends Messenger {
    protected $sender = [];
    protected $recipient = [];
    protected $rider;
    protected $company;

    /**
     * Undocumented function
     *
     * @param array $sender should contain ["name"=><name>, "phone"=><phone>]
     * @param array $recipient should contain ["name"=><name>, "phone"=><phone>]
     * @param array|null $rider should contain ["name"=><name>, "phone"=><phone>]
     * @param string|null $company name of the company
     */
    public function __construct(array $sender, array $recipient, ?array $rider=null, ?string $company=null) {
        $this->sender = $sender;
        $this->recipient = $recipient;
        $this->rider = $rider;
        $this->company = $company;
    }
    /**
     * Undocumented function
     *
     * @param string $person should contain rider|sender|receiver
     * @param string $otp
     * @param string|null $amount
     * @param array|null $pickupLocation
     * @param array|null $destinationLocation
     * @return array ["status"=> <status>, "error"=><>]
     */
    public function sendOTP(string $person, string $otp, ?string $amount=null, ?array $pickupLocation = [], ?array $destinationLocation = [], ?string $order=null, ?string $type)
    {
        $senderName = $this->sender['name'];
        $senderPhone = $this->sender['phone'];
        $receiverName = $this->recipient['name'];
        $receiverPhone = $this->recipient['phone'];

        $pickup = isset($pickupLocation[0]) ? $pickupLocation[0] : '';
        $morePickup = isset($pickupLocation[1]) ? $pickupLocation[1] : '';
        $destination = isset($destinationLocation[0]) ? $destinationLocation[0] : '';
        $moreDestination = isset($destinationLocation[1]) ? $destinationLocation[1] : '';

        if ($person == 'rider') {
            $message = "Pick up: $senderName($senderPhone) at  {$pickup} Deliver: $receiverName($receiverPhone) {$destination}";
            $to = $this->rider['phone'];
            $message = "Pickup: {$pickup} - {$morePickup} ($senderPhone) Delivery: $destination - $moreDestination  ($receiverPhone) Type:$type #order-$order.
            booklogistic.com/dashboard";
        }
        if ($person == 'sender') {
            $showAmt = $amount ? "Amount: $amount" : '';            
            $message = "Dear Customer,  {$this->rider['name']}({$this->rider['phone']}) has been assigned to pick your item for delivery.#order-$order. Your code:$otp
            booklogistic.com/#track";
            $to = $senderPhone;
        }
        if ($person == 'receiver') {
            $showAmt = $amount ? "Amount: $amount" : '';            
            $message = "Dear Customer,  {$this->rider['name']}({$this->rider['phone']}) has been assigned to pick your item for delivery.#order-$order Your code:$otp.
            booklogistic.com/#track";
            $to = $receiverPhone;
        }
        $this->sendSMS($to, $message);
    }

    /**
     * send delivery  Message to the sender
     *
     * @return array ["status"=> <status>, "error"=><>]
     */
    public function deliveryMessage($companyName) 
    {
      $message = "Hi {$this->sender['name']}, your item has been successfully delivered to {$this->recipient['name']}.
      Thanks for your patronage, {$companyName} booklogistic.com";
      return $this->sendSMS( $this->sender['phone'], $message);
    }
    /**
     * send delivery  Message to the sender
     *
     * @return array ["status"=> <status>, "error"=><>]
     */
    public function itemPickedMessage(string $companyName, string $riderName) 
    {
        $receiver = $this->recipient;
        $receiverPhone = $receiver['phone'];
        $receiverName = $receiver['name'];

      $message = "Hi $receiverName, your item has been successfully picked up by $riderName.
      Thanks for your patronage,  {$companyName} booklogistic.com/#track";
      return $this->sendSMS($receiverPhone, $message);
    }
}
    