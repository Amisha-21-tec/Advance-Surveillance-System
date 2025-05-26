<?php include('server.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register - Registration System</title>
  <!-- Bootstrap CSS for better styling -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f4f7fa;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .card {
      border: none;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      padding: 30px;
      background-color: #fff;
    }
    .header h2 {
      text-align: center;
      margin-bottom: 30px;
      color: #333;
    }
    .btn-primary {
      background-color: #007bff;
      border: none;
      padding: 10px;
      border-radius: 5px;
      transition: background-color 0.3s ease;
    }
    .btn-primary:hover {
      background-color: #0056b3;
    }
    .form-control:focus {
      box-shadow: none;
    }
    .text-center a {
      color: #007bff;
      text-decoration: none;
      transition: color 0.3s ease;
    }
    .text-center a:hover {
      color: #0056b3;
    }
  </style>
</head>
<body>

  <div class="card shadow-sm p-3 mb-5 bg-white rounded" style="max-width: 400px; width: 100%;">
    <div class="header">
      <h2>Register</h2>
    </div>

    <!-- Registration Form -->
    <form method="post" action="register.php">
      <?php include('errors.php'); ?>

      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" name="username" class="form-control" id="username" value="<?php echo $username; ?>" placeholder="Enter your username" required>
      </div>

      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" class="form-control" id="email" value="<?php echo $email; ?>" placeholder="Enter your email" required>
      </div>

      <div class="mb-3">
        <label for="password_1" class="form-label">Password</label>
        <input type="password" name="password_1" class="form-control" id="password_1" placeholder="Enter your password" required>
      </div>

      <div class="mb-3">
        <label for="password_2" class="form-label">Confirm Password</label>
        <input type="password" name="password_2" class="form-control" id="password_2" placeholder="Confirm your password" required>
      </div>

      <div class="d-grid">
        <button type="submit" class="btn btn-primary" name="reg_user">Register</button>
      </div>

      <p class="text-center mt-3">
        Already a member? <a href="login.php">Login</a>
      </p>
    </form>
  </div>

  <!-- Bootstrap JS for functionality -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
