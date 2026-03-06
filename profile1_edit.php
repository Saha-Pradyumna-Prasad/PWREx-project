<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Workout Tutorials Home</title>
<style>
    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }

    body {
        background-color: white;
    }

    /* ===== Navbar ===== */
    nav {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: linear-gradient(90deg, #ff6b6b, #f7b733, #4facfe, #43e97b);
        background-size: 400% 400%;
        animation: gradientMove 8s infinite alternate;
        padding: 15px 60px;
        color: white;
    }

    @keyframes gradientMove {
        0% { background-position: 0% 50%; }
        100% { background-position: 100% 50%; }
    }

    nav h1 {
        font-size: 26px;
        font-weight: 700;
        letter-spacing: 1px;
    }

    nav ul {
        list-style: none;
        display: flex;
        gap: 30px;
    }

    nav ul li a {
        text-decoration: none;
        color: white;
        font-weight: 600;
        transition: 0.5s;
    }

    nav ul li a:hover {
        color: #000;
    }

    /* ===== Hero Section (Slideshow) ===== */
    .hero {
        width: 100%;
        height: 400px;
        position: relative;
        overflow: hidden;
    }

    .slides {
        width: 100%;
        height: 100%;
        display: none;
        object-fit: cover;
    }

    .active {
        display: block;
        animation: fade 1s;
    }

    @keyframes fade {
        from {opacity: 0.3;}
        to {opacity: 1;}
    }

    /* ===== Tutorial Cards ===== */
    .tutorials {
        padding: 60px;
        text-align: center;
    }

    .tutorials h2 {
        margin-bottom: 30px;
        font-size: 28px;
        color: #333;
    }

    .card-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 25px;
    }

    .card {
        width: 250px;
        height: 200px;
        background-color: #f0f0f0;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        overflow: hidden;
        position: relative;
        cursor: pointer;
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0,0,0,0.2);
    }

    .card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: 0.4s ease;
    }

    .card:hover img {
        filter: brightness(70%);
    }

    .card h3 {
        position: absolute;
        bottom: 15px;
        left: 20px;
        color: white;
        font-size: 20px;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.6);
    }

    /* ===== Footer ===== */
    footer {
        text-align: center;
        padding: 20px;
        background-color: #f3f3f3;
        color: #555;
        margin-top: 40px;
    }

</style>
</head>
<body>

<!-- ===== Navbar ===== -->
<nav>
    <h1>Workout Tutorials</h1>
    <ul>
         <li><a href="ws.php">Workout Schedule</a></li>
        <li><a href="w_personal_record.php">Personal Records</a></li>
        <li><a href="goals.php">Goals</a></li>
        <li><a href="events.php">Events</a></li>
        <li><a href="homepage.php">Logout</a></li>
        
    </ul> 
</nav>

<!-- ===== Hero Section ===== -->
<div class="hero">
    <img class="slides active" src="hero1.gif" alt="Workout 1">
    <img class="slides" src="hero2.jpeg" alt="Workout 2">
    <img class="slides" src="hero3.jpeg" alt="Workout 3">
    <img class="slides" src="hero4.jpeg" alt="Workout 4">
    <img class="slides" src="hero5.jpeg" alt="Workout 5">
</div>

<!-- ===== Tutorials Section ===== -->
<section class="tutorials">
    <h2>Workout Tutorials</h2>
    <div class="card-container">
        <div class="card" onclick="openVideo('https://www.youtube.com/watch?v=UItWltVZZmE')">
            <img src="https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?auto=format&fit=crop&w=800&q=80" alt="">
            <h3>Full Body Workout</h3>
        </div>
        <div class="card" onclick="openVideo('https://www.youtube.com/watch?v=ml6cT4AZdqI')">
            <img src="https://images.unsplash.com/photo-1605296867304-46d5465a13f1?auto=format&fit=crop&w=800&q=80" alt="">
            <h3>Home Cardio</h3>
        </div>
        <div class="card" onclick="openVideo('https://www.youtube.com/watch?v=8PwoytUU06g&t=1s')">
            <img src="https://images.unsplash.com/photo-1558611848-73f7eb4001a1?auto=format&fit=crop&w=800&q=80" alt="">
            <h3>Abs Workout</h3>
        </div>
        <div class="card" onclick="openVideo('https://www.youtube.com/watch?v=EsxpZcApZDs')">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ7-ODJm9GUFDgw5hckDSejgHZirtLYlXw9eA&s" alt="">
            <h3>Leg Workout</h3>
        </div>
        <div class="card" onclick="openVideo('https://www.youtube.com/watch?v=xcMOYrdHrkE')">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTukUe2b_4EuOEN8B1SfFlhDm1F_NP_N8huFg&s" alt="">
            <h3>Yoga & Stretch</h3>
        </div>

        <div class="card" onclick="openVideo('https://www.youtube.com/watch?v=nzwU9RR6l2w')">
            <img src="https://static.vecteezy.com/system/resources/thumbnails/031/713/720/small/muscle-arms-strong-biceps-isolated-on-white-background-vector.jpg" alt="">
            <h3>Arms(Dumbles)</h3>
         </div>
         <div class="card" onclick="openVideo('https://www.youtube.com/watch?v=TDtemhu9PjA')">
            <img src="https://png.pngtree.com/png-vector/20220610/ourmid/pngtree-human-chest-icon-in-cartoon-style-on-a-white-background-png-image_4868527.png" alt="">
            <h3>Chest(Dumbles)</h3>
        </div>

        <div class="card" onclick="openVideo('https://www.youtube.com/watch?v=ptc6PhnXAxI')">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTJ-U55zJIXqmJ2MphRJskDEKBil5IFftBPwg&s" alt="">
            <h3>Back(Dumbles)</h3>
        </div>
        <div class="card" onclick="openVideo('https://www.youtube.com/shorts/sKXqNO2KQp8')">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSe76Mrjx1SN0yQa5C5T2aWM49INZpilVDfaw&s" alt="">
            <h3>Forarms(Dumbles)</h3>
        </div>
</section>

<!-- ===== Footer ===== -->
<footer>
    <p>© 2025 Workout Tutorials | Stay Fit, Stay Strong 💪</p>
</footer>

<!-- ===== JavaScript ===== -->
<script>
    // Slideshow
    let slideIndex = 0;
    const slides = document.querySelectorAll(".slides");

    function showSlides() {
        slides.forEach(slide => slide.classList.remove("active"));
        slideIndex = (slideIndex + 1) % slides.length;
        slides[slideIndex].classList.add("active");
    }

    setInterval(showSlides, 3000); // Change every 3 seconds

    // Open YouTube video
    function openVideo(url) {
        window.open(url, "_blank");
    }
</script>

</body>
</html>
