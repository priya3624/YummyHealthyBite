<?php
  // Include the database configuration file
  include '../includes/config.php';

  // Handle deletion
  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_id'])) {
    $recipe_id = $_POST['delete_id'];
    $stmt = $conn->prepare("DELETE FROM Recipes WHERE recipe_id = ?");
    $stmt->bind_param("i", $recipe_id);
    if ($stmt->execute()) {
      echo "Recipe deleted successfully.";
    } else {
      echo "Error: " . $conn->error;
    }
  }

  // Fetch all recipes
  $query = "SELECT * FROM Recipes";
  $result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap">
  <link rel="stylesheet" type="text/css" href="style.css">
  <title>Recipes</title>
  <style>
    .recipe-card {
      display: flex;
      flex-direction: row;
      justify-content: flex-start;
    }

    .recipe-card-img {
      display: flex;
      justify-content: center;
      max-height: 100px;
      max-width: 150px;
      margin-right: 20px;
    }

    .recipe-card-img img {
      max-width: 100%;
      max-height: 100%;
      border-radius: 10px;
      box-shadow: 0 3px 2px -2px gray;
    }

    .recipe-edit-link {
      text-decoration: none;
      padding: 5px 10px;
      font-size: 12.8px;
      margin-right: 10px;
    }
    </style>
</head>
<body>
    <?php 
      include 'includes/header.php';
      include 'includes/sidebar.php'; 
    ?>

    <div class="container">
      <h2 >View and Edit Recipes</h2>
      <?php while($recipe = $result->fetch_assoc()): ?>
        <div class="recipe-card">
          <div class="recipe-card-img">
            <img src="../images/<?php echo $recipe['image_url']; ?>" alt="<?php echo $recipe['title']; ?>">
          </div>
          <div class="recipe-card-content">
            <h3 class="recipe-title"><?php echo $recipe['title']; ?></h3>
            <p class="recipe-description"><?php echo $recipe['description']; ?></p>
            <a class="recipe-edit-link" href="edit-recipe.php?id=<?php echo $recipe['recipe_id']; ?>">Edit Recipe</a>
            <a class="recipe-edit-link" href="delete-recipe.php?id=<?php echo $recipe['recipe_id']; ?>">Delete Recipe</a>          
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </div>
  <!-- SIDEBAR MAIN END -->
</body>
</html>
