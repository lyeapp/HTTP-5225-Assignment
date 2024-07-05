<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Art Gallery</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <style>
    .custom-border {
      border: 2px solid #ff6347; /* Tomato color */
    }
  </style>
</head>
<body>
  <?php include('reusable/nav.php'); ?>

  <div class="container-fluid">
    <div class="container">
      <div class="row">
        <div class="col">
        <h1 class="display-4 mt-5 mb-5 text-center text-uppercase fw-bold text-warning">Painters</h1>
        </div>
        </div>
      </div>
    </div>
  </div>

  <?php 
      include('inc/functions.php');
      $connect = mysqli_connect('localhost', 'root', 'root', 'artgallery');
      if(!$connect){
        die("Connection Failed: " . mysqli_connect_error());
      }

      // Fetch all painters
      $query = 'SELECT * FROM painters';
      $painters = mysqli_query($connect, $query);
  ?>

  <div class="container-fluid">
    <div class="container">
      <div class="row">
        <div class="col">
          <?php get_message(); ?>
        </div>
      </div>
      <div class="row">
        <?php
          while($painter = mysqli_fetch_assoc($painters)){
            echo '<div class="col-md-4 mt-2 mb-2">
                    <div class="card custom-border shadow-sm">
                      <div class="card-body">
                        <div class="mb-3">
                          <span class="badge" style="background-color: lightgreen; font-size: 1.25rem; padding: 10px;">' . $painter['Name'] . '</span>
                        </div>
                        <p class="card-text"><strong>Date of Birth:</strong> ' . $painter['DOB'] . '</p>
                        <p class="card-text"><strong>Origin:</strong> ' . $painter['Origin'] . '</p>
                        <h4 class="card-subtitle mb-2 text-muted">Paintings</h4>';
            
            // Fetch paintings for each painter
            $painter_id = $painter['Painter_id'];
            $painting_query = 'SELECT * FROM paintings WHERE Artist_id = ' . $painter_id;
            $paintings = mysqli_query($connect, $painting_query);
            
            while($painting = mysqli_fetch_assoc($paintings)){
              echo '<div class="mb-2"><span class="badge bg-info" style="font-size: 1rem; padding: 5px;">' . $painting['Painting'] . '</span></div>
                    <p class="card-text"><strong>Year:</strong> ' . $painting['Year'] . '</p>
                    <p class="card-text"><strong>Medium:</strong> ' . $painting['Medium'] . '</p>
                    <p class="card-text"><strong>Location:</strong> ' . $painting['Location'] . '</p>
                    <hr>';
            }

            echo '      </div>  
                    </div>
                  </div>';
          }
        ?>
      </div>
    </div>
  </div>
</body>
</html>


