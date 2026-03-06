<?php
if (isset($_POST['submit'])) {

    $email = $_POST['e1'];
    $password = $_POST['e2'];

    // DB connection
    $conn = mysqli_connect("localhost","root","","gym_fitness");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // 1. Fetch the user by email
    $sql = "SELECT * FROM signup_users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {

        $user = mysqli_fetch_assoc($result);
        $hashedPassword = $user['passwords'];

        // 2. Verify password
        if (password_verify($password, $hashedPassword)) {

            // 3. LOGIN SUCCESS
            include("profile1_edit.php");
            exit();

        } else {
            echo '<script>alert("Incorrect password!");</script>';
        }

    } else {
        echo '<script>alert("Email not found!");</script>';
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Form with Database</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: "Poppins", sans-serif;
            background-image: url('https://placehold.co/1920x1080/0f172a/fff?text=Gym+Background');
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        section {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.4);
            width: 350px;
            text-align: center;
        }

        h1 {
            font-family: cursive;
            color: #333;
            margin-bottom: 25px;
        }

        form {
            text-align: left;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            background-color: #28a745;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: 0.3s;
        }

        button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
<section>
 <h1>Sign in here and record your best records</h1>

<form action="" method="post">
    <label for="email">Email:</label>
    <input type="text" id="email" name="e1" required><br><br>

    <label for="password">Password:</label>
    <input type="password" id="password" name="e2" required><br><br>

    <button type="submit" name="submit">Submit</button>
</form>
</section>
</body>
</html>