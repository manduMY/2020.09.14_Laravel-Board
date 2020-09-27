<?php


use App\Models\Content;
use App\Http\Resources\ContentResource;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Redis;
use Faker\Generator;

class ContentController extends Controller
{
    public function index()
    {
        if ($redis = Redis::get('contents.list')) {
            return ContentResource::collection(json_decode($redis));
        }
        
        $redis = Content::latest()->get();
        
        // setex(redis key, 몇 초 뒤에 redis 저장소에서 데이터 삭제할지(단위:s), key에 들어갈 value 값들)
        Redis::setex('contents.list', 180,$redis->toJson());

        // data로 전달해주기 위해 Resource로 반환
        return ContentResource::collection($redis);
    }
    
    public function create(Request $request)
    {
        // 유효성 검사 제목이 있어야 한다.
        $rules = array(
            'title' => 'required',
        );
        $validator = Validator::make($request->all(), $rules);
        
        // 유효성 검사 실패시 에러 response 보냄.
        if ($validator->fails()) {
            return response()->json([      
            ],Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        
        $content = new Content([
            'title' => $request->input('title'),
            'context' => $request->input('context')
        ]);
        $content->save();
        
        Redis::flushall();

        // 정상적으로 데이터 넣은 후 정상 response 보냄.
        return response()->json([
        ], Response::HTTP_OK);
    }

    public function findContent($id)
    {
        $content = Content::find($id);

        return response()->json($content);
    }

    public function update($id, Request $request)
    {
        $rules = array(
            'title'       => 'required',
        );
        $validator = Validator::make($request->all(), $rules);
        
        if ($validator->fails()) {
            return response()->json([
            ],Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $content = Content::find($id);
        $content->update($request->all());

        Redis::flushall();

        return response()->json([
        ], Response::HTTP_OK);
    }

    public function delete($id)
    {
        Redis::flushall();
        DB::table('contents')->delete($id);
    }
}