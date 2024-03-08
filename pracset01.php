<?php
/* Poorly organized and hard-to-read code (NOT ANYMORE!)
Authors: Abarracoso, Marclin
         Nepomuceno, Mark Dhenniel
*/

/**
 * Calculate the total price of items in a shopping cart
 *
 * Iterates through the products array and calculate the price by summing
 * up the prices of all the products.
 * Returns totalPrice.
 *
 * @param array $items An array of products with 'price' key.
 * @return float The totalPrice of all products.
 */
function calculateTotalPrice(array $items): float
{
    $totalPrice = 0.0;
    foreach ($items as $item) {
        $totalPrice += $item['price'];
    }
    return $totalPrice;
}


// Perform a series of string manipulations
$string = "This is a poorly written program with little
structure and readability.";
// Remove spaces and convert to lowercase
$string = str_replace(' ', '', $string);
$string = strtolower($string);
// Display the modified string
echo "\nModified string: " . $string;
// Check if a number is even or odd
$number = 42;
if ($number % 2 == 0) {
    echo "\nThe number " . $number . " is even.";
} else {
    echo "\nThe number " . $number . " is odd.";
}



// Example usage:

$products = [
    ['name' => 'Widget A', 'price' => 10],
    ['name' => 'Widget B', 'price' => 15],
    ['name' => 'Widget C', 'price' => 20],
];
$total = calculateTotalPrice($products);
echo "Total Price: $total\n";
