<?php

namespace App\Http\Resources\Order;

use Illuminate\Http\Resources\Json\JsonResource;

class Order extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [

            'id' => $this->id,
            'email' => $this->email,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'phone' => $this->phone,
            'address' => $this->address,
            'city' => $this->city,
            'state' => $this->state,
            'postal_code' => $this->postal_code,
            'country' => $this->country,
            'shipping_address' => $this->shipping_address,
            'shipping_email' => $this->shipping_email,
            'shipping_note' => $this->shipping_note,
            'subtotal' => $this->subtotal,
            'total' => $this->total,
            'items' => $this->items->map(static function ($item) {
                return Item::make($item);
            }),
        ];
    }
}
