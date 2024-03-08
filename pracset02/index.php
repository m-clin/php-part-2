<! -- Authors: Abarracoso, Marclin
Nepomuceno, Mark Dhenniel -->

<?php
$stopWords = array('a', 'an', 'and', 'are', 'as', 'at', 'be', 'by', 'for', 'from', 'has', 'he', 'in', 'is', 'it', 'its',
    'of', 'on', 'that', 'the', 'to', 'was', 'were', 'will', 'with');

function tokenizeText($text)
{
    // Tokenize the text into words, removing punctuation and converting to lowercase
    return preg_split('/\W+/', strtolower($text), -1, PREG_SPLIT_NO_EMPTY);
}

function calculateWordFrequencies($words)
{
    global $stopWords;

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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $text = $_POST['text'];
    $sortOrder = $_POST['sort'];
    $limit = $_POST['limit'];

    // Tokenize the input text
    $words = tokenizeText($text);

    // Calculate word frequencies
    $wordCounts = calculateWordFrequencies($words);

    // Sort the word counts based on the selected order
    $sortedWordCounts = sortWords($wordCounts, $sortOrder);

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Word Frequency Counter</title>
    <link rel="stylesheet" type="text/css" href="styles.css">

</head>
<body>
<h1>Word Frequency Counter</h1>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="text">Paste your text here:</label><br>
    <textarea id="text" name="text" rows="10" cols="50" required></textarea><br><br>

    <label for="sort">Sort by frequency:</label>
    <select id="sort" name="sort">
        <option value="asc">Ascending</option>
        <option value="desc">Descending</option>
    </select><br><br>

    <label for="limit">Number of words to display:</label>
    <input type="number" id="limit" name="limit" value="10" min="1"><br><br>

    <input type="submit" name="calcWordFrequency" value="Calculate Word Frequency">
</form>

<?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
    <div class="result-container">
        <h2>Word Frequency Results</h2>
        <table>
            <tr>
                <th>Word</th>
                <th>Frequency</th>
            </tr>
            <?php
            $count = 0;
            foreach ($sortedWordCounts as $word => $frequency) {
                echo "<tr>";
                echo "<td>$word</td>";
                echo "<td>$frequency</td>";
                echo "</tr>";
                $count++;
                if ($count >= $limit) {
                    break;
                }
            }
            ?>
        </table>
    </div>
<?php endif; ?>

</body>
</html>
