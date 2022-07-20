<?php

namespace Tests\Feature;

use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Mail\Mailer;
use Illuminate\Support\Facades\Mail;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_the_application_returns_a_successful_response()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testEmailSender()
    {
        Mail::fake();

        $mailer = new Mailer();
        $logger =new NullLogger();
        $mailer->sendEmail('qwerty', $logger);
        Mail::assertSent('templates.email');

    }
}
