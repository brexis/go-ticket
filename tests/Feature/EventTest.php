<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\Event as EventModel;

class EventTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testEventCreate()
    {
        $response = $this->get('events/create');

        $response->assertStatus(200);
    }

    public function testEventStore()
    {
        $data = [
            'title' => 'Mon event'
        ];

        $response = $this->post('events', $data);
        $event = EventModel::first();

        $response->assertRedirect('events/show/' . $event->id);
    }

    /**
     * [testEventStoreShouldFaildIfTitleIsNotSent description]
     * @return [type] [description]
     */
    public function testEventStoreShouldFaildIfTitleIsNotSent()
    {
        $data = [];

        $response = $this->post('events', $data);

        $response->assertRedirect('events/create');

        $event = EventModel::first();

        $this->assertNull($event);
    }
}
