<?php

class TasksTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->fake_task = array(
            'id' => 1,
            'title' => 'task 1',
            'description' => 'Task description',
            'status' => 'Open'
        );
        $this->mock = Mockery::mock('Eloquent', 'Task');
    }

    public function tearDown()
    {
        Mockery::close();
    }

    public function testGet()
    {
        $fake = array($this->fake_task);
        $this->mock->shouldReceive('all')->once()->andReturn($fake);
        $this->app->instance('Task', $this->mock);
        $this->client->request('GET', self::API_VI . 'tasks');
        $this->assertResponse($this->client->getResponse(), '{"success":true,"data":[{"id":1,"title":"task 1","description":"Task description","status":"Open"}]}');
    }

    public function testGetById()
    {
        $this->mock->shouldReceive('find')->with('1')->once()->andReturn($this->fake_task);
        $this->app->instance('Task', $this->mock);
        $this->client->request('GET', self::API_VI . 'tasks/1');
        $this->assertResponse($this->client->getResponse(), '{"success":true,"data":{"id":1,"title":"task 1","description":"Task description","status":"Open"}}');
    }

    public function testGetByInvalidId()
    {
        $this->mock->shouldReceive('find')->with('1')->once()->andReturn(null);
        $this->app->instance('Task', $this->mock);
        $this->client->request('GET', self::API_VI . 'tasks/1');
        $this->assertResponse($this->client->getResponse(), '{"success":false,"errors":"resource not found"}', 404);
    }

    public function testPost()
    {
        $this->mock->shouldReceive('create')->once()->andReturn($this->fake_task);
        $this->app->instance('Task', $this->mock);
        unset($this->fake_task["id"]);
        $this->client->request('POST', self::API_VI . 'tasks', $this->fake_task);
        $this->assertResponse($this->client->getResponse(), '{"success":true,"data":{"id":1,"title":"task 1","description":"Task description","status":"Open"}}', 201);
    }

    public function testPostWithMissingParameters()
    {
        $parameters = array();
        $this->client->request('POST', self::API_VI . 'tasks', $parameters);
        $this->assertResponse($this->client->getResponse(), '{"success":false,"errors":{"title":["The title field is required."],"description":["The description field is required."],"status":["The status field is required."]}}', 400);
    }

    public function testPostWithInvalidStatus()
    {
        unset($this->fake_task["id"]);
        $this->fake_task['status'] = ':)';
        $parameters = $this->fake_task;
        $this->client->request('POST', self::API_VI . 'tasks', $parameters);
        $this->assertResponse($this->client->getResponse(), '{"success":false,"errors":{"status":["The selected status is invalid."]}}', 400);
    }

    public function testDelete()
    {
        $this->delete_mock = Mockery::mock('Eloquent', 'Task');
        $this->delete_mock->shouldReceive('jsonSerialize')->once();
        $this->delete_mock->shouldReceive('delete')->once()->andReturn($this->fake_task);
        $this->mock->shouldReceive('find')->with('1')->once()->andReturn($this->delete_mock);
        $this->app->instance('Task', $this->mock);
        $this->client->request('DELETE', self::API_VI . 'tasks/1');
        $this->assertResponse($this->client->getResponse(), '', 204);
    }

    public function testPut()
    {
        $this->update_mock = Mockery::mock('Eloquent', 'Task');
        $this->update_mock->shouldReceive('jsonSerialize')->once();
        $this->update_mock->shouldReceive('setAttribute')->times(3);
        $this->update_mock->shouldReceive('save')->once();
        $this->mock->shouldReceive('find')->with('1')->once()->andReturn($this->update_mock);
        $this->app->instance('Task', $this->mock);
        $parameters = array(
            'title' => 'task 1',
            'description' => 'Task description',
            'status' => 'Open'
        );
        $this->client->request('PUT', self::API_VI . 'tasks/1', $parameters);
        $this->assertResponse($this->client->getResponse(), '{"success":true,"data":null}', 200);
    }

    public function testPatch()
    {
        $this->update_mock = Mockery::mock('Eloquent', 'Task');
        $this->update_mock->shouldReceive('jsonSerialize')->once();
        $this->update_mock->shouldReceive('setAttribute')->times(3);
        $this->update_mock->shouldReceive('save')->once();
        $this->mock->shouldReceive('find')->with('1')->once()->andReturn($this->update_mock);
        $this->app->instance('Task', $this->mock);
        $parameters = array(
            'title' => 'task 1',
            'description' => 'Task description',
            'status' => 'Open'
        );
        $this->client->request('PATCH', self::API_VI . 'tasks/1', $parameters);
        $this->assertResponse($this->client->getResponse(), '{"success":true,"data":null}', 200);
    }

    public function testPutWithInvalidParameters()
    {
        $this->update_mock = Mockery::mock('Eloquent', 'Task');
        $this->mock->shouldReceive('find')->with('1')->once()->andReturn($this->update_mock);
        $this->app->instance('Task', $this->mock);
        $parameters = array('status' => 'invalid_status');
        $this->client->request('PUT', self::API_VI . 'tasks/1', $parameters);
        $this->assertResponse($this->client->getResponse(), '{"success":false,"errors":{"status":["The selected status is invalid."]}}', 400);
    }

    public function testPutWithInvalidId()
    {
        $this->update_mock = Mockery::mock('Eloquent', 'Task');
        $this->mock->shouldReceive('find')->with('1')->once()->andReturn(null);
        $this->app->instance('Task', $this->mock);
        $this->client->request('PUT', self::API_VI . 'tasks/1', array());
        $this->assertResponse($this->client->getResponse(), '{"success":false,"errors":"resource not found"}', 404);
    }

}