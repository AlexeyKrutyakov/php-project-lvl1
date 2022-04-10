<?php

/**
 * This file content functions for brain-even-game
 *
 * PHP version 8
 *
 * @category PHP
 * @package  Brain\Games\Even
 * @author   Alexey <arctik.coder@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://coder-arctik.com
 */

namespace Brain\Games\Even;

use function cli\line;
use function cli\prompt;

/**
 * Playing with user
 * 
 * @return nothing
 */
function playEven()
{
    // greeting
    line('Welcome to the Brain Games!');
    $name = prompt('May I have your name?');
    line("Hello, {$name}!");

    // game
    line('Answer "yes" if the number is even, otherwise answer "no".');
    
    $attempts = 3;
    $failGame = false;

    for ($i = 0; $i < $attempts; $i++) {
        [$guessNumber, $correctAnswer] = guess();
        line("Question: {$guessNumber}");
        $answer = prompt("Your answer");
        if ($answer === $correctAnswer) {
            line('Correct!');
        } else {
            badFinish($name, $answer, $correctAnswer);
            $failGame = true;
            break;
        }
    }

    if ($failGame === false) {
        line("Congratulations, {$name}!");
    }
}
/**
 * Bad finishing game
 * 
 * @param string $name          User's name
 * @param string $answer        User's answer
 * @param string $correctAnswer rigth answer
 * 
 * @return nothing
 */
function badFinish($name, $answer, $correctAnswer)
{
    line("'{$answer}' is wrong answer ;(. Correct answer was '{$correctAnswer}'.");
    line("Let's try again, {$name}!");
}

/**
 * One step of the game
 * 
 * @return Array [integer $guessNumber, string $correctAnswer]
 */
function guess()
{
    $number = rand(1, 100);
    if (isEven($number)) {
        $correctAnswer = 'yes';
    } else {
        $correctAnswer = 'no';
    }

    return [$number, $correctAnswer];
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