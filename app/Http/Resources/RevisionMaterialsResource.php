<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RevisionMaterialsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'revisionId' => $this->revisionId,
            'materialId' => $this->materialId,
            'oldAmount' => $this->oldAmount,
            'type' => $this->type,
            'amount' => $this->amount,
            'material' => MaterialResource::make($this->materials),
        ];
    }
}
