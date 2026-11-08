<?php

declare(strict_types=1);

namespace App\Refactoring;

final class Student
{
    public function __construct(
        public readonly string $name,
        public readonly int $score,
    ) {
    }
}

final class Gradebook
{
    /** @var list<Student> */
    private array $students = [];

    public function add(Student $student): void
    {
        $this->students[] = $student;
    }

    /**
     * @return list<Student>
     */
    public function students(): array
    {
        return $this->students;
    }

    public function averageScore(): float
    {
        $sum = 0;
        foreach ($this->students as $student) {
            $sum += $student->score;
        }

        return $sum / count($this->students);
    }

    public function best(): Student
    {
        $best = $this->students[0];
        foreach ($this->students as $student) {
            if ($student->score > $best->score) {
                $best = $student;
            }
        }

        return $best;
    }
}

final class GradebookReport
{
    public function render(Gradebook $gradebook): string
    {
        $text = "Звіт\n";
        foreach ($gradebook->students() as $student) {
            $text .= $student->name . ': ' . $student->score . "\n";
        }
        $text .= 'Середній бал: ' . number_format($gradebook->averageScore(), 1) . "\n";
        $text .= 'Найкращий: ' . $gradebook->best()->name . "\n";

        return $text;
    }
}

//Демонстрація
$gradebook = new Gradebook();
$gradebook->add(new Student('Іван Петренко', 87));
$gradebook->add(new Student('Олена Коваль', 54));
$gradebook->add(new Student('Андрій Мельник', 72));
echo (new GradebookReport())->render($gradebook);