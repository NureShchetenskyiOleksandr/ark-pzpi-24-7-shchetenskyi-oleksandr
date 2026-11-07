<?php

declare(strict_types=1);

namespace App\Service;

use PDO;

final class UserService
{
    public function __construct(private readonly PDO $db)
    {
    }

    /**
     * @return array<string, mixed>|null
     */
    public function findById(int $id): ?array
    {
        $stmt = $this->db->prepare('SELECT id, name FROM users WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user === false ? null : $user;
    }

    /**
     * @param array<string, mixed> $user
     */
    public function renderTitle(array $user): string
    {
        $name = htmlspecialchars($user['name'], ENT_QUOTES, 'UTF-8');

        return '<h1>' . $name . '</h1>';
    }
}