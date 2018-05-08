<?php

namespace App\Controller;

use App\Model\StudentModel;
use App\Services\StudentService;
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
        $this->app = $app;
        $this->service = $app->get(StudentService::class);
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
        return $this->app->get('renderer')->render($response, 'index.phtml', [
            'students' => $this->service->all()
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
        return $this->app->get('renderer')->render($response, 'create.phtml', [
            'student' => (new StudentModel())->toArray()
        ]);
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
        $data = $request->getParsedBody();

        if ($error = $this->service->validate($data)) {
            $_SESSION['error'] = $error;

            return $this->app->get('renderer')->render($response, 'create.phtml', [
                'student' => (new StudentModel($data))->toArray()
            ]);
        }

        $this->service->create($data);

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
        return $this->app->get('renderer')->render($response, 'edit.phtml', [
            'student' => $this->service->find($args['id'])
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
        $data = $request->getParsedBody();

        if ($error = $this->service->validate($data, $args['id'])) {
            $_SESSION['error'] = $error;

            return $this->app->get('renderer')->render($response, 'edit.phtml', [
                'student' => (new StudentModel($data))->toArray()
            ]);
        }

        $this->service->update($args['id'], $request->getParsedBody());

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
        $this->service->delete($args['id']);

        return $this->index($request, $response);
    }
}