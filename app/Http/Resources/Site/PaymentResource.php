<?php

namespace App\Http\Resources\Site;

use App\Models\Shop\PaymentItem;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        $items = PaymentItem::where('payment_id',$this->id)->get();

        return [
            'id' => $this->id,
            'payment_no' => $this->payment_no,
            'status' => $this->payment_status,
            'items' => PaymentItemResource::collection($items),
            'amount' => $this->amount_total,
            'receipt' => $this->receipt,
            'created_at' => $this->created_at->diffforhumans()
        ];
    }
}
