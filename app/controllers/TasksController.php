<?php

class TasksController extends \BaseController {

	protected $task;

	function __construct(Task $task) {
        $this->task = $task;
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$tasks = $this->task->all();
		return $this->response($tasks, self::OK);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = array(
			'title' => 'required',
			'description' => 'required',
			'status' => 'required|in:Open,In Progress,Fixed,Verified'
		);

		$validator = Validator::make(Input::all(), $rules);
		if ($validator->fails())
			return $this->error($validator->messages(), self::BAD_REQUEST);

		$task = $this->task->create(
			array(
				'title' => Input::get('title'),
				'description' => Input::get('description'),
				'status' => Input::get('status')
			)
		);
		return $this->response($task, self::CREATED);

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$task = $this->task->find($id);
		return $task ? $this->response($task, self::OK) : $this->error('resource not found', self::NOT_FOUND);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$task = $this->task->find($id);
		if (!$task)
			return $this->error('resource not found', self::NOT_FOUND);

		if (Input::has('title'))
			$task->title = Input::get('title');
		if (Input::has('description'))
			$task->description = Input::get('description');
		if (Input::has('status')){
			$rules = array(
				'status' => 'in:Open,In Progress,Fixed,Verified',
			);
			$validator = Validator::make(Input::all(), $rules);
			if ($validator->fails())
				return $this->error($validator->messages(), self::BAD_REQUEST);
			$task->status = Input::get('status');
		}
		$task->save();
		return $this->response($task, self::OK);

	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$task = $this->task->find($id);
		if (!$task)
			return $this->error('resource not found', self::NOT_FOUND);
		$task->delete();
		return $this->response($task, self::NO_CONTENT);
	}

}
