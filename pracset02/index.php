<! -- Authors: Abarracoso, Marclin
Nepomuceno, Mark Dhenniel -->

<?php
$stopWordsFile = 'stop_words.txt';
$stopWords = file($stopWordsFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
$stopWords = array_map('strtolower', $stopWords);

require_once 'process.php';


$text = readInputText();
$sortOrder = $_POST['sort'] ?? 'asc';
$limit = $_POST['limit'] ?? 10;

if (!empty($text)) {
    // Tokenize the input text
    $words = tokenizeText($text);

    // Calculate word frequencies
    $wordCounts = calculateWordFrequencies($words, $stopWords);

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
    <textarea id="text" name="text" rows="10" cols="50" required><?php echo $text; ?></textarea><br><br>

    <label for="sort">Sort by frequency:</label>
    <select id="sort" name="sort">
        <option value="asc" <?php if ($sortOrder === 'asc') echo 'selected'; ?>>Ascending</option>
        <option value="desc" <?php if ($sortOrder === 'desc') echo 'selected'; ?>>Descending</option>
    </select><br><br>

    <label for="limit">Number of words to display:</label>
    <input type="number" id="limit" name="limit" value="<?php echo $limit; ?>" min="1"><br><br>

    <input type="submit" name="calcWordFrequency" value="Calculate Word Frequency">
</form>

<?php if (!empty($text)): ?>
    <div class="result-container">
        <h2>Word Frequency Results</h2>
        <table>
            <thead>
            <tr>
                <th>Word</th>
                <th>Frequency</th>
            </tr>
            </thead>
            <tbody>
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
            </tbody>
        </table>
    </div>
<?php endif; ?>

</body>
</html>
