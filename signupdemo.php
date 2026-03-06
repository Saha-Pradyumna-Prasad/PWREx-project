<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gym Sign Up</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
    }
    .container {
      width: 400px;
      margin: 40px auto;
      background: #fff;
      padding: 25px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.2);
    }
    h1 {
      text-align: center;
      font-family: cursive;
    }
    label {
      display: block;
      margin-top: 10px;
      font-weight: bold;
    }
    input, select, button {
      width: 100%;
      padding: 8px;
      margin-top: 5px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    button {
      background-color: #28a745;
      color: white;
      border: none;
      margin-top: 15px;
      cursor: pointer;
    }
    button:hover {
      background-color: #218838;
    }
  </style>
</head>
<body>
   
  <div class="container">
    <h1>Personal Workout Record - Sign Up</h1>

    <form action="" method="POST">
      <label>Username:</label>
      <input type="text" name="u1" required>

      <label>Full Name:</label>
      <input type="text" name="f1" required>

      <label>Email Address:</label>
      <input type="email" name="e1" required>

      <label>Password:</label>
      <input type="password" name="pa1" required>

      <label>Confirm Password:</label>
      <input type="password" name="pa2" required>

      <label>Gender:</label>
      <select name="gender" required>
        <option value="">-- Select Gender --</option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
        <option value="Other">Other</option>
      </select>

      <label>Date of Birth:</label>
      <input type="date" name="d1" required>

      <label>Height (cm):</label>
      <input type="number" name="h1" required>

      <label>Weight (kg):</label>
      <input type="number" name="w1" required>

      <label>Fitness Goal:</label>
      <select name="go1" required>
        <option value="">-- Select Goal --</option>
        <option value="Weight Loss">Weight Loss</option>
        <option value="Muscle Gain">Muscle Gain</option>
        <option value="Strength Training">Strength Training</option>
        <option value="General Fitness">General Fitness</option>
      </select>

      <button type="submit" name="submit">Sign Up</button>
    </form>

    <?php
    if (isset($_POST['submit'])) {
        // Collect form data
        $user = trim($_POST['u1']);  
        $fullname = trim($_POST['f1']);
        $email = trim($_POST['e1']);
        $password = $_POST['pa1'];
        $confirm_password = $_POST['pa2'];
        $gender = $_POST['gender'];
        $dob = $_POST['d1'];
        $height = $_POST['h1'];
        $weight = $_POST['w1'];
        $ft_goal = $_POST['go1'];

        // Connect to DB
        $conn = new mysqli("localhost", "root", "", "gym_fitness");

        if ($conn->connect_error) {
            die("<script>alert('Database connection failed: ".$conn->connect_error."');</script>");
        }

        // Validate fields
        if (empty($user) || empty($fullname) || empty($email) || empty($password) || empty($confirm_password)
            || empty($gender) || empty($dob) || empty($height) || empty($weight) || empty($ft_goal)) {
            echo "<script>alert('Please fill all the fields.');</script>";
        } elseif ($password != $confirm_password) {
            echo "<script>alert('Passwords do not match.');</script>";
        } else {
            // NOTE: In a real application, you MUST hash the password (e.g., $hash = password_hash($password, PASSWORD_DEFAULT);)
            $hash = password_hash($password, PASSWORD_DEFAULT);
            // SQL insert query
            $sql = "INSERT INTO signup_users (username, full_name, email, passwords, gender, dob, height_cm, weight_kg, fitness_goal)
                    VALUES ('$user', '$fullname', '$email', '$hash', '$gender', '$dob', '$height', '$weight', '$ft_goal')";
                    

            if ($conn->query($sql) === TRUE) {
                // Successful registration redirects to welcome page
                echo "<script>alert('Registration Successful!'); window.location='welcome.php';</script>";
            } else {
                echo "<script>alert('Error: " . $conn->error . "');</script>";
            }
        }

        $conn->close();
    }
    ?>
  </div>
</body>
</html>