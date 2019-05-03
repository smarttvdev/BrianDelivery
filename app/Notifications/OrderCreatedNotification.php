<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class OrderCreatedNotification extends Notification
{
    use Queueable;
    protected $customer_id,$phone_number, $order_title, $order_content, $start_lat, $start_lng, $end_lat, $end_lng, $min_price, $max_price, $round_trip,
              $stuff_weight, $stuff_width, $stuff_height, $waiting_time;


    public function __construct($customer_id,$phone_number, $order_title, $order_content, $start_lat, $start_lng, $end_lat, $end_lng, $min_price, $max_price, $round_trip,
                                $stuff_weight, $stuff_width, $stuff_height, $waiting_time)
    {
        $this->customer_id=$customer_id;
        $this->phone_number=$phone_number;
        $this->ordered_title=$order_title;
        $this->order_content=$order_content;
        $this->start_lat=$start_lat;
        $this->start_lng=$start_lng;
        $this->end_lat=$end_lat;
        $this->end_lng=$end_lng;
        $this->min_price=$min_price;
        $this->max_price=$max_price;
        $this->round_trip=$round_trip;
        $this->stuff_weight=$stuff_weight;
        $this->stuff_width=$stuff_width;
        $this->stuff_height=$stuff_height;
        $this->waiting_time=$waiting_time;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'customer_id'=>$this->customer_id,
            'phone_number'=>$this->customer_id,
            'ordered_title'=>$this->ordered_title,
            'order_content'=>$this->order_content,
            'start_lat'=>$this->start_lat,
            'start_lng'=>$this->start_lng,
            'end_lat'=>$this->end_lat,
            'end_lng'=>$this->end_lng,
            'min_price'=>$this->min_price,
            'max_price'=>$this->max_price,
            'round_trip'=>$this->round_trip,
            'stuff_weight'=>$this->stuff_weight,
            'stuff_width'=>$this->stuff_width,
            'stuff_height'=>$this->stuff_height,
            'waiting_time'=>$this->waiting_time,
        ];
    }

    public function toArray($notifiable)
    {
        return [

        ];
    }
}
