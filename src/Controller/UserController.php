<?php

namespace User\Controller;


use User\Repository\UserRepository;
use User\Factory\UserFactory;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\RequestInterface as Request;
use Slim\Container;
use Respect\Validation\Validator as v;

class UserController
{
    /** @var \Slim\Container */
    protected $container;

    /**
     * @var \User\Repository\UserRepository
     */
    protected $repository;


    /**
     * @var \User\Factory\UserFactory
     */
    protected $factory;


    public function __construct(Container $container, UserRepository $repository, UserFactory $factory)
    {
        $this->container = $container;
        $this->repository = $repository;
        $this->factory = $factory;
    }

    /**
     * display all users
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function listUsers(Request $request, Response $response)
    {
        $users = $this->repository->getAllUsers();
        if(!empty($users)){
            $response = $response->withJson(['data' => $users], 200);
        }else{
            $response= $response->withJson(['errors' => 'Not Found'], 404);
        }
        return $response;


    }

    /**
     * display user data
     * @param Request $request
     * @param Response $response
     * @param $args
     * @return Response
     */
    public function showUser(Request $request, Response $response, $args)
    {
        $id = $args['id'];
        $validation = $this->validateUserRequest($id);

        if ($validation->failed()) {
            return $response->withJson(['errors' => $validation->getErrors()], 404);
        }
        $user = $this->repository->getUser($id);
        return $response->withJson(['data'=>$user], 200);


    }

    /**
     * Create new user
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function addUser(Request $request, Response $response)
    {
        $data = $request->getParams();

        $validation = $this->validateCreateRequest($data);

        if ($validation->failed()) {
            return $response->withJson(['errors' => $validation->getErrors()], 422);
        }

        $user = $this->factory->createNewUser($data);
        if(!empty($user)){
            return  $response->withHeader('Location', '/users/'.$user->id)->withJson(['data' => $user], 201);
        }else{
            return  $response->withJson(['error' => 'Bad Request'], 400);
        }


    }


    /**
     * @param Request $request
     * @param Response $response
     * @param $args
     * @return Response
     */
    public function editUser(Request $request, Response $response,$args)
    {
        $id = $args['id'];
        $validation = $this->validateUserRequest($id);

        if ($validation->failed()) {
            return $response->withJson(['errors' => $validation->getErrors()], 404);
        }
        $data = $request->getParams();
        if(empty($data)) {
            return $response->withJson(['errors' => 'Missing update data'], 400);
        }
        $validation = $this->validateEditRequest($data);
        if ($validation->failed()) {
            return $response->withJson(['errors' => $validation->getErrors()], 422);
        }
        try{
            $user = $this->repository->updateUser($id, $data);
        }catch (\Illuminate\Database\QueryException $e) {
            $error_code = $e->errorInfo[1];
            if($error_code == 1062){
                return $response->withJson(['errors' => 'Email already in use'], 422);
            }
        }

        if($user) {
            return  $response->withHeader('Location', '/users/'.$user->id)->withJson(['data' => $user], 200);
        }

        return  $response->withJson(['errors' => 'Bad Request'], 400);

    }


    /**
     * @param Request $request
     * @param Response $response
     * @param $args
     * @return Response $response
     */
    public function deleteUser(Request $request, Response $response,$args)
    {
        $id = $args['id'];
        $validation = $this->validateUserRequest($id);

        if ($validation->failed()) {
            return $response->withJson(['errors' => $validation->getErrors()], 404);
        }

         $count = $this->repository->deleteUser($id);
        if($count > 0){
            return $response->withJson([], 204 );
        }

        return $response->withJson(['errors' => 'Bad Request'], 400);

    }

    /**
     * @param array
     *
     * @return \User\Validation\Validator
     */
    protected function validateUserRequest($id) {
        return $this->container->validator->validateArray(
          ['id'=> $id],
          ['id' => v::notOptional()->numeric()->existsInTable($this->container->db->table('user'), 'id')]
        );
          }

    /**
     * @param array
     *
     * @return \User\Validation\Validator
     */
    protected function validateCreateRequest($values)
    {

        return $this->container->validator->validateArray(
          $values,
          [
            'forename' => v::notOptional()->notEmpty()->stringType()->length(1,50),
            'surname' => v::notOptional()->notEmpty()->stringType()->length(1,50),
            'email'    => v::noWhitespace()->notEmpty()->email()->length(6,255)->emailAvailable()
          ]
        );
    }

    /**
     * @param array
     *
     * @return \User\Validation\Validator
     */
    protected function validateEditRequest($values)
    {

        return $this->container->validator->validateArray(
          $values,
          [
            'forename' => v::optional(v::notEmpty()->stringType()),
            'surname' => v::optional(v::notEmpty()->stringType()),
            'email'    => v::optional(v::noWhitespace()->notEmpty()->email())
          ]
        );
    }
}
