<!DOCTYPE html>
<html>
<head>
  <title>Yummy Healthy Bite - Recipe Details</title>
  <link rel="stylesheet" type="text/css" href="style.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Kalam:wght@400;700&display=swap">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap">
  <style>
    body {
      background-color: #f2f2f2;
      margin: 0;
      padding: 0;
    }

    .page-header {
        padding: 2px;
    }
  </style>
</head>
<body>
  <?php
    include 'includes/header.php';
  ?>

    <div class="main-content">

      <header class="page-header1">
        <h1>Recipe Details</h1>
      </header>
      
      <div class="main-container">
        <?php
          // Include the database configuration file
          include 'includes/config.php';

          // Get the recipe id from the URL
          $recipe_id = $_GET['id'];

          // Retrieve the recipe from the database
          $sql = "SELECT * FROM Recipes WHERE recipe_id=$recipe_id";
          $result = $conn->query($sql);
          
          if ($result->num_rows > 0) {
            // Output data of the recipe
            $row = $result->fetch_assoc();
            echo '<div class="recipe-card-details">';
            echo '<h2>' . $row['title'] . '</h2>';
            echo '<img src="images/' . $row['image_url'] . '" alt="' . $row['title'] . '">';
            echo '<p><strong>Description:</strong> ' . $row['description'] . '</p>';
            echo '<p><strong>Ingredients:</strong> ' . $row['ingredients'] . '</p>';   
            echo '<p><strong>Instructions:</strong> ' . $row['instructions'] . '</p>';
            
            // Check if the user is logged in
            if (isset($_SESSION['username'])) {
                echo '<form method="POST" action="">';
                echo '<input type="hidden" name="recipe_id" value="' . $row['recipe_id'] . '">';
                echo '<button type="submit" class="fav-button" name="add_favorite">Add to favorites</button>';
?>
  <a href="<?php echo $row['recipe_url']; ?>" target="_blank" class="fav-button">watch video</a> 
<?php
                
                echo '</form>';
            }
            
            echo '</div>';            
          } else {
              echo "No recipe found.";
          }
        ?>
      </div>

    </div>
    <!-- MAIN CONTENT -->

  <?php
    include 'includes/footer.php';
  ?>

  <script>
    function addFavorite(recipeId) {
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "add_favorite.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.send("recipe_id=" + recipeId);
    }
  </script>

</body>
</html>


<?php
  // Add to favorites
  if (isset($_POST['add_favorite'])) {
    $recipe_id = $_POST['recipe_id'];
    $username = $_SESSION['username'];

    // Retrieve the user ID from the username
    $stmt = $conn->prepare("SELECT user_id FROM Users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    $user_id = $user['user_id'];
    $stmt->close();

    // Insert into Favorites table
    $stmt = $conn->prepare("INSERT INTO Favorites (user_id, recipe_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $user_id, $recipe_id);

    if ($stmt->execute()) {
        echo "<script>alert('Recipe added to favorites successfully.');</script>";
    } else {
        echo "<script>alert('Error: ' . $stmt->error;);</script>";
    }

    $stmt->close();
  }

  // Close the connection here, after all database operations are done
  $conn->close();
?>