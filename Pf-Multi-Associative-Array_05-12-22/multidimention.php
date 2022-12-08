<?php

$cars=array(
    "BMW" =>array(
        "model1"=> "Series 3",
        "model2"=> "Series 5",
        "model3"=> "Series 7"

    ),
    "Audi" =>array(
        "model1"=> "A 3",
        "model2"=> "A 4",
        "model3"=> "A 5",
        "model4"=> "A 6"
    ),
    "Honda" =>array(
        "model1"=> "City",
        "model2"=> "Civic",
        "model3"=> "BRV",
        "model4"=> "Accord"
    ),
    "Jaguar" =>array(
        "model1"=> "E-Pace",
        "model2"=> "F-Pase",
    )
    );

//Create array with index int
    $cars2=array(
        "1" =>array(
            "model1"=> "Series 3",
            "model2"=> "Series 5",
            "model3"=> "Series 7"
    
        ),
        "2" =>array(
            "model1"=> "A 3",
            "model2"=> "A 4",
            "model3"=> "A 5",
            "model4"=> "A 6"
        ),
        "3" =>array(
            "model1"=> "City",
            "model2"=> "Civic",
            "model3"=> "BRV",
            "model4"=> "Accord"
        ),
        "4" =>array(
            "model1"=> "E-Pace",
            "model2"=> "F-Pase",
        )
        );

// Push into array
    echo "<h2> Push with key as string</h2>";
    array_push($cars, ["model1" =>"A 3","model2"=> "A 4", "model3"=> "A 5","model4"=> "A 6"]);    
    echo "<pre>";
    print_r($cars);
    echo "<pre>";

// Push into array with int value
    echo "<h2> Push with key as int </h2>";
    array_push($cars2, ["model1" =>"A 3","model2"=> "A 4", "model3"=> "A 5","model4"=> "A 6"]);    
    echo "<pre>";
    print_r($cars2);
    echo "<pre>";

// Pop Array
    echo "<h2> Pop </h2>";
    array_pop($cars);
    echo "<pre>";
    print_r($cars);
    echo "<pre>";

// Shift Array
    echo "<h2> Shift Array </h2>";
    array_shift($cars);
    echo "<pre>";
    print_r($cars);
    echo "<pre>";

// Merge Array
    echo "<h1> Merge Array </h1>";
    $merge = array_merge($cars,$cars2);
    echo "<pre>";
    print_r($merge);
    echo "<pre>";

 // Intersection Array   
    echo "<h1> Intersection Array </h1>";
    $inter = array_intersect_assoc($cars,$cars2);
    echo "<pre>";
    print_r($inter);
    echo "<pre>";

// Size of Array
    echo "<h1> Size of Array</h1>";
    $size = sizeof($cars);
    echo "<pre>";
    print_r($size);
    echo "<pre>";


    

// Print Array
    echo "<h1> Looping of Multidimention Associative Array</h1>";
    foreach($cars as $car => $model){
        echo $car. ":". "<br>";
        foreach($model as $value){
            echo  $value."<br>";
        }
        echo "<br>";
    }

?>