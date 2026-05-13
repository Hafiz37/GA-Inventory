<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AssetResource extends JsonResource
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
            'nama_barang' => $this->name,
            'kategori' => $this->category->name,
            'merk' => $this->brand,
            'stok' => $this->stock,
            'status' => $this->status,
            'dibuat_pada' => $this->created_at->format('d-m-Y'),
        ];
    }
}
