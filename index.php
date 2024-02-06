<?php

    $hotels = [
        
        [
            'name' => 'Hotel Belvedere',
            'description' => 'Hotel Belvedere Descrizione',
            'parking' => true,
            'vote' => 4,
            'distance_to_center' => 10.4
        ],
        [
            'name' => 'Hotel Futuro',
            'description' => 'Hotel Futuro Descrizione',
            'parking' => true,
            'vote' => 2,
            'distance_to_center' => 2
        ],
        [
            'name' => 'Hotel Rivamare',
            'description' => 'Hotel Rivamare Descrizione',
            'parking' => false,
            'vote' => 1,
            'distance_to_center' => 1
        ],
        [
            'name' => 'Hotel Bellavista',
            'description' => 'Hotel Bellavista Descrizione',
            'parking' => false,
            'vote' => 5,
            'distance_to_center' => 5.5
        ],
        [
            'name' => 'Hotel Milano',
            'description' => 'Hotel Milano Descrizione',
            'parking' => true,
            'vote' => 2,
            'distance_to_center' => 50
        ],


    ];

    $resultPark = null;
    $resultRating = null;

    if((isset($_GET['parking']))) {
        $resultPark = $_GET['parking'];
    }
    if(isset($_GET['rating'])){
        $resultRating = $_GET['rating'];
        intval($resultRating);
    }
    
    if((isset($resultPark)) && (isset($resultRating))){

        $filterHotels = [];
    
        foreach ($hotels as $singleHotel){
            if(($resultPark == 'Yes') && ($singleHotel['parking'] == true) && ($resultRating <= $singleHotel['vote'] )){
                $filterHotels[] = $singleHotel;
            }else if(($resultPark == 'No') && ($singleHotel['parking'] == false) && ($resultRating <= $singleHotel['vote'] )){
                $filterHotels[] = $singleHotel;
            }else if(($resultPark == '0') && ($resultRating == '0' )){
                $filterHotels[] = $singleHotel;
            }
        }
        $hotels = $filterHotels;
    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Hotel</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    </head>
    <body class="bg-dark">
        <div class="container">
            <h1 class="text-white text-center my-4">
                Hotels
            </h1>

            <!-- Sezione form -->
            <form action="./index.php" method="get">
                <div class="row justify-content-center">
                    
                    <div class="col-5">
                        <select class="form-select" aria-label="Default select example" name="parking">
                            <option selected value="0">Parcheggio</option>
                            <option value="Yes">Si</option>
                            <option value="No">No</option>
                        </select>
                    </div>

                    <div class="col-5">
                        <select class="form-select" aria-label="Default select example" name="rating">
                            <option selected value="0">Voti</option>
                            <?php 
                                for($i = 1; $i <= 5; $i++){
                                    echo '<option value="'.$i.'">'.$i.'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    
                    <div class="col-1">
                        <button class="btn btn-primary" type="submit">
                            Filtra
                        </button>
                    </div>
                
                </div>
            </form>
            
            <!-- Sezione tabella -->
            <table class="table border mt-4">
                <thead>
                    <tr>
                        <?php  
                           
                            $keys = array_keys($hotels[0]);
    
                            foreach($keys as $key) {
                                echo '<th scope="col">'.$key.'</th>';
    
                            }
                            
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach ($hotels as $singleHotel){
                    ?>
                    <tr>
                        <?php 
                            echo '<td>'.$singleHotel['name'].'</td>';
                            echo '<td>'.$singleHotel['description'].'</td>';
                            if($singleHotel['parking'] == true){
                                echo '<td>Yes</td>';
                            }elseif($singleHotel['parking'] == false){
                                echo '<td>No</td>';
                            }
                            echo '<td>'.$singleHotel['vote'].'</td>';
                            echo '<td>'.$singleHotel['distance_to_center'].'</td>';
                        ?>
                            
    
                            
                    </tr>
                    <?php  
                        };
                    ?>   
                </tbody>
            </table>
        </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    </body>
</html>