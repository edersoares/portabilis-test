<?php

namespace App\Controller\Api;

use App\Services\StudentService;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class StudentController
{
    /**
     * Student service.
     *
     * @var StudentService
     */
    protected $service;

    /**
     * StudentController constructor.
     *
     * @param ContainerInterface $app
     */
    public function __construct(ContainerInterface $app)
    {
        $this->service = $app->get(StudentService::class);
    }

    /**
     * GET /api/students
     *
     * @param ServerRequestInterface $request
     * @param ResponseInterface      $response
     *
     * @return ResponseInterface
     */
    public function index(ServerRequestInterface $request, ResponseInterface $response)
    {
        $students = $this->service->all();

        return $response->withJson($students);
    }

    /**
     * POST /api/students
     *
     * @param ServerRequestInterface $request
     * @param ResponseInterface      $response
     *
     * @return ResponseInterface
     */
    public function create(ServerRequestInterface $request, ResponseInterface $response)
    {
        $student = $this->service->create($request->getParsedBody());

        return $response->withStatus(201)->withJson($student);
    }

    /**
     * GET /api/students/{id}
     *
     * @param ServerRequestInterface $request
     * @param ResponseInterface      $response
     * @param array                  $args
     *
     * @return ResponseInterface
     */
    public function browse(ServerRequestInterface $request, ResponseInterface $response, $args)
    {
        $student = $this->service->find($args['id']);

        return $response->withJson($student);
    }

    /**
     * PATCH /api/students/{id}
     *
     * @param ServerRequestInterface $request
     * @param ResponseInterface      $response
     * @param array                  $args
     *
     * @return ResponseInterface
     */
    public function update(ServerRequestInterface $request, ResponseInterface $response, $args)
    {
        $student = $this->service->update($args['id'], $request->getParsedBody());

        return $response->withJson($student);
    }

    /**
     * DELETE /api/students/{id}
     *
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param $args
     *
     * @return ResponseInterface
     */
    public function delete(ServerRequestInterface $request, ResponseInterface $response, $args)
    {
        $student = $this->service->delete($args['id']);

        return $response->withJson($student);
    }
}