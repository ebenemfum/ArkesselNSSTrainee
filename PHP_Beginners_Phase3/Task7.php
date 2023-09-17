<?php
class Car {
    // Properties (attributes)
    public $make;
    public $model;
    public $year;

    // Constructor method
    public function __construct($make, $model, $year) {
        $this->make = $make;
        $this->model = $model;
        $this->year = $year;
    }

    // Method to start the car
    public function start() {
        echo "The {$this->year} {$this->make} {$this->model} is starting.<br>";
    }

    // Method to stop the car
    public function stop() {
        echo "The {$this->year} {$this->make} {$this->model} is stopping.<br>";
    }
}


// Create two Car objects
$car1 = new Car("Toyota", "Camry", 2022);
$car2 = new Car("Honda", "Civic", 2023);

// Call methods on the objects
$car1->start(); // Output: The 2022 Toyota Camry is starting.
$car2->start(); // Output: The 2023 Honda Civic is starting.

$car1->stop();  // Output: The 2022 Toyota Camry is stopping.
$car2->stop();  // Output: The 2023 Honda Civic is stopping.

?>