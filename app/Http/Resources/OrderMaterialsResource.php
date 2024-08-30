<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderMaterialsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'scladId' => $this->scladId,
            'orderId' => $this->orderId,
            'amount' => $this->amount,
            'material' => ScladResource::make($this->scladMaterials),
        ];
    }
}
