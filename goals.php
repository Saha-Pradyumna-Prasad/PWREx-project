<?php

$conn = new mysqli("localhost", "root", "", "gym_fitness");
if ($conn->connect_error) {
   
    die("Connection failed: " . $conn->connect_error);
}


if (isset($_POST['submit'])) {
     
    $day = trim($_POST['day']); 
    $wtype =  trim($_POST['wtype']);
    $wweight =  trim($_POST['wweight']);
    $wnumber = trim($_POST['wnumber']); 
    $wtime = trim($_POST['wtime']); 
    $wnote = trim($_POST['wnote']); 

   
    if (empty($day) || empty($wtype) || empty($wweight) || empty($wnumber) || empty($wtime) || 
    empty($wnote)) {
        echo json_encode(['status' => 'error', 'message' => 'Please fill all fields']);
        exit;
    }
   
    $sql = "INSERT INTO pr_goals (day_of_week, exercise_name, target_weight_kg, target_reps, deadline, status)
             VALUES ('$day', '$wtype', '$wweight', '$wnumber', '$wtime', '$wnote')";

    if ($conn->query($sql) === TRUE) {
         echo json_encode(['status' => 'success', 'pr_id' => $conn->insert_id, 'day_of_week' => $day]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Failed to insert: ' . $conn->error]);
    }
    exit;
}


if (isset($_POST['delete_id'])) {
    $id = mysqli_real_escape_string($conn, $_POST['delete_id']);
    
    $conn->query("DELETE FROM pr_goals WHERE pr_id = '$id'"); 
    echo json_encode(['status' => 'deleted']);
    exit;
}


$sql_fetch = "SELECT * FROM pr_goals ORDER BY FIELD(day_of_week,
 'Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday')";
 
$result = $conn->query($sql_fetch);

$workouts = [];


if ($result === FALSE) {
    // If the error persists, it likely means the table 'pr_goals' or column 'day_of_week' does not exist.
    error_log("Database Error: " . $conn->error . " | Query: " . $sql_fetch);
} else {
    // If successful, fetch data
    while ($row = $result->fetch_assoc()) {
        $workouts[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Goals</title>
<style>
    /* CSS is unchanged from previous correct versions */
    * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
    body { background-color: #f0f2f5; }

    /* ===== Navbar ===== */
    nav {
        display: flex; justify-content: space-between; align-items: center;
        background: linear-gradient(90deg, #ff6b6b, #f7b733, #4facfe, #43e97b);
        background-size: 400% 400%; animation: gradientMove 8s infinite alternate;
        padding: 15px 60px; color: white; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
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
    
    .workout-entry { 
        padding: 8px 0; border-bottom: 1px dashed #eee; position: relative; 
        display: flex; flex-direction: column;
    }
    .workout-entry:last-child { border-bottom: none; }
    
    .entry-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .workout-entry .type { font-weight: 600; color: #1f4037; }
    .workout-entry .weight { font-style: italic; color: #333; margin-left: 10px; }
    .workout-entry .time { font-style: italic; color: #333; }
    .workout-entry .notes { margin-top: 5px; font-size: 14px; color: #888; }

    .delete-btn {
        background: #ff4d4d; color: white; border: none;
        padding: 3px 8px; border-radius: 5px; cursor: pointer; font-size: 12px;
        margin-left: 10px;
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
    <h1>Personal Records</h1>
    <ul>
        <li><a href="profile1_edit.php">Home</a></li>
        <li><a href="ws.php">Workout SChedule</a></li>
        <li><a href="w_personal_record.php">Personal Records</a></li>
        <li><a href="events.php">Events</a></li>
        <li><a href="homepage.php">Logout</a></li>
        
    </ul>
</nav>

<div class="schedule-page">
    <div class="schedule-view">
        <h2>Save Your Future Max PRs</h2>
        <div id="schedule-container"></div>
    </div>

    <div class="add-workout-form">
        <h3>➕ Add Future PR Workout</h3>
        <form id="workoutForm">
            <label for="day">Select PRs Day:</label>
            <select id="day" name="day" required>
                <option value="">-- Select Day --</option>
                <option>Monday</option><option>Tuesday</option><option>Wednesday</option>
                <option>Thursday</option><option>Friday</option><option>Saturday</option><option>Sunday</option>
            </select>

            <label for="workout">Workout Name:</label>
            <input type="text" name="wtype" id="workout" placeholder="e.g. Squat" required>

            <label for="weight"> Weight goal (kg):</label>
            <input type="number" name="wweight" id="weight" required>

            <label for="reps">Reps:</label>
            <input type="number" name="wnumber" id="reps" required>

            <label for="time">Deadline Time:</label>
            <input type="time" name="wtime" id="time" required>

            <label for="notes">Status/Notes:</label>
            <textarea id="notes" name="wnote" rows="3" placeholder="e.g. Needs new belt, feel good, etc."></textarea>

            <button type="submit" name="submit">Save Plan</button>
        </form>
    </div>
</div>

<footer>
    <p>© 2025 Workout Tutorials | Stay Fit, Stay Strong 💪</p>
</footer>

<script>
const form = document.getElementById('workoutForm');
const scheduleContainer = document.getElementById('schedule-container');

// PHP outputs JSON directly into this JS variable
let workouts = <?php echo json_encode($workouts, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP); ?>;

// === RENDER WORKOUTS ===
function renderSchedule() {
    scheduleContainer.innerHTML = '';
    const grouped = {};

    // Group workouts by day_of_week
    workouts.forEach(w => {
        // Use 'day_of_week' for grouping
        if (!w.day_of_week) w.day_of_week = 'Unsorted'; 
        if (!grouped[w.day_of_week]) grouped[w.day_of_week] = [];
        grouped[w.day_of_week].push(w);
    });

    for (const day in grouped) {
        const section = document.createElement('div');
        section.className = 'day-section';
        const dayEmoji = (day.toLowerCase().includes('rest') || day.toLowerCase().includes('sunday')) ? '🧘' : '💪'; 
        section.innerHTML = `<h3>${day} ${dayEmoji}</h3>`;

        grouped[day].forEach(w => {
            const entry = document.createElement('div');
            entry.className = 'workout-entry';
            
            // FIX: Updated rendering logic to use the new column names from pr_goals
            // exercise_name, target_weight_kg, target_reps, deadline (time), status (note)
            entry.innerHTML = `
                <div class="entry-header">
                    <p>
                        <span class="type">${w.exercise_name || 'N/A'}</span> 
                        <span class="weight">| Goal: <strong>${w.target_weight_kg || 'N/A'}kg</strong> for <strong>${w.target_reps || 'N/A'} Reps</strong></span> 
                        <span class="time">| By: ${w.deadline || 'N/A'}</span>
                    </p>
                    <button class="delete-btn" data-id="${w.pr_id}">Delete</button>
                </div>
                ${w.status ? `<p class="notes">Status: ${w.status}</p>` : ''}
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

// === ADD WORKOUT (Uses AJAX to talk to PHP) ===
form.addEventListener('submit', async (e) => {
    e.preventDefault();
    
    const formData = new FormData(form);
    formData.append('submit', '1'); 

    const res = await fetch('', { method: 'POST', body: formData });
    
    const text = await res.text();
    let data;
    try {
        data = JSON.parse(text);
    } catch (error) {
        console.error('Invalid JSON response:', text);
        alert('An unexpected server error occurred. Please check the console for details.');
        return;
    }

    if (data.status === 'success') {
        // FIX: Update local array structure to match the new pr_goals column names
        workouts.push({
            pr_id: data.pr_id,
            day_of_week: data.day_of_week, 
            exercise_name: formData.get('wtype'),
            target_weight_kg: formData.get('wweight'),
            target_reps: formData.get('wnumber'),
            deadline: formData.get('wtime'),
            status: formData.get('wnote')
        });
        
        renderSchedule();
        form.reset();
    } else {
        alert(data.message || 'Error adding workout');
    }
});

// === DELETE WORKOUT (Uses AJAX to talk to PHP) ===
async function deleteWorkout(id) {
    if (!confirm("Are you sure you want to delete this Personal Record Goal?")) return;
    
    const formData = new FormData();
    formData.append('delete_id', id); 

    const res = await fetch('', { method: 'POST', body: formData });
    const data = await res.json();

    if (data.status === 'deleted') {
        // Filter out the deleted workout from the local array
        workouts = workouts.filter(w => w.pr_id != id);
        renderSchedule();
    } else {
        alert('Failed to delete record.');
    }
}

// Initial render of existing workouts
renderSchedule();
</script>
</body>
</html>