<?php

declare(strict_types=1);

namespace App\Refactoring;

/**
 * Процедурний дизайн: дані (масив рядків) окремо, функції окремо.
 * Кожна функція «знає» внутрішню будову масиву.
 */
function addStudent(array &$gradebook, string $name, int $score): void
{
    $gradebook[] = ['name' => $name, 'score' => $score];
}

function averageScore(array $gradebook): float
{
    $sum = 0;
    foreach ($gradebook as $row) {
        $sum += $row['score'];
    }

    return $sum / count($gradebook);
}

function bestStudent(array $gradebook): array
{
    $best = $gradebook[0];
    foreach ($gradebook as $row) {
        if ($row['score'] > $best['score']) {
            $best = $row;
        }
    }

    return $best;
}

function printReport(array $gradebook): void
{
    echo "Звіт\n";
    foreach ($gradebook as $row) {
        echo $row['name'] . ': ' . $row['score'] . "\n";
    }
    echo 'Середній бал: ' . number_format(averageScore($gradebook), 1) . "\n";
    echo 'Найкращий: ' . bestStudent($gradebook)['name'] . "\n";
}

//Демонстрація
$gradebook = [];
addStudent($gradebook, 'Іван Петренко', 87);
addStudent($gradebook, 'Олена Коваль', 54);
addStudent($gradebook, 'Андрій Мельник', 72);
printReport($gradebook);