<?php

namespace App\Controller;


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

    /**
     * GET /
     *
     * @param ServerRequestInterface $request
     * @param ResponseInterface      $response
     *
     * @return mixed
     */
    public function index(ServerRequestInterface $request, ResponseInterface $response)
    {
        $students = StudentModel::all();

        return $this->app->get('renderer')->render($response, 'index.phtml', [
            'students' => $students
        ]);
    }

    /**
     * GET /students/create
     *
     * @param ServerRequestInterface $request
     * @param ResponseInterface      $response
     *
     * @return mixed
     */
    public function create(ServerRequestInterface $request, ResponseInterface $response)
    {
        return $this->app->get('renderer')->render($response, 'create.phtml');
    }

    /**
     * POST /students/create
     *
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     *
     * @return mixed
     */
    public function store(ServerRequestInterface $request, ResponseInterface $response)
    {
        StudentModel::create($request->getParsedBody());

        return $this->index($request, $response);
    }

    /**
     * GET /students/edit/{id}
     *
     * @param ServerRequestInterface $request
     * @param ResponseInterface      $response
     * @param mixed                  $args
     *
     * @return mixed
     */
    public function edit(ServerRequestInterface $request, ResponseInterface $response, $args)
    {
        $student = StudentModel::find($args['id']);

        return $this->app->get('renderer')->render($response, 'edit.phtml', [
            'student' => $student
        ]);
    }

    /**
     * POST /students/edit/{id}
     *
     * @param ServerRequestInterface $request
     * @param ResponseInterface      $response
     * @param mixed                  $args
     *
     * @return mixed
     */
    public function update(ServerRequestInterface $request, ResponseInterface $response, $args)
    {
        StudentModel::find($args['id'])->update($request->getParsedBody());

        return $this->index($request, $response);
    }

    /**
     * GET /students/delete/{id}
     *
     * @param ServerRequestInterface $request
     * @param ResponseInterface      $response
     * @param mixed                  $args
     *
     * @return mixed
     */
    public function delete(ServerRequestInterface $request, ResponseInterface $response, $args)
    {
        StudentModel::find($args['id'])->delete();

        return $this->index($request, $response);
    }
}