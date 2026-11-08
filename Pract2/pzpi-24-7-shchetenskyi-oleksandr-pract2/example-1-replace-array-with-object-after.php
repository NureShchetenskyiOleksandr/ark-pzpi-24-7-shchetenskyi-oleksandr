<?php

declare(strict_types=1);

namespace App\Refactoring;

final class Student
{
    private const PASS_SCORE = 60;

    public function __construct(
        public readonly string $name,
        public readonly string $group,
        public readonly int $score,
    ) {
    }

    public function label(): string
    {
        return $this->name . ' (' . $this->group . ')';
    }

    public function grade(): string
    {
        return match (true) {
            $this->score >= 90 => 'A',
            $this->score >= 75 => 'B',
            $this->score >= self::PASS_SCORE => 'C',
            default => 'F',
        };
    }

    public function isPassed(): bool
    {
        return $this->score >= self::PASS_SCORE;
    }
}

//Демонстрація
$students = [
    new Student('Іван Петренко', 'ПЗПІ-24-3', 87),
    new Student('Олена Коваль', 'ПЗПІ-24-7', 54),
    new Student('Андрій Мельник', 'ПЗПІ-24-4', 72),
];

foreach ($students as $student) {
    echo $student->label() . ': ' . $student->score . ' — ' . $student->grade()
        . ($student->isPassed() ? '' : ' (не склав)') . "\n";
}