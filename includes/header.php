<?php
session_start(); // start the session
?>
<header class="header">
  <div class="header-container">
    <div class="logo">
      <!-- <img src="logo.png" alt="Yummy Health Bite Logo"> -->
      <h1 class="logo-text">YummyHealthyBite</h1>
    </div>
    <nav class="navbar">
      <ul class="nav-menu">
        <li class="nav-item"><a href="index.php">Home</a></li>
        <li class="nav-item"><a href="about.php">About</a></li>
        <li class="nav-item"><a href="admin\index.php">Admin</a></li>
        <?php
        if(isset($_SESSION['username'])) {
            echo '<li class="nav-item"><a href="favorite.php">Favorite</a></li>';
            echo '<li class="nav-item"><a href="logout.php">Logout</a></li>';
        } else {
            echo '<li class="nav-item"><a href="login.php">Login</a></li>';
        }
        ?>
      </ul>
    </nav>
  </div>
</header>
