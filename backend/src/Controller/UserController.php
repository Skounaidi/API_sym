<?php

namespace App\Controller;

use App\Service\DatabaseService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class UserController
{
    private DatabaseService $databaseService;

    public function __construct(DatabaseService $databaseService)
    {
        $this->databaseService = $databaseService;
    }

    public function listUsers(): JsonResponse
    {
        $pdo = $this->databaseService->getConnection();
        $stmt = $pdo->query('SELECT * FROM users'); 
        $users = $stmt->fetchAll();

        $response = new JsonResponse($users);
        $response->headers->set('Access-Control-Allow-Origin', 'http://localhost:3000'); // Allow React app
        $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, OPTIONS');
        $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Authorization');

        return $response;
    }

    public function preflight(): Response
    {
        // Handle preflight OPTIONS requests
        $response = new Response();
        $response->headers->set('Access-Control-Allow-Origin', 'http://localhost:3000');
        $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, OPTIONS');
        $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Authorization');
        $response->setStatusCode(Response::HTTP_NO_CONTENT);

        return $response;
    }
}