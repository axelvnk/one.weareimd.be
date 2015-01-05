<?php

class TestAchievement extends TestCase {

public function todoHasUser()
	{
		$response = $this->call('GET', '/api/v1/todos');

		$this->assertTrue($this->client->getResponse()->isOk());

		$this->assertContains('user_id', $response->getContent());
	}
}
