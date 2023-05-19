<?php

namespace App\Http\Resources\Site;

use App\Models\Shop\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'status' => $this->status === Product::ACTIVE ? 'Active' : 'Inactive',
            'title' => $this->title,
            'description' => $this->description,
            'image' => !is_null($this->image) ? $this->image : env('NO_IMAGE'),
            'price' => $this->price,
            'created_at' => $this->created_at->diffforhumans()
        ];
    }
}
