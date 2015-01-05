<?php

class ProjectTest extends TestCase {

	public function testProjectList()
	{
		$crawler = $this->client->request('GET', '/api/v1/projects');
		$content = $this->client->getResponse()->getContent();

		$this->assertTrue($this->client->getResponse()->isOk());
		$this->assertInstanceOf('stdClass', json_decode($content));
		$this->assertContains('id', $content);
		$this->assertContains('name', $content);
		$this->assertContains('description', $content);
		$this->assertContains('image', $content);
		$this->assertContains('user_id', $content);

	}

	public function testProject() {
		$crawler = $this->client->request('GET', '/api/v1/projects/1');
		$content = $this->client->getResponse()->getContent();
		$stdObject = json_decode($content);

		$this->assertTrue($this->client->getResponse()->isOk());
		//$this->assertEquals('thomas.d.bock@gmail.com', $stdObject->user[0]->email);
		$this->assertContains('id', $content);
		$this->assertContains('name', $content);
		$this->assertContains('description', $content);
		$this->assertContains('image', $content);
		$this->assertContains('user_id', $content);
	}

}
