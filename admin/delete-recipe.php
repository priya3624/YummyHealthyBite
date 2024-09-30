<?php
  // Include the database configuration file
  include '../includes/config.php';

  // Fetch the recipe id
  if (isset($_GET['id'])) {
    $recipe_id = $_GET['id'];

    // Delete the references from the favorites table
    $stmt = $conn->prepare("DELETE FROM Favorites WHERE recipe_id = ?");
    $stmt->bind_param("i", $recipe_id);
    $stmt->execute();

    // Delete the recipe
    $stmt = $conn->prepare("DELETE FROM Recipes WHERE recipe_id = ?");
    $stmt->bind_param("i", $recipe_id);
    if ($stmt->execute()) {
      echo "Recipe deleted successfully.";
    } else {
      echo "Error: " . $conn->error;
    }
  }

  // Redirect back to the recipes page
  header("Location: view-recipe.php");
  exit;
?>