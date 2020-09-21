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
    public function a_content_can_be_created()
    {
        $this->withoutExceptionHandling();

        $data = [
            'title' => $this->faker->firstName,
            'context' => $this->faker->lastName,
        ];

        $response = $this->post('/api/create', $data);

        $response->assertStatus(201);

        $this->assertDatabaseHas('contents', [
            'title' => $data['title'],
            'context' => $data['context']
        ]);
    }

    /** @test */
    public function bring_all_the_contents()
    {
        $this->withoutExceptionHandling();

        $content = factory(Content::class)->create([
            'title' => $this->faker->name,
            'context' => $this->faker->lastName,
        ]);
        
        $response = $this->get('/api/contents', [
            'title' => $content->title,
            'context' => $content->context
        ]);

        $response->assertStatus(Response::HTTP_OK);
    }
}
