<?php

namespace App\Http\Resources\Label;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LabelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'title'         => $this->title,
            'color'         => $this->color,
            'created_by'    => [
                'id'    => $this->user->id,
                'name'  => $this->user->name
            ]
        ];
    }
}
