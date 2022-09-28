<?php

namespace App\Controllers\Api\V1;

use DateTime;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use RuntimeException;
use App\Repositories;

class UserController
{
    private $userRepository;

    const REQUIRED_FIELDS = ['username', 'email', 'password'];

    // https://www.slimframework.com/docs/v4/objects/routing.html#container-resolution
    public function __construct(Repositories\UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    // https://www.slimframework.com/docs/v4/objects/response.html#returning-json
    public function store(Request $request, Response $response) : Response
    {
        $values = (string) $request->getBody();
        $values = json_decode($values, true);

        $fieldsNotFilled = array_diff(self::REQUIRED_FIELDS, array_keys($values));

        if ($fieldsNotFilled) {
            throw new RuntimeException('Required fields: ' . implode(', ', $fieldsNotFilled), 400);
        }

        if (!filter_var($values['email'], FILTER_VALIDATE_EMAIL)) {
            throw new RuntimeException('Email format not valid', 422);
        }

        if ($this->userRepository->existBy('email', $values['email'])) {
            throw new RuntimeException('User with this email already exists', 400);
        }

        if ($this->userRepository->existBy('username', $values['username'])) {
            throw new RuntimeException('User with this username already exists', 400);
        }

        $data = [
            'id' => uniqid(),
            'username' => $values['username'],
            'firstName' => $values['firstName'] ?? null,
            'lastName' => $values['lastName'] ?? null,
            'email' => $values['email'],
            'password' => md5($values['password']),
            'userStatus' => rand(0, 1),
        ];

        $this->userRepository->store($data);

        $payload = json_encode($data);

        $response->getBody()->write($payload);

        return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
    }

    public function find(Request $request, Response $response, array $args) : Response
    {
        $username = $args['username'] ?? NULL;

		if (!$username) {
			throw new RuntimeException('Error Processing Request', 400);
		}
		
		$payload = json_encode($this->userRepository->findBy('username', $username));

		$response->getBody()->write($payload);

		return $response->withHeader('Content-Type', 'application/json')->withStatus(201);
    }

    public function delete(Request $request, Response $response, array $args) : Response
    {
        $username = $args['username'] ?? NULL;

		if (!$username) {
			throw new RuntimeException('Error Processing Request', 400);
		}
		
		$this->userRepository->deleteBy('username', $username);

		$response->getBody()->write(json_encode(['status' => TRUE]));

		return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }

    public function update(Request $request, Response $response, array $args) : Response
	{
        $values = (string) $request->getBody();
		$values = json_decode($values, TRUE);

		$username = $args['username'] ?? NULL;

		if (!$username) {
			throw new RuntimeException('Error Processing Request', 400);
		}

        $userData = $this->userRepository->findBy('username', $username);

        if (!$userData) {
			throw new RuntimeException('User not found', 404);
		}

        $userData['firstName'] = $values['firstName'] ?? $userData['firstName'];
		$userData['lastName']  = $values['lastName'] ?? $userData['lastName'];
		$userData['password']  = isset($values['password']) ? md5($values['password']) :  $userData['password'];

		$result = $this->userRepository->update($userData);

		$payload = json_encode(['status' => $result]);

		$response->getBody()->write($payload);

		return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
    }
}