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
use function Brain\Games\Games\Even\playEven;
use function Brain\Games\Games\Calc\playCalc;

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

    $attempts = 3;

    switch ($gameName) {
        case 'even':
            [$correctAnswer, $answer, $failGame] = playEven($attempts);
            break;
        case 'calc':
            [$correctAnswer, $answer, $failGame] = playCalc($attempts);
            break;
        default:
            // error
            break;
    }

    if ($failGame === true) {
        badFinish($userName, $answer, $correctAnswer);
    } else {
        line("Congratulations, {$userName}!");
    }
}

/**
 * Bad finishing game
 *
 * @param string $userName      User's name
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
