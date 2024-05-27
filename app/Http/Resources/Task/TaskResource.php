<?php

namespace App\Http\Resources\Task;

use App\Http\Resources\Label\LabelResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'        => $this->id,
            'name'      => $this->name,
            'details'   => $this->details,
            'schedule'  => $this->when($this->is_schedule, $this->start_at),
            'label'     => $this->when($this->label_id, (new LabelResource($this->label)))
        ];
    }
}
