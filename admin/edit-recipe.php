<?php
// Start the session
session_start();

// Include the database configuration file
include '../includes/config.php';

// Initialize variables
$recipe = [
  'title' => '',
  'description' => '',
  'ingredients' => '',
  'instructions' => '',
  'image_url' => ''
];

// Fetch recipe data
if (isset($_GET['id'])) {
  $recipe_id = $_GET['id'];
  $stmt = $conn->prepare("SELECT * FROM Recipes WHERE recipe_id = ?");
  $stmt->bind_param("i", $recipe_id);
  $stmt->execute();
  $result = $stmt->get_result();
  $recipe = $result->fetch_assoc();
}

// Update recipe data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $recipe_id = $_GET['id'];
  $title = $conn->real_escape_string($_POST['title']);
  $description = $conn->real_escape_string($_POST['description']);
  $ingredients = $conn->real_escape_string($_POST['ingredients']);
  $instructions = $conn->real_escape_string($_POST['instructions']);

  // Handle image upload
  if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = '../images/';
    $uploadFile = $uploadDir . basename($_FILES['image']['name']);
    if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
      $image_url = $conn->real_escape_string($uploadFile);
    } else {
      $_SESSION['message'] = 'Error uploading image.';
    }
  } else {
    $image_url = $conn->real_escape_string($_POST['image_url']);
  }

  $query = "UPDATE Recipes SET title = '$title', description = '$description', ingredients = '$ingredients', instructions = '$instructions', image_url = '$image_url' WHERE recipe_id = $recipe_id";
  if ($conn->query($query) === TRUE) {
    $_SESSION['message'] = 'Recipe updated successfully.';
  } else {
    $_SESSION['message'] = 'Error: ' . $conn->error;
  }
  header("Location: ".$_SERVER['PHP_SELF']."?id=".$recipe_id);
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap">
  <link rel="stylesheet" type="text/css" href="style.css">
  <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
  <title>Recipes</title>
</head>
<body>
  <?php
    if (isset($_SESSION['message'])) {
      echo "<script>alert('".$_SESSION['message']."');</script>";
      // Remove the message from the session
      unset($_SESSION['message']);
    }

    include 'includes/header.php';
    include 'includes/sidebar.php'; 
  ?>

  <div class="container">
    <h2>Recipes</h2>
    <form method="POST" enctype="multipart/form-data" onsubmit="return preparePost();">
      <input type="hidden" name="instructions" id="instructions">

      <label for="title">Title:</label>
      <input type="text" id="title" name="title" value="<?php echo $recipe['title']; ?>" required><br>

      <label for="description">Description:</label>
      <textarea id="description" name="description" required><?php echo $recipe['description']; ?></textarea><br>

      <label for="ingredients">Ingredients:</label>
      <textarea id="ingredients" name="ingredients" required><?php echo $recipe['ingredients']; ?></textarea><br>

      <label for="quillEditor">Instructions:</label>
      <div id="quillEditor" style="height: 250px;"><?php echo ($recipe['instructions']); ?></div><br>

      <label style="display: inline;"for="image">Image:</label>
      <input type="file" id="image" name="image"><br><br>

      <input type="submit" value="Update Recipe">
    </form>
  </div>
  
  <!-- Include Quill's JavaScript -->
  <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

  <script>
    var quill = new Quill('#quillEditor', {
      theme: 'snow'
    });

    function preparePost() {
      var instructions = document.querySelector('input[name=instructions]');
      instructions.value = quill.root.innerHTML;
      return true;
    }
  </script>
</body>
</html>
