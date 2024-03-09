<?php

function readInputText()
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        return $_POST['text'];
    }
    return '';
}

function tokenizeText($text)
{
    // Tokenize the text into words, removing punctuation and converting to lowercase
    return preg_split('/\W+/', strtolower($text), -1, PREG_SPLIT_NO_EMPTY);
}

function calculateWordFrequencies($words, $stopWords): array
{
    // Create an associative array to store word frequencies
    $wordCounts = array();

    // Iterate through the words and update the frequency
    foreach ($words as $word) {
        if (!in_array($word, $stopWords)) {
            $wordCounts[$word] = isset($wordCounts[$word]) ? $wordCounts[$word] + 1 : 1;
        }
    }

    return $wordCounts;
}

function sortWords($wordCounts, $sortOrder)
{
    $sortOrder == 'asc' ? asort($wordCounts) : arsort($wordCounts);
    return $wordCounts;
}
