<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class FileResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'fileName' => $this->fileName,
            'filePath' => $this->filePath,
            'ParentName' => $this->ParentName,
            'user_id' => $this->user_id,
            'folder_id' => $this->folder_id,
            'fileSize' =>Storage::size('public/'.$this->filePath)
        ];
    }
}
