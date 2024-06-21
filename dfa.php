<?php
function dfa($input) {
    $currentState = 'q0';

    foreach (str_split($input) as $symbol) {
        switch ($currentState) {
            case 'q0':
                if ($symbol == 'a') {
                    $currentState = 'q1';
                } else {
                    return false; // Invalid input (starts with 'b')
                }
                break;

            case 'q1':
                if ($symbol == 'b') {
                    $currentState = 'q2';
                } else {
                    return false; // Invalid input (expected 'b')
                }
                break;

            case 'q2':
                if ($symbol == 'b') {
                    $currentState = 'q1';
                } elseif ($symbol == 'a') {
                    $currentState = 'q3'; // Accept state
                } else {
                    return false; // Invalid input
                }
                break;

            case 'q3': // Accept state - loop on any input
                break;
        }
    }

    return ($currentState == 'q3'); // Accept if ended in q3
}

// Test the DFA with some input strings
$testStrings = ['abb', 'aabbbb', 'aaabbbbbb', 'ab', 'aabbbba', 'aba'];

foreach ($testStrings as $str) {
    if (dfa($str)) {
        echo "$str is accepted\n";
    } else {
        echo "$str is not accepted\n";
    }
}
?>
