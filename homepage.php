<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Personal Workout Record & Experience</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
  <style>
    /* Reset */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    /* Body */
    body {
      font-family: Arial, sans-serif;
      color: white;
      height: 100vh;
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      transition: background-image 1s ease-in-out;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    /* Main Container */
    .container {
      text-align: center;
      margin-top: 120px;
    }

    h1 {
      font-size: 50px;
      font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
      text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.7);
      margin-bottom: 40px;
    }

    /* Buttons */
    .buttons {
      display: flex;
      justify-content: center;
      gap: 20px;
      margin-bottom: 30px;
    }

    .btn {
      text-decoration: none;
      color: white;
      background-color: #ff4d4d;
      padding: 12px 30px;
      border-radius: 6px;
      font-size: 18px;
      font-weight: bold;
      transition: background 0.8s;
    }

    .btn:hover {
      background-color: #e60000;
    }

    /* Info Section */
    .info-section {
      background: gray;
      display: inline-block;
      padding: 20px 40px;
      border-radius: 10px;
      text-align: left;
      font-family: Verdana, Geneva, Tahoma, sans-serif;
      font-size: 18px;
      line-height: 1.8;
      box-shadow: 0 0 10px rgba(0,0,0,0.6);
    }

    .info-section ul {
      list-style: none;
    }

    .info-section li::before {
      content: "🏋️ ";
    }

    /* Quote Slideshow */
    .quote-slideshow {
      text-align: center;
      font-size: 52px;
      font-family: fantasy;
      /* font-weight: bold; */
      margin: 40px 20px 20px;
      text-shadow: 2px 2px 8px rgba(0,0,0,0.7);
      min-height: 40px;
      animation: fadeIn 1s ease-in-out;
    }

    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }

    /* Footer */
    footer {
      text-align: center;
      padding: 20px;
      background: rgba(0, 0, 0, 0.6);
    }

    .social-icons {
      margin: 10px 0;
    }

    .social-icons a {
      color: white;
      margin: 0 10px;
      font-size: 20px;
      transition: color 0.3s;
    }

    .social-icons a:hover {
      color: #ff4d4d;
    }
  </style>
</head>
<body>

  <div class="container">
    <h1>Personal Workout Record & Experience</h1>

    <div class="buttons">
      <a href="signindemo2.php" class="btn">Sign In</a>
      <a href="signupdemo.php" class="btn">Sign Up</a>
    </div>

    <div class="info-section">
      <ul>
        <li>Log your workouts (sets, reps, weights)</li>
        <li>Save your Personal Records (PRs)</li>
        <li>Add notes or experiences after each session</li>
        <li>View progress over time</li>
        <li>Securely store all your fitness data</li>
      </ul>
      <p style="margin-top: 10px; text-align: center;">Start tracking. Stay consistent. See results. 💪</p>
    </div>
  </div>

  <div class="quote-slideshow" id="quoteText">
    “Sign up today — then push your limits with us.”
  </div>

  <footer>
    <p>Follow Us</p>
    <div class="social-icons">
      <a href="https://www.facebook.com/saha.pradyumna.prasad" target="_blank"><i class="fab fa-facebook-f"></i></a>
      <a href="https://www.instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
      <a href="" target="_blank"><i class="fab fa-whatsapp">01890255384</i></a>
    </div>
    <p>&copy; 2025 Gym Fitness | All Rights Reserved</p>
  </footer>

  <script>
    // Background image rotation
    let images = [
      "https://w0.peakpx.com/wallpaper/609/308/HD-wallpaper-bodybuilding-gym-dumbbells-in-hands-biceps-exercises-dumbbells-fitness.jpg",
      "https://e1.pxfuel.com/desktop-wallpaper/106/774/desktop-wallpaper-barbell.jpg",
      "https://wallpapers-clan.com/wp-content/uploads/2024/09/crossfit-deadlift-power-lifting-desktop-wallpaper-cover.jpg",
      "https://wallpapercave.com/wp/wp10125073.jpg"
    ];

    let i = 0;
    function changeBackground() {
      document.body.style.backgroundImage = `url('${images[i]}')`;
      i = (i + 1) % images.length;
    }
    setInterval(changeBackground, 3000);
    changeBackground();

    // Quote Slideshow
    const quotes = [
      "“Sign up today — then push your limits with us.”",
      "“Every rep counts. Every record tells your story.”",
      "“Start now, track your grind, and grow stronger every day.”",
      "“Your best self starts here — let’s make progress together.”",
      "“Join us and turn your workouts into a legacy.”"
    ];

    let q = 0;
    const quoteText = document.getElementById("quoteText");

    function changeQuote() {
      quoteText.style.opacity = 0;
      setTimeout(() => {
        quoteText.innerText = quotes[q];
        quoteText.style.opacity = 1;
        quoteText.style.animation = "fadeIn 1s ease-in-out";
        q = (q + 1) % quotes.length;
      }, 500);
    }

    setInterval(changeQuote, 4000);
  </script>
</body>
</html>