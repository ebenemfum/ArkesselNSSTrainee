<?php


// Trim and validate each element in the array
$numbers = [];
function iterate($numbers){
foreach ($numbers as $number) {
    $trimmedNumber = trim($number);
    if (is_numeric($trimmedNumber)) {
        $validNumbers[] = (float)$trimmedNumber;
    }
}

// Display the array of valid numbers
if (!empty($validNumbers)) {
    echo "The array contains the following numbers:\n";
    print_r($validNumbers);
} else {
    echo "No valid numbers were entered.\n";
}
}

//Testing Function 
$numbers = [1,2,3,4];

iterate($numbers);


?>

