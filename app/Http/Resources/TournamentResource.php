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
class TournamentResource extends JsonResource
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
            'tournament_id' => $this->tournament_id,
            'tournament_name' => $this->tournament_name,
            'tournament_en_name' => $this->tournament_en_name,
            'tournament_url_name' => $this->tournament_url_name,
            'logo_url' => $this->tournament_urllogo_url_name,
        ];
    }
}
