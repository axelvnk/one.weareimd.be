<?php

class TestAchievement extends TestCase
{

    public function achievementHasDescription()
    {
        $response = $this->call('GET', '/api/v1/achievements');

        $this->assertTrue($this->client->getResponse()->isOk());

        $this->assertContains('description', $response->getContent());
    }

}
