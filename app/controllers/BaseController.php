<?php

class BaseController extends Controller {

	const BAD_REQUEST = 400;
	const NOT_FOUND = 404;
	const NO_CONTENT = 204;
	const CREATED = 201;
	const OK = 200;

	protected function error($errors, $statusCode)
	{
		return Response::json(array(
        	'success' => false,
        	'errors' => $errors
    	), $statusCode);
	}

	protected function response($data, $statusCode){
		return Response::json(array(
        	'success' => true,
        	'data' => $data
    	), $statusCode);
	}

}
