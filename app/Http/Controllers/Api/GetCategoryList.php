<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryListResource;
use App\Models\Continent;
use App\Traits\ResponseTrait;
use Illuminate\Support\Facades\Request;

class GetCategoryList extends Controller
{
    use ResponseTrait;
    public function __construct()
    {
    }

    public function __invoke()
    {
        $response = Continent::with(['category.tournament'])->get();
        return CategoryListResource::collection($response)->response()->getData(true);
    }
}
