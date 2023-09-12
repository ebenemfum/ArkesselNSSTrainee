
Based on what you have learnt so far, create a simple PHP script that calculates yearly profits.
a. Create a PHP script that calculates the yearly profits based on the following inputs:
• Monthly Gross Salary
• Monthly Net Salary
• Monthly Household Expenditure
b. Assumptions:
• There are 12 months in a year.
• Gross salary remains constant throughout the year.
• Net salary and household expenditure are considered per month.

<?php
// Function to calculate yearly profits
function calculateYearlyProfits($monthlyGrossSalary, $monthlyNetSalary, $monthlyHouseholdExpenditure) {
    // Assuming 12 months in a year
    $monthsInYear = 12;

    // Calculate yearly gross income
    $yearlyGrossIncome = $monthlyGrossSalary * $monthsInYear;

    // Calculate yearly net income
    $yearlyNetIncome = $monthlyNetSalary * $monthsInYear;

    // Calculate yearly household expenditure
    $yearlyHouseholdExpenditure = $monthlyHouseholdExpenditure * $monthsInYear;

    // Calculate yearly profit
    $yearlyProfit = $yearlyNetIncome - $yearlyHouseholdExpenditure;

    return $yearlyProfit;
}

// Input values
$monthlyGrossSalary = 5000; // Replace with your actual monthly gross salary
$monthlyNetSalary = 4000;   // Replace with your actual monthly net salary
$monthlyHouseholdExpenditure = 1500; // Replace with your actual monthly household expenditure

// Calculate and display the yearly profit
$yearlyProfit = calculateYearlyProfits($monthlyGrossSalary, $monthlyNetSalary, $monthlyHouseholdExpenditure);
echo "Yearly Profit: $yearlyProfit";
?>




