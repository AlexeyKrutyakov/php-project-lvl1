<?php

/**
 * This file content engine for brain-games
 *
 * PHP version 8
 *
 * @category PHP
 * @package  Brain\Games\Engine
 * @author   Alexey <arctik.coder@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://coder-arctik.com
 */

namespace Brain\Games\Engine;

use function cli\line;
use function cli\prompt;

/**
 * Playing with user
 *
 * @param string $gameName name of game
 *
 * @return nothing
 */
function playGame($gameName)
{
    // greeting
    line('Welcome to the Brain Games!');
    $userName = prompt('May I have your name?');
    line("Hello, {$userName}!");

    // game
    showTask($gameName);

    $attempts = 3;
    $failGame = false;

    for ($i = 0; $i < $attempts; $i++) {
        [$guessNumber, $correctAnswer] = guess($gameName);
        line("Question: {$guessNumber}");
        $answer = prompt("Your answer");
        if ($answer === $correctAnswer) {
            line('Correct!');
        } else {
            badFinish($userName, $answer, $correctAnswer);
            $failGame = true;
            break;
        }
    }

    if ($failGame === false) {
        line("Congratulations, {$userName}!");
    }
}

/**
 * Bad finishing game
 *
 * @param string $userName      User's userName
 * @param string $answer        User's answer
 * @param string $correctAnswer rigth answer
 *
 * @return nothing
 */
function badFinish($userName, $answer, $correctAnswer)
{
    line("'{$answer}' is wrong answer ;(. Correct answer was '{$correctAnswer}'.");
    line("Let's try again, {$userName}!");
}

/**
 * Show task for game
 *
 * @param string $gameName name of game
 *
 * @return nothing
 */
function showTask($gameName)
{
    switch ($gameName) {
        case 'even':
            line('Answer "yes" if the number is even, otherwise answer "no".');
            break;
        case 'calc':
            line('What is the result of the expression?');
            break;
        default:
            // error
            break;
    }
}

/**
 * One step of the game
 *
 * @return Array [integer $guessNumber, string $correctAnswer]
 */
function guess($gameName)
{
    switch ($gameName) {
        case 'even':
            $number = rand(1, 100);
            $question = "{$number}";
            if (isEven($number)) {
                $correctAnswer = 'yes';
            } else {
                $correctAnswer = 'no';
            }
            break;
        case 'calc':
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
            break;
        default:
            // error
            break;
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
