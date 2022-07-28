<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\BlogPost;

class PostTest extends TestCase
{
    //use RefreshDatabase;

    public function testPostsPage()
    {
        //Arrange
        // $post = new BlogPost();
        // $post->title = 'test title';
        // $post->content = 'test content';
        // $post->save();

        //Act
        $response = $this->get('/posts');

        //Assert
        $response->assertSeeText('Test Title');
        $this->assertDatabaseHas('blog_posts',[
            'title' => 'Test Title',
            'content' => 'This is the test content.'
        ]);
    }

    public function testStoreValid(){
        $params = [
            'title' => 'Valid title',
            'content' => 'At least 10 characters'
        ];

        $this->post('/posts', $params)
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this->assertEquals(session('status'),'Blog post was created!');
    }

    // public function testStoreFail()
    // {
    //     $params = [
    //         'title' => 'x',
    //         'content' => 'x'
    //     ];

    //     $this->post('/posts', $params)
    //         ->assertStatus(302)
    //         ->assertSessionHas('errors');
        
    //     $messages = session('errors');
    //     dd($messages);
    // }

    public function testUpdateValid()
    {
        $post = new BlogPost();
        $post->title = 'New title';
        $post->content = 'Content of the blog post';
        $post->save();

        $this->assertDatabaseHas('blog_posts', $post->toArray());

        $params = [
            'title' => 'A new named title',
            'content' => 'Content was changed'
        ];

        $this->put("/posts/{$post->id}", $params)
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this->assertEquals(session('status'), 'Blog post was updated!');
        $this->assertDatabaseMissing('blog_posts', $post->toArray());
        $this->assertDatabaseHas('blog_posts', [
            'title' => 'A new named title'
        ]);
    }

    public function testDelete() 
    {
        $post = $this->createDummyBlogPost();
        $this->assertDatabaseHas('blog_posts', $post->toArray());

        $this->delete("/posts/{$post->id}")
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this->assertEquals(session('status'), 'Blog post was deleted!');
        $this->assertDatabaseMissing('blog_posts', $post->toArray());
    }

    private function createDummyBlogPost(): BlogPost
    {
        $post = new BlogPost();
        $post->title = 'New title';
        $post->content = 'Content of the blog post';
        $post->save();

        return $post;
    }
}
