<?php

namespace App\Http\Resources\Donation;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DonationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'donation_no' => $this->donation_no,
            'status' => $this->payment_status,
            'amount' => $this->amount_total,
            'receipt' => $this->receipt,
            'created_at' => $this->created_at->diffforhumans()
        ];
    }
}
