<?php


use App\Models\Content;
use Illuminate\Http\Request;
use Faker\Generator;
use App\Http\Resources\ContentResource;

class ContentController extends Controller
{
    public function index()
    {
        $contents = Content::get();

        // data로 전달해주기 위해 Resource로 반환
        return ContentResource::collection($contents);
    }
    
}