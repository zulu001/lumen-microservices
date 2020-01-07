<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class UserManagementTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * User Registration Functional test
     * 
     * @return void
     */
    public function testUserCanBeCreated()
    {
        $response = $this->call('POST', 'api/v1/register', $this->data());
        
        $this->assertCount(1, User::all());
        $this->assertEquals(200, $response->status());
        $this->assertArrayHasKey('status', $response->getData(true));
    }

    /**
     * Test User Name Validation
     * 
     * @return void
     *  */
    public function testUserHasInvalidName()
    {
        $response = $this->call('POST', 'api/v1/register', array_merge($this->data(), ['name' => '']));

        $this->assertCount(0, User::all());
        $this->assertEquals(422, $response->status());
        $this->assertArrayHasKey('name', $response->getData(true));
    }


    private function data()
    {
        return [
            'name' => $this->faker->name,
            'display_name' => "test001",
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make("904310813")
        ];
    }
}