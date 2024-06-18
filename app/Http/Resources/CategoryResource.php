<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

/**
 * @OA\Schema(
 *   @OA\Xml(name="SampleResource"),
 *   @OA\Property(property="data", type="array",
 *      @OA\Items(ref="#/components/schemas/Sample"))
 *   ),
 * )
 */
class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return [
            'category_id' => $this->category_id,
            'category_name' => $this->category_name,
            'icon' => $this->icon,
            'tournament' => TournamentResource::collection($this->tournament),
        ];
    }
}
