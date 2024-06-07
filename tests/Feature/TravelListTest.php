<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Travel;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TravelListTest extends TestCase
{
    use RefreshDatabase;

    public function testTravelsListRetrurnsPaginatedDataCorrectly(): void
    {
        Travel::factory(16)->create(['is_public'=>true]);
        
        $response = $this->get('/api/V1/travels');

        $response->assertStatus(200);

        $response->assertJsonCount(15, 'data');

        $response->assertJsonPath('meta.last_page', 2);
        
    }

    public function testTavelsListShowOnlyPublicRecords(): void
    {
        $publicTravel = Travel::factory()->create(['is_public'=>true]);

        Travel::factory()->create(['is_public'=>false]);
        
        $response = $this->get('/api/V1/travels');

        $response->assertStatus(200);

        $response->assertJsonCount(1, 'data');

        $response->assertJsonPath('data.0.name', $publicTravel->name);


        
        
    }
}
