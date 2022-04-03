<?php

/**
 * This file content functions for brain-games
 * 
 * PHP version 8
 * 
 * @category PHP
 * @package  Brain\Games\Cli
 * @author   Alexey Coder-Arctik <arctik.coder@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     http://coder-arctik.com
 */
namespace Brain\Games\Cli;

use function cli\line;
use function cli\prompt;

/**
 * Greetings user
 * 
 * @return nothing
 */
function greeting()
{
    line('Welcome to the Brain Game!');
    $name = prompt('May I have your name?');
    line("Hello, %s!", $name);
}
