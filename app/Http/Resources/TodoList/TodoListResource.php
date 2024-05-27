<?php

namespace App\Http\Resources\TodoList;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TodoListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'    => $this->id,
            'name'  => $this->name,
            'created_by'    => [
                'id'    => $this->user->id,
                'name'  => $this->user->name
            ]
        ];
    }
}
