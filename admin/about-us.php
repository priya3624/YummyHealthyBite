<?php
  // Start the session
  session_start();

  // Include the database configuration file
  include '../includes/config.php';

  // Fetch existing data
  $query = "SELECT * FROM about_page WHERE id = 2";
  $result = $conn->query($query);
  $data = $result->fetch_assoc();

  // Check if form is submitted
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $title = $conn->real_escape_string($_POST['title']);
    $content = $conn->real_escape_string($_POST['content']);

    // Update data in the database
    $query = "UPDATE about_page SET title = '$title', content = '$content' WHERE id = 2";
    if ($conn->query($query) === TRUE) {
      $_SESSION['message'] = 'Page updated successfully.';
    } else {
      $_SESSION['message'] = 'Error: ' . $conn->error;
    }
    header("Location: ".$_SERVER['PHP_SELF']);
    exit;
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
  <title>Edit About Us</title>
</head>
<body>
  <?php 
    include 'includes/header.php';
    include 'includes/sidebar.php'; 
  ?>

    <div class="container">
      <h2 >Edit About Us</h2>

      <form id="edit-about-form" method="POST">
        <label for="title">Title:</label>
        <input type="text" name="title" value="<?php echo $data['title']; ?>" required><br><br>

        <label for="content-editor">Content:</label>
        <div id="content-editor" style="height: 300px;"><?php echo $data['content']; ?></div>
        <input type="hidden" name="content"><br>

        <input type="submit" value="Update Page">
      </form>

      <script>
        var quillContent = new Quill('#content-editor', {
          theme: 'snow'
        });

        var form = document.querySelector('#edit-about-form');
        var contentInput = document.querySelector('input[name=content]');

        form.addEventListener('submit', function(e) {
          contentInput.value = quillContent.root.innerHTML;
        });
      </script>
    </div>
  </div>
  <!-- SIDEBAR MAIN END -->

  <?php
    if (isset($_SESSION['message'])) {
      echo "<script>alert('".$_SESSION['message']."');</script>";
      // Remove the message from the session
      unset($_SESSION['message']);
    }
  ?>
</body>
</html>
