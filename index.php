<?php
session_start();
require_once 'config/db.php';
include 'includes/header.php';
include 'includes/sidebar.php';
?>

<!-- Top Header Bar -->
<div style="margin-left: 250px; background: #f5f5f5; padding: 15px 20px; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #ccc;">
    <!-- Left: Search -->
    <div style="flex: 1;">
        <input type="text" placeholder="Search..." style="padding: 8px 12px; width: 300px; border: 1px solid #ccc; border-radius: 5px;">
    </div>

    <!-- Right: Notification + Profile -->
    <div style="display: flex; align-items: center; gap: 20px; color: #333;">
        <!-- Notification -->
        <div style="font-size: 20px; position: relative; cursor: pointer;">
            <a href="notification.php" style="color: inherit; text-decoration: none;">
                <i class="fas fa-bell"></i>
            </a>
            <?php
            $notificationCount = 0; // Replace with actual logic
            if ($notificationCount > 0) {
                echo '<span style="position: absolute; top: -5px; right: -10px; background: red; color: white; font-size: 10px; padding: 2px 6px; border-radius: 50%;">' . $notificationCount . '</span>';
            }
            ?>
        </div>

        <!-- Profile -->
        <a href="pages/profile.php" style="display: flex; align-items: center; gap: 8px; cursor: pointer; text-decoration: none; color: blue;">
            <i class="fas fa-user-circle" style="font-size: 22px;"></i>
            <span style="font-weight: 600;">Admin</span>
        </a>
    </div>
</div>

<div class="main-content" style="margin-left: 250px; padding: 20px;">
    <h1>Welcome to HRI TOURS Admin Dashboard</h1>

    <!-- Stats Cards -->
    <div class="stats-cards" style="display: flex; gap: 20px;margin-left:100px; margin-top: 30px;">
    
    <div style="background: #001399; color: white; padding: 10px !important; border-radius: 6px; width: 180px; height: 100px; display: flex; flex-direction: column; justify-content: center; align-items: center; box-sizing: border-box;">
    <h4 style="margin: 0; font-size: 14px;"><i class="fas fa-calendar-check"></i> Total Bookings</h4>
    <p id="totalBookings" style="font-size: 18px; margin: 5px 0 0;">0</p>
</div>



<div style="background: #001399; color: white; padding: 10px !important; border-radius: 6px; width: 180px; height: 100px; display: flex; flex-direction: column; justify-content: center; align-items: center; box-sizing: border-box;">
    <h4 style="margin: 0; font-size: 14px;"><i class="fas fa-users"></i> Total Users</h4>
    <p id="totalUsers" style="font-size: 18px; margin: 5px 0 0;">0</p>
</div>
<div style="background: #001399; color: white; padding: 10px !important; border-radius: 6px; width: 180px; height: 100px; display: flex; flex-direction: column; justify-content: center; align-items: center; box-sizing: border-box;">
    <h4 style="margin: 0; font-size: 14px;"><i class="fas fa-star"></i> Total Reviews</h4>
    <p id="totalReviews" style="font-size: 18px; margin: 5px 0 0;">0</p>
</div>


<div style="background: #001399; color: white; padding: 10px !important; border-radius: 6px; width: 180px; height: 100px; display: flex; flex-direction: column; justify-content: center; align-items: center; box-sizing: border-box;">
    <h4 style="margin: 0; font-size: 14px;"><i class="fas fa-map-marked-alt"></i> Total Tours</h4>
    <p id="totalTours" style="font-size: 18px; margin: 5px 0 0;">18</p>
</div>

</div>
    </div>


    <!-- Activity Tracker Section -->
    <?php
    $query = "SELECT * FROM progress_tracker";
    $result = mysqli_query($conn, $query);
    $progressData = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $progressData[] = $row;
    }
    ?>
    <div style="margin-top: 25px;  max-width: 100%;">
        <div style="background: white; border-radius: 8px; margin-left: 250px;  padding: 12px 15px; box-shadow: 0 0 6px rgba(0,0,0,0.05);">
            <h3 style="margin-bottom: 10px; font-size: 16px;">
                <i class="fas fa-tasks" style="color: #001399;"></i> Activity Tracker
            </h3>
            <ul style="list-style: none; padding: 0; color: #333; font-size: 14px;">
                <?php foreach ($progressData as $activity): ?>
                    <li style="margin-bottom: 8px;">
                        <i class="fas fa-flag-checkered" style="color: #001399;"></i>
                        <?= htmlspecialchars($activity['activity_name']) ?>
                        <div style="width: 100%; background-color: #f5f5f5; border-radius: 5px; margin-top: 5px;">
                            <div style="width: <?= $activity['progress'] ?>%; background-color: #001399; height: 8px; border-radius: 5px;"></div>
                        </div>
                        <span><?= $activity['progress'] ?>% complete</span>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

    <!-- Revenue and Recent Activity Section -->
    <div style="display: flex; gap: 20px; margin-top: 25px;">
        <!-- Revenue -->
        <div style="width: 600px; background: white; border-radius: 8px;  margin-left: 250px; padding: 8px 10px; box-shadow: 0 0 6px rgba(0,0,0,0.05);">
            <h3 style="margin-bottom: 8px; font-size: 16px;">
                <i class="fas fa-chart-line" style="color: #001399;"></i> Revenue
            </h3>
            <canvas id="revenueChart" height="130"></canvas>
        </div>

        <!-- Recent Activity -->
        <div style="flex: 1; background: white; border-radius: 8px; padding: 12px 15px; box-shadow: 0 0 6px rgba(0,0,0,0.05);">
            <h3 style="margin-bottom: 10px; font-size: 18px;"><i class="fas fa-history" style="color: #001399;"></i> Recent Activity</h3>
            <ul style="list-style: none; padding: 0; color: #333; font-size: 14px;">
                <li style="margin-bottom: 8px;"><i class="fas fa-plus-circle" style="color: green;"></i> New booking created</li>
                <li style="margin-bottom: 8px;"><i class="fas fa-edit" style="color: #ffa500;"></i> Tour package updated</li>
                <li style="margin-bottom: 8px;"><i class="fas fa-user-plus" style="color: #007bff;"></i> New user registered</li>
                <li style="margin-bottom: 8px;"><i class="fas fa-times-circle" style="color: red;"></i> Booking cancelled</li>
            </ul>
        </div>
    </div>
</div>

<!-- Chart.js Script -->
<script>
    const ctx = document.getElementById('revenueChart').getContext('2d');
    const revenueChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
            datasets: [{
                label: 'Monthly Revenue',
                data: [1200, 1900, 3000, 2500, 3200, 4000],
                borderColor: '#001399',
                backgroundColor: 'rgba(0, 19, 153, 0.1)',
                tension: 0.4,
                fill: true,
                pointBackgroundColor: '#001399',
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });

    // Fetch stats using AJAX
    function fetchStats() {
        fetch('data.php')
            .then(response => response.json())
            .then(data => {
                document.getElementById('totalBookings').textContent = data.totalBookings;
                document.getElementById('totalUsers').textContent = data.totalUsers;
                document.getElementById('totalTours').textContent = data.totalTours;
            })
            .catch(error => console.log('Error fetching data:', error));
    }
    setInterval(fetchStats, 5000);
</script>

<?php include 'includes/footer.php'; ?>
