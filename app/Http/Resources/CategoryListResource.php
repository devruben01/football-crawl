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
class CategoryListResource extends JsonResource
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
            'continent' => $this->continent,
            'continent_icon' => $this->continent_icon,
            'list' => CategoryResource::collection($this->category),
        ];
    }
}
