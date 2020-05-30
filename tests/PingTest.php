<?php

class PingTest extends TestCase
{
    /**
     * @return void
     */
    public function testPingRootRoute()
    {
        $this->get('/');

        $this->assertEquals($this->app->version(), $this->response->getContent());
    }
}
