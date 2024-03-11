<?php

/**
 * Reads a list of stop words from a file and returns them as an array of lowercase strings.
 *
 * This function reads the contents of a file named 'stop_words.txt' located in the same directory
 * as the script. Each line in the file is assumed to contain a single stop word. The function
 * removes any empty lines and converts all stop words to lowercase before returning them as an array.
 *
 * The FILE_IGNORE_NEW_LINES flag is used to prevent the newline characters from being included in
 * the array elements. The FILE_SKIP_EMPTY_LINES flag is used to skip over any empty lines in the file.
 *
 * @return array An array of lowercase stop words read from the 'stop_words.txt' file.
 */
function getStopWords(): array
{
    $stopWords = file('stop_words.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    return array_map('strtolower', $stopWords);
}


/**
 * Reads the input text from the submitted form.
 *
 * @return string The input text, or an empty string if no text was submitted.
 */
function readInputText(): string
{
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        return $_POST['text'];
    }
    return '';
}


/**
 * Tokenizes the given text into an array of words.
 *
 * @param string $text The input text to be tokenized.
 * @return array|false An array of words from the input text, or false if the input text is empty or cannot be tokenized.
 */
function tokenizeText(string $text): array|false
{
    // Tokenize the text into words, removing punctuation and converting to lowercase
    return preg_split('/\W+/', strtolower($text), -1, PREG_SPLIT_NO_EMPTY);
}


/**
 * Calculates the frequency of each word in the given array of words, excluding stop words.
 *
 * @param array $words     An array of words to be processed.
 * @param array $stopWords An array of stop words to be excluded from the frequency count.
 * @return array An associative array where the keys are the words and the values are their respective frequencies.
 */
function calculateWordFrequencies(array $words, array $stopWords): array
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


/**
 * Sorts the given associative array of word frequencies in the specified order.
 *
 * @param array $wordCounts An associative array where the keys are words and the values are their respective frequencies.
 * @param string $sortOrder  The order in which to sort the word frequencies, either 'asc' (ascending) or 'desc' (descending).
 * @return array The sorted associative array where the keys are words and the values are their respective frequencies.
 */
function sortWords(array $wordCounts, string $sortOrder): array
{
    $sortOrder == 'asc' ? asort($wordCounts) : arsort($wordCounts);
    return $wordCounts;
}
