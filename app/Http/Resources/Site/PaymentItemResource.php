<?php

namespace App\Http\Resources\Site;

use App\Models\Shop\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $product = Product::where('id',$this->product_id)->first();
        return [
            'id' => $this->id,
            'product' => $product ? new ProductResource($product) : null
        ];
    }
}
