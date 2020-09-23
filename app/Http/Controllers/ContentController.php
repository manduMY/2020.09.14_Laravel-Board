<?php


use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Faker\Generator;
use App\Http\Resources\ContentResource;

class ContentController extends Controller
{
    public function index()
    {
        $contents = Content::latest()->get();
        // 예외 처리: 게시글 0개일 때 id 1번부터 시작
        if($contents->count() <= 0) {
            DB::statement("ALTER TABLE contents AUTO_INCREMENT = 1;");
        }
        // data로 전달해주기 위해 Resource로 반환
        return ContentResource::collection($contents);
    }
    
    public function create(Request $request)
    {
        // 유효성 검사 제목이 있어야 한다.
        $rules = array(
            'title'       => 'required',
        );
        $validator = Validator::make($request->all(), $rules);
        
        // 유효성 검사 실패시 에러 response 보냄.
        if($validator->fails()) {
            return response()->json([
                
            ],Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $content = new Content([
            'title' => $request->input('title'),
            'context' => $request->input('context')
        ]);
        $content->save();

        // 정상적으로 데이터 넣은 후 정상 response 보냄.
        return response()->json([
        ], Response::HTTP_OK);
    }
    public function find_content($id)
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
        
        if($validator->fails()) {
            return response()->json([
                
            ],Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $content = Content::find($id);
        $content->update($request->all());
       
        return response()->json([
        ], Response::HTTP_OK);
    }
    public function delete($id)
    {
        $content = Content::find($id);
        $content->delete();
        DB::statement("ALTER TABLE contents AUTO_INCREMENT = ${id};");
    }
}