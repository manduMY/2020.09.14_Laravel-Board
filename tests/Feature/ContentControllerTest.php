<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Content;

class ContentControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;
    
    /** @test */
    public function users_can_read_all_contents()
    {
        // 에러 log 메세지 상세 출력
        $this->withoutExceptionHandling();

        // factory를 만든다.
        $content = Content::factory()->create();

        // content api를 방문한다.
        $response = $this->get('/api/contentList');

        $response->assertSee($content->title);
    }

    /** @test */
    public function users_can_read_a_content()
    {
        $this->withoutExceptionHandling();

        $content = Content::factory()->create();
        
        $response = $this->get('/api/findContent/'.$content->id);

        $response->assertSee($content->title)
                 ->assertSee($content->context);
    }

    /** @test */
    public function users_can_create_a_new_content()
    {
        $this->withoutExceptionHandling();

        $content = Content::factory()->create();
        
        $this->post('/api/create');

        $this->assertEquals(1,Content::all()->count());
    }

    /** @test */
    public function users_cannot_create_a_new_content()
    {
        $this->withoutExceptionHandling();

        $content = Content::factory()->create();
        $content->title = "";

        $response = $this->post('/api/create');

        // 422 에러 메세지
        $response->assertStatus(422);
    }

    /** @test */
    public function users_can_update_a_content()
    {
        $this->withoutExceptionHandling();

        $content = Content::factory()->create();
        $content->title = "Updated Title";
        $content->context = "Updated Context";

        $this->put('/api/update/'.$content->id, $content->toArray());

        $this->assertDatabaseHas('contents', ['id'=>$content->id, 'title'=>'Updated Title', 'context'=>'Updated Context']);
    }

    /** @test */
    public function users_cannot_update_a_content()
    {
        $this->withoutExceptionHandling();

        $content = Content::factory()->create();
        $content->title = "";

        $response = $this->put('/api/update/'.$content->id, $content->toArray());

        // 422 에러 메세지
        $response->assertStatus(422);
    }

    /** @test */
    public function users_can_delete_a_content()
    {
        $this->withoutExceptionHandling();

        $content = Content::factory()->create();

        $this->delete('/api/delete/'.$content->id);

        $this->assertDatabaseMissing('contents', ['id'=>$content->id]);
    }
}