<?php

namespace Tests\Unit\FbReporting\FbPagePost;

use App\Models\FbReporting\FbPagePost;
use App\Models\FbReporting\FbPagePostScheduler;
use stdClass;
use Tests\TestCase; 

class LoadScheduledDraftsTest extends TestCase
{
    /**
     * @test
     * @group fbPagePost
    */
    public function should_fail_if_request_method_not_get()
    {  
        $response = $this->actingAs($this->getDefaultUser())
            ->withHeaders(['Accept' => 'application/json'])
            ->json('PUT', '/nova-vendor/fb-page-posts-card/load-scheduled-drafts');
            
        $response->assertStatus(405);
    }

    
    /**
     * @test 
     * @group fbPagePost
    */
    public function should_pass_if_all_correct()
    {     
        $fbPagePost = FbPagePost::factory()->make();
        FbPagePostScheduler::factory()->count(3)->make([
            'page_groups' => json_encode(['Group 1']),
            'start_date' => $this->faker->dateTime('tomorrow', 'UTC'),
            'fb_page_post_id' => $fbPagePost->id,
        ]);
        $response = $this->actingAs($this->getDefaultUser())
            ->withHeaders(['Accept' => 'application/json'])
            ->json('GET', '/nova-vendor/fb-page-posts-card/load-scheduled-drafts');
        $response->assertStatus(200); 
    }
}
