<?php

namespace App\v1\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PetResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'identifier' => $this->identifier,
            'nickname' => $this->nickname,
            'date_of_birth' => $this->date_of_birth,
            'about' => $this->about,
        ];
    }
}
