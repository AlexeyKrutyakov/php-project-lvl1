<?php

/**
 * Brain game 'Calc'
 *
 * PHP version 8
 *
 * @category PHP
 * @package  Brain\Games\Calc
 * @author   Alexey <arctik.coder@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://coder-arctik.com
 */

namespace Brain\Games\Games\Calc;

use function cli\line;
use function cli\prompt;

/**
 * Playing brain-calc game
 *
 * @param integer $attempts number of game attempts
 *
 * @return nothing
 */
function playCalc($attempts)
{
    $failGame = false;

    // gteeting
    line('What is the result of the expression?');

    for ($i = 0; $i < $attempts; $i++) {
        [$guessNumber, $correctAnswer] = guess();
        line("Question: {$guessNumber}");
        $answer = prompt("Your answer");
        if ($answer === $correctAnswer) {
            line('Correct!');
        } else {
            $failGame = true;
            break;
        }
    }

    return [$correctAnswer, $answer, $failGame];
}

/**
 * One step of the game
 *
 * @return Array [integer $guessNumber, string $correctAnswer]
 */
function guess()
{
    $first = rand(1, 100);
    $second = rand(1, 100);
    $operatorIndex = rand(0, 2);
    switch ($operatorIndex) {
        case 0:
            $number = $first + $second;
            $operator = "+";
            break;
        case 1:
            $number = $first - $second;
            $operator = "-";
            break;
        case 2:
            $number = $first * $second;
            $operator = "*";
            break;
        default:
            // error
            break;
    }
    $question = "{$first} {$operator} {$second}";
    $correctAnswer = "{$number}";

    return [$question, $correctAnswer];
}
