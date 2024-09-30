<?php
  // Include the database configuration file
  include '../includes/config.php';

  // Delete user
  if (isset($_GET['delete'])) {
    $user_id = $_GET['delete'];
    // Make sure to use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("DELETE FROM Users WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    if ($stmt->affected_rows > 0) {
      echo "<script>alert('User deleted successfully.');</script>";
    } else {
      echo "<script>alert('User deletion failed.');</script>";
    }
    header("Location: ".$_SERVER['PHP_SELF']);
    exit;
  }

  // Fetch registered users
  $query = "SELECT * FROM Users";
  $result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="stylesheet" type="text/css" href="style.css">
  <title>Registered Users</title>
</head>
<body>
  <?php 
    include 'includes/header.php';
    include 'includes/sidebar.php'; 
  ?>

    <div class="container">
      <h2 >Registered Users</h2>
      <table>
        <tr>
          <th>User ID</th>
          <th>Username</th>
          <th>Email</th>
          <th>Actions</th>
        </tr>
        <?php while($user = $result->fetch_assoc()): ?>
          <tr>
            <td><?php echo $user['user_id']; ?></td>
            <td><?php echo $user['username']; ?></td>
            <td><?php echo $user['email']; ?></td>
            <td>
              <a href="mailto:<?php echo $user['email']; ?>"><i class="fas fa-reply"></i></a>
              <a href="?delete=<?php echo $user['user_id']; ?>" onclick="return confirm('Are you sure you want to delete this user?');"><i class="fas fa-trash-alt"></i></a>
            </td>
          </tr>
        <?php endwhile; ?>
      </table>
    </div>
  </div>
  <!-- SIDEBAR MAIN END -->
</body>

</html>
