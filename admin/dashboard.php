<?php
  // Include the database configuration file
  include '../includes/config.php';

  // Fetch number of users
  $userQuery = "SELECT COUNT(*) as count FROM Users"; // Replace 'Users' with your actual users table name
  $userResult = $conn->query($userQuery);
  $userCount = $userResult->fetch_assoc()['count'];

  // Fetch number of recipes
  $recipeQuery = "SELECT COUNT(*) as count FROM Recipes"; // Replace 'Recipes' with your actual recipes table name
  $recipeResult = $conn->query($recipeQuery);
  $recipeCount = $recipeResult->fetch_assoc()['count'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap">
</head>
<body>
    <?php 
        include 'includes/header.php';
        include 'includes/sidebar.php'; 
    ?>
    
        <div class="main">
            <div class="card">
                <h3>Number of Users</h3>
                <h1><?php echo $userCount; ?></h1>
            </div>
            <div class="card">
                <h3>Number of Recipes</h3>
                <h1><?php echo $recipeCount; ?></h1>
            </div>
        </div>
    </div>
    <!-- SIDEBAR MAIN END -->
</body>
</html>
