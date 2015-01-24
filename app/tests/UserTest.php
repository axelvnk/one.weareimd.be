<?php

class UserTest extends TestCase
{

    public function testUserList()
    {
        $crawler = $this->client->request('GET', '/api/v1/users');
        $content = $this->client->getResponse()->getContent();

        $this->assertTrue($this->client->getResponse()->isOk());
        //$this->assertInstanceOf('stdClass', json_decode($content));
        $this->assertContains('id', $content);
        $this->assertContains('email', $content);
        $this->assertContains('admin', $content);
        $this->assertContains('avatar', $content);
        $this->assertContains('firstname', $content);
        $this->assertContains('name', $content);
        $this->assertContains('dateofbirth', $content);

    }

    public function testUser()
    {
        $crawler = $this->client->request('GET', '/api/v1/users/thomas.d.bock@gmail.com');
        $content = $this->client->getResponse()->getContent();
        $stdObject = json_decode($content);

        $this->assertTrue($this->client->getResponse()->isOk());
        //$this->assertEquals('thomas.d.bock@gmail.com', $stdObject->user[0]->email);
        $this->assertContains('id', $content);
        $this->assertContains('email', $content);
        $this->assertContains('admin', $content);
        $this->assertContains('avatar', $content);
        $this->assertContains('firstname', $content);
        $this->assertContains('name', $content);
        $this->assertContains('dateofbirth', $content);
    }

}
