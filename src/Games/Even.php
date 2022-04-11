<?php

/**
 * Brain game 'Even'
 *
 * PHP version 8
 *
 * @category PHP
 * @package  Brain\Games\Even
 * @author   Alexey <arctik.coder@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://coder-arctik.com
 */

namespace Brain\Games\Games\Even;

use function cli\line;
use function cli\prompt;

/**
 * Playing brain-even game
 *
 * @param integer $attempts number of game attempts
 *
 * @return nothing
 */
function playEven($attempts)
{
    $failGame = false;

    // show task
    line('Answer "yes" if the number is even, otherwise answer "no".');

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
    $number = rand(1, 100);
    $question = "{$number}";
    if (isEven($number)) {
        $correctAnswer = 'yes';
    } else {
        $correctAnswer = 'no';
    }

    return [$question, $correctAnswer];
}

/**
 * Parity check
 *
 * @param integer $number number to check
 *
 * @return bool
 */
function isEven($number)
{
    if ($number % 2 === 0) {
        return true;
    }
    return false;
}
