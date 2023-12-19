<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DocumentResource extends JsonResource
{
    public function toArray(Request $request)
    {
        return [
            'id' => $this->id,
            'updated_at' => $this->updated_at,
            'user_id' => $this->user_id,
            'file_path' => $this->file_path,
        ];
    }
}
