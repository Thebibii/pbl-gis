<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;

class ErrorController extends BaseController
{
    public function index(): ResponseInterface
    {
        session();

        return $this->response->setBody(view('errors/not_found', [], [
            'cache'      => 0,
            'debug_info' => [],
        ]));
    }
}
