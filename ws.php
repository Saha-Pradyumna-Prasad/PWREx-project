<?php
// ==== DATABASE CONNECTION ====
$conn = new mysqli("localhost", "root", "", "gym_fitness");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ==== ADD NEW WORKOUT ====
if (isset($_POST['submit'])) {
    $day = trim($_POST['day1']);
    $wtype = trim($_POST['wtype']);
    $wtime = trim($_POST['wtime']);
    $wnote = trim($_POST['wnote']);

    if (empty($day) || empty($wtype) || empty($wtime) || empty($wnote)) {
        echo json_encode(['status' => 'error', 'message' => 'Please fill all fields']);
        exit;
    }

    $sql = "INSERT INTO workout_schedule (day_of_week, workout_type, workout_time, W_note)
            VALUES ('$day', '$wtype', '$wtime', '$wnote')";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(['status' => 'success', 'id' => $conn->insert_id]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to insert']);
    }
    exit;
}

// ==== DELETE WORKOUT ====
if (isset($_POST['delete_id'])) {
    $id = $_POST['delete_id'];
    $conn->query("DELETE FROM workout_schedule WHERE id = '$id'");
    echo json_encode(['status' => 'deleted']);
    exit;
}

// ==== FETCH WORKOUTS ====
$result = $conn->query("SELECT * FROM workout_schedule ORDER BY FIELD(day_of_week,
 'Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday')");
$workouts = [];
while ($row = $result->fetch_assoc()) {
    $workouts[] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Workout Schedule</title>
<style>
    * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
    body { background-color: #f0f2f5; }

    /* ===== Navbar ===== */
    nav {
        display: flex; justify-content: space-between; align-items: center;
        background: linear-gradient(90deg, #ff6b6b, #f7b733, #4facfe, #43e97b);
        background-size: 400% 400%; animation: gradientMove 8s infinite alternate;
        padding: 15px 60px; color: white;
    }
    @keyframes gradientMove { 0% {background-position:0% 50%;} 100% {background-position:100% 50%;} }
    nav h1 { font-size: 26px; font-weight: 700; letter-spacing: 1px; }
    nav ul { list-style: none; display: flex; gap: 30px; }
    nav ul li a { text-decoration: none; color: white; font-weight: 600; transition: 0.5s; }
    nav ul li a:hover { color: #000; }

    /* ===== Main Layout ===== */
    .schedule-page { display: flex; flex-wrap: wrap; gap: 30px; max-width: 1300px; margin: 40px auto; padding: 0 20px; }
    .schedule-view { flex: 2; min-width: 350px; }
    .schedule-view h2 {
        font-size: 26px; color: #1f4037; margin-bottom: 20px;
        border-bottom: 3px solid #99f2c8; padding-bottom: 10px; text-transform: uppercase;
    }
    .day-section { background-color: white; border-radius: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        margin-bottom: 20px; padding: 20px; }
    .day-section h3 { font-size: 20px; color: #f7b733; margin-bottom: 10px; border-bottom: 2px solid #eee; padding-bottom: 5px; }
    .workout-entry { padding: 8px 0; border-bottom: 1px dashed #eee; position: relative; }
    .workout-entry:last-child { border-bottom: none; }
    .workout-entry .type { font-weight: 600; color: #1f4037; }
    .workout-entry .time { font-style: italic; color: #333; }
    .workout-entry .notes { margin-top: 5px; font-size: 14px; color: #888; }
    .delete-btn {
        position: absolute; right: 5px; top: 8px; background: #ff4d4d; color: white; border: none;
        padding: 3px 8px; border-radius: 5px; cursor: pointer; font-size: 12px;
    }

    /* ===== Form ===== */
    .add-workout-form {
        flex: 1; min-width: 320px; background-color: white; padding: 25px;
        border-radius: 10px; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }
    .add-workout-form h3 { text-align: center; margin-bottom: 20px; font-size: 20px; color: #1f4037; }
    form { display: flex; flex-direction: column; gap: 12px; }
    label { font-weight: 700; color: #333; text-transform: uppercase; font-size: 13px; }
    input, select, textarea {
        padding: 8px 10px; border-radius: 6px; border: 2px solid #ddd; font-size: 14px; outline: none;
    }
    input:focus, select:focus, textarea:focus { border-color: #1f4037; box-shadow: 0 0 6px rgba(31,64,55,0.2); }
    button {
        padding: 10px; border: none; background-color: #f7b733; color: #1f4037; font-size: 15px;
        font-weight: 700; border-radius: 6px; cursor: pointer; transition: 0.3s; text-transform: uppercase; margin-top: 10px;
    }
    button:hover { background-color: #ffd700; transform: scale(1.03); }

    footer { text-align: center; padding: 20px; background-color: #333; color: #ccc; margin-top: 40px; font-size: 14px; }

    @media (max-width: 768px) {
        nav { flex-direction: column; align-items: flex-start; }
        nav ul { flex-direction: column; width: 100%; }
        .schedule-page { flex-direction: column; align-items: center; }
        .add-workout-form { width: 100%; }
    }
</style>
</head>
<body>

<nav>
    <h1>Workout Tutorials</h1>
    <ul>
        <li><a href="profile1_edit.php">Home</a></li>
        <li><a href="w_personal_record.php">Personal Records</a></li>
        <li><a href="goals.php">Goals</a></li>
        <li><a href="events.php">Events</a></li>
         <li><a href="homepage.php">Logout</a></li>
        
    </ul>
</nav>

<div class="schedule-page">
    <div class="schedule-view">
        <h2>Weekly Workout Schedule</h2>
        <div id="schedule-container"></div>
    </div>

    <div class="add-workout-form">
        <h3>➕ Add New Workout</h3>
        <form id="workoutForm">
            <label for="day">Select Day:</label>
            <select id="day" name="day1" required>
                <option value="">-- Select Day --</option>
                <option>Monday</option><option>Tuesday</option><option>Wednesday</option>
                <option>Thursday</option><option>Friday</option><option>Saturday</option><option>Sunday</option>
            </select>

            <label for="workout">Workout Type:</label>
            <input type="text" name="wtype" id="workout" placeholder="e.g. Legs, Back & Biceps" required>

            <label for="time">Workout Time:</label>
            <input type="time" name="wtime" id="time" required>

            <label for="notes">Notes/Exercises:</label>
            <textarea id="notes" name="wnote" rows="3" placeholder="Add exercises or notes..."></textarea>

            <button type="submit" name="submit">Add Workout</button>
        </form>
    </div>
</div>

<footer>
    <p>© 2025 Workout Tutorials | Stay Fit, Stay Strong 💪</p>
</footer>

<script>
const form = document.getElementById('workoutForm');
const scheduleContainer = document.getElementById('schedule-container');
let workouts = <?php echo json_encode($workouts); ?>;

// === RENDER WORKOUTS ===
function renderSchedule() {
    scheduleContainer.innerHTML = '';
    const grouped = {};

    workouts.forEach(w => {
        if (!grouped[w.day_of_week]) grouped[w.day_of_week] = [];
        grouped[w.day_of_week].push(w);
    });

    for (const day in grouped) {
        const section = document.createElement('div');
        section.className = 'day-section';
        section.innerHTML = `<h3>${day}</h3>`;

        grouped[day].forEach(w => {
            const entry = document.createElement('div');
            entry.className = 'workout-entry';
            entry.innerHTML = `
                <p><span class="type">${w.workout_type}</span> - <span class="time">${w.workout_time}</span></p>
                ${w.W_note ? `<p class="notes">${w.W_note}</p>` : ''}
                <button class="delete-btn" data-id="${w.id}">Delete</button>
            `;
            section.appendChild(entry);
        });

        scheduleContainer.appendChild(section);
    }

    // attach delete listeners
    document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', () => deleteWorkout(btn.dataset.id));
    });
}

// === ADD WORKOUT ===
form.addEventListener('submit', async (e) => {
    e.preventDefault();
    const formData = new FormData(form);
    formData.append('submit', '1');

    const res = await fetch('', { method: 'POST', body: formData });
    const data = await res.json();

    if (data.status === 'success') {
        workouts.push({
            id: data.id,
            day_of_week: formData.get('day1'),
            workout_type: formData.get('wtype'),
            workout_time: formData.get('wtime'),
            W_note: formData.get('wnote')
        });
        renderSchedule();
        form.reset();
    } else {
        alert(data.message || 'Error adding workout');
    }
});

// === DELETE WORKOUT ===
async function deleteWorkout(id) {
    if (!confirm("Delete this workout?")) return;
    const formData = new FormData();
    formData.append('delete_id', id);

    const res = await fetch('', { method: 'POST', body: formData });
    const data = await res.json();

    if (data.status === 'deleted') {
        workouts = workouts.filter(w => w.id != id);
        renderSchedule();
    }
}

// Initial render
renderSchedule();
</script>
</body>
</html>
