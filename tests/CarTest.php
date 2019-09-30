<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class CarTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testList()
    {
        $this->get('/api/v1/cars');

        $this->assertResponseOk();

    }

    public function testSearch()
    {
        $this->get('/api/v1/search/cars?marca=fiat');

        $this->assertResponseOk();
        $this->assertNotEmpty($this->response->content());
        
    }

    public function testSearchById()
    {
        $this->get('/api/v1/search/cars/2587515?marca=fiat');

        $this->assertResponseOk();

        $this->assertNotEmpty($this->response->content());
    }
}
