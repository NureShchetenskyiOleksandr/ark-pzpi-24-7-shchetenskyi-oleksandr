<?php

declare(strict_types=1);

namespace App\Refactoring;

use RuntimeException;

class StudentRegistrationException extends RuntimeException
{
}

final class EmptyNameException extends StudentRegistrationException
{
    public function __construct()
    {
        parent::__construct("порожнє ім'я");
    }
}

final class InvalidScoreException extends StudentRegistrationException
{
    public function __construct(public readonly int $score)
    {
        parent::__construct("некоректний бал ({$score})");
    }
}

final class DuplicateStudentException extends StudentRegistrationException
{
    public function __construct(public readonly string $name)
    {
        parent::__construct("дублікат ({$name})");
    }
}

final class StudentRegistry
{
    /** @var array<string, int> */
    private array $scores = [];

    /**
     * @throws StudentRegistrationException
     */
    public function add(string $name, int $score): void
    {
        if ($name === '') {
            throw new EmptyNameException();
        }
        if ($score < 0 || $score > 100) {
            throw new InvalidScoreException($score);
        }
        if (isset($this->scores[$name])) {
            throw new DuplicateStudentException($name);
        }
        $this->scores[$name] = $score;
    }
}

//Демонстрація
$registry = new StudentRegistry();
$data = [['Іван Петренко', 87], ['', 50], ['Олена Коваль', 120], ['Іван Петренко', 90]];

foreach ($data as [$name, $score]) {
    try {
        $registry->add($name, $score);
        echo "Додано: {$name}\n";
    } catch (StudentRegistrationException $e) {
        echo 'Помилка: ' . $e->getMessage() . "\n";
    }
}