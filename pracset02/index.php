<! -- Authors: Abarracoso, Marclin
                Nepomuceno, Mark Dhenniel -->

<?php

function tokenizeText($text) {
    // Tokenize the text into words, removing punctuation and converting to lowercase
    return preg_split('/\W+/', strtolower($text), -1, PREG_SPLIT_NO_EMPTY);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $text = $_POST['text'];
    $sortOrder = $_POST['sort'];
    $limit = $_POST['limit'];

    // Tokenize the input text
    $words = tokenizeText($text);
}
?>

<!DOCTYPE html>
<html>
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
</body>
</html>
