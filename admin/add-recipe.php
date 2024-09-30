<?php
  // Include the database configuration file
  include '../includes/config.php';

  // Check if form is submitted
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $title = $conn->real_escape_string($_POST['title']);
    $description = $conn->real_escape_string($_POST['description']);
    $ingredients = $conn->real_escape_string($_POST['ingredients']);
    $instructions = $conn->real_escape_string($_POST['instructions']);

    // Check if file is uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
      $image = $_FILES['image'];
      
      // Check if file is an image
      $check = getimagesize($image['tmp_name']);
      if ($check !== false) {
        // Move uploaded file to images directory
        $imagePath = basename($image['name']);
        if (move_uploaded_file($image['tmp_name'], $imagePath)) {
          // Insert data into database
          $query = "INSERT INTO Recipes (title, description, ingredients, instructions, image_url)
                    VALUES ('$title', '$description', '$ingredients', '$instructions', '$imagePath')";
          if ($conn->query($query) === TRUE) {
            echo "<script>alert('New recipe added successfully.');</script>";
          } else {
            echo "<script>alert('Error: " . $sql . "<br>" . $conn->error . "');</script>";
          }
        } else {
          echo "<script>alert('Failed to move uploaded file.');</script>";
        }
      } else {
        echo "<script>alert('File is not an image.');</script>";
      }
    } else {
      echo "<script>alert('Failed to upload file.');</script>";
    }
  }
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap">
  <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
  <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
  <link rel="stylesheet" type="text/css" href="style.css">
  <title>Add Recipe</title>
</head>
<body>
  <?php 
    include 'includes/header.php';
    include 'includes/sidebar.php'; 
  ?>
    <div class="container">
      <h2 >Add Recipes</h2>

      <form id="add-recipe-form" method="POST" enctype="multipart/form-data">
          <label for="title">Recipe Title:</label>
          <input type="text" name="title" placeholder="Recipe Title" required>
          <label style="display: inline;" for="image">Image:</label>
          <input type="file" name="image" required>
          <label for="description">Description:</label>
          <textarea name="description" placeholder="Description" required></textarea>
          <label for="ingredients">Ingredients:</label>
          <textarea name="ingredients" placeholder="Ingredients" required></textarea>
          <label for="instructions-editor">Instructions:</label>
          <div id="instructions-editor" style="height: 250px;"></div>
          <input type="hidden" name="instructions">
          <input type="submit" value="Add Recipe">
      </form>
    </div>
  </div>
  <!-- SIDEBAR MAIN END -->
  
  <script>
    var quillInstructions = new Quill('#instructions-editor', {
      theme: 'snow'
    });

    document.querySelector('#add-recipe-form').onsubmit = function() {
      var instructionsInput = document.querySelector('input[name=instructions]');
      instructionsInput.value = quillInstructions.root.innerHTML;
    }
  </script>
</body>
</html>