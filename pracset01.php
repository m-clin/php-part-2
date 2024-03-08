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

/**
 * Perform a series of string manipulations
 *
 * Removes spaces and convert the given string to lowercase.
 *
 * @param string $string The string to manipulate.
 * @return string The modified string.
 */
function manipulationString(string $string): string
{
    // Remove spaces and convert to lowercase
    $string = str_replace(' ', '', $string);
    return strtolower($string);
}

/**
 * Check if a number is even or odd
 *
 * A given number is determined if it is an even or odd number.
 * If the given number is an even number, it will return an indication that it is an even number.
 * If the given number is an odd number, it will return an indication that it is an odd number.
 *
 * @param int $number The given number to check.
 * @return string The result indicating if the given number is even or odd.
 */
function isNumberEvenOdd(int $number): string
{
    return ($number % 2 == 0) ? "The number $number is even." : "The number $number is odd.";
}


// Example usage for calculateTotalPrice:

$products = [
    ['name' => 'Widget A', 'price' => 10],
    ['name' => 'Widget B', 'price' => 15],
    ['name' => 'Widget C', 'price' => 20],
];
$total = calculateTotalPrice($products);
echo "Total Price: $total\n";


// Example usage for manipulationString:

$string = "This is a poorly written program with little structure and readability.";
$modifiedString = manipulationString($string);
echo "String: $string \n";
echo "Modified string: $modifiedString \n";


// Example usage for isNumberEvenOdd:

$number = 42;
$evenOddResult = isNumberEvenOdd($number);
echo "$evenOddResult";