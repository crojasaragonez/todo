<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase {

	const API_VI = 'api/v1/';
	/**
	 * Creates the application.
	 *
	 * @return \Symfony\Component\HttpKernel\HttpKernelInterface
	 */
	public function createApplication()
	{
		$unitTesting = true;

		$testEnvironment = 'testing';

		return require __DIR__.'/../../bootstrap/start.php';
	}

	public function assertResponse($response, $expected_body, $expected_status = 200)
    {
        $body = $response->getContent();
        $this->assertEquals($expected_body, $body);
        $this->assertResponseStatus($expected_status);
    }

}
