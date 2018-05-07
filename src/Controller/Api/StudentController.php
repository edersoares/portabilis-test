<?php

namespace App\Controller\Api;

use App\Model\StudentModel;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class StudentController
{
    /**
     * Application container.
     *
     * @var ContainerInterface
     */
    protected $app;

    /**
     * StudentController constructor.
     *
     * @param ContainerInterface $app
     */
    public function __construct(ContainerInterface $app)
    {
        $this->app = $app;
    }

    public function index(ServerRequestInterface $request, ResponseInterface $response)
    {
        $students = StudentModel::all();

        return $response->withJson($students);
    }

    public function create(ServerRequestInterface $request, ResponseInterface $response)
    {
        $student = StudentModel::create($request->getParsedBody());

        return $response->withStatus(201)->withJson($student);
    }

    public function browse(ServerRequestInterface $request, ResponseInterface $response, $args)
    {
        $student = StudentModel::find($args['id']);

        return $response->withJson($student);
    }

    public function update(ServerRequestInterface $request, ResponseInterface $response, $args)
    {
        $student = StudentModel::find($args['id']);

        $student->update($request->getParsedBody());

        return $response->withJson($student);
    }

    public function delete(ServerRequestInterface $request, ResponseInterface $response, $args)
    {
        $student = StudentModel::find($args['id']);

        $student->delete();

        return $response->withJson($student);
    }
}