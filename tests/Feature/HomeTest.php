<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testHomePageIsWorkingCorrectly()
    {
        $response = $this->get('/');

        $response->assertSeeText('Welcome to Laravel 8!');
        $response->assertSeeText('I am a computer engineer.');
    }

    public function testContactPageIsWorkingCorrectly()
    {
        $response = $this->get('/contact');

        $response->assertSeeText('Contact Page');
    }
}
