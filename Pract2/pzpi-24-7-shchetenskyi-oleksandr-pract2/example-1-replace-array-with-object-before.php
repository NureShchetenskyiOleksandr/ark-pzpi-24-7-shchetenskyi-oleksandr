<?php

declare(strict_types=1);

namespace App\Refactoring;

/**
 * Студент подається масивом із позиційними індексами:
 * [0] — ПІБ, [1] — група, [2] — бал.
 */
function studentLabel(array $student): string
{
    return $student[0] . ' (' . $student[1] . ')';
}

function studentGrade(array $student): string
{
    if ($student[2] >= 90) {
        return 'A';
    }
    if ($student[2] >= 75) {
        return 'B';
    }
    if ($student[2] >= 60) {
        return 'C';
    }

    return 'F';
}

function isPassed(array $student): bool
{
    return $student[2] >= 60;
}

//Демонстрація
$students = [
    ['Іван Петренко', 'ПЗПІ-24-3', 87],
    ['Олена Коваль', 'ПЗПІ-24-7', 54],
    ['Андрій Мельник', 'ПЗПІ-24-4', 72],
];

foreach ($students as $student) {
    echo studentLabel($student) . ': ' . $student[2] . ' — ' . studentGrade($student)
        . (isPassed($student) ? '' : ' (не склав)') . "\n";
}