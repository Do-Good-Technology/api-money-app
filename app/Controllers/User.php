<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;

class User extends ResourceController
{
	protected $modelName = 'App\Models\UserModels';
	protected $format = 'json';

	public function index()
	{
		$data = $this->model->findAll();
		return $this->respond($data);
	}
}
