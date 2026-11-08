<?php

declare(strict_types=1);

namespace App\Refactoring;

const ERR_OK = 0;
const ERR_EMPTY_NAME = 1;
const ERR_BAD_SCORE = 2;
const ERR_DUPLICATE = 3;

/**
 * Повертає код помилки; ERR_OK означає успіх.
 */
function addStudent(array &$students, string $name, int $score): int
{
    if ($name === '') {
        return ERR_EMPTY_NAME;
    }
    if ($score < 0 || $score > 100) {
        return ERR_BAD_SCORE;
    }
    if (isset($students[$name])) {
        return ERR_DUPLICATE;
    }
    $students[$name] = $score;

    return ERR_OK;
}

//Демонстрація
$students = [];
$data = [['Іван Петренко', 87], ['', 50], ['Олена Коваль', 120], ['Іван Петренко', 90]];

foreach ($data as [$name, $score]) {
    $code = addStudent($students, $name, $score);
    if ($code === ERR_EMPTY_NAME) {
        echo "Помилка: порожнє ім'я\n";
    } elseif ($code === ERR_BAD_SCORE) {
        echo "Помилка: некоректний бал ({$score})\n";
    } elseif ($code === ERR_DUPLICATE) {
        echo "Помилка: дублікат ({$name})\n";
    } else {
        echo "Додано: {$name}\n";
    }
}