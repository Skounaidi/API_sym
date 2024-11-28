<?php


namespace App\Controller;

use App\Service\DatabaseService;
use Symfony\Component\HttpFoundation\JsonResponse;

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

        return new JsonResponse($users);
    }
}