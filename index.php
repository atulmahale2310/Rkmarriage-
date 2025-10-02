<?php
session_start();
include 'db.php';
if (!isset($_SESSION['admin_logged_in'])) { header("Location: login.php"); exit(); }
$total = $conn->query("SELECT COUNT(*) AS c FROM bookings")->fetch_assoc()['c'];
$confirmed = $conn->query("SELECT COUNT(*) AS c FROM bookings WHERE status='Confirmed'")->fetch_assoc()['c'];
$cancelled = $conn->query("SELECT COUNT(*) AS c FROM bookings WHERE status='Cancelled'")->fetch_assoc()['c'];
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8"><title>Dashboard</title>
<style>
body{margin:0;font-family:Arial;background:linear-gradient(135deg,#f3e8ff,#fce1ff);color:#222}
header{background:#222;color:#fff;padding:1px 16px;display:flex;justify-content:space-between;align-items:center;height: 50px;}
.logout{background:#e74c3c;color:#fff;padding:8px 12px;border-radius:6px;text-decoration:none}
.wrap{max-width:1100px;margin:28px auto;padding:0 18px;text-align:center}
.stats{display:flex;gap:18px;justify-content:center;flex-wrap:wrap;margin:20px 0 28px}
.card{background:#fff;border-radius:12px;padding:22px 28px;width:240px;box-shadow:0 6px 18px rgba(0,0,0,0.08);text-align:center}
.card h2{margin:0;font-size:36px}
.card.total{border-top:6px solid #007bff}
.card.confirmed{border-top:6px solid #28a745}
.card.cancelled{border-top:6px solid #dc3545}
.actions{text-align:center}
.actions a{display:inline-block;margin:10px;padding:12px 22px;border-radius:8px;text-decoration:none;color:#fff;background:#000;font-weight:700}
footer{text-align:center;margin:30px auto;padding:12px;color:#333}
</style>
</head>
<body>
<header>
  <h1>RK Marriage Hall</h1>
  <a class="logout" href="logout.php">Logout</a>
</header>

<div class="wrap">
  <h2>Welcome, Admin 👋</h2>
  <p>Manage all your bookings easily from here.</p>

  <div class="stats">
    <div class="card total"><h2><?php echo $total; ?></h2><p>Total bookings</p></div>
    <div class="card confirmed"><h2><?php echo $confirmed; ?></h2><p>Confirmed</p></div>
    <div class="card cancelled"><h2><?php echo $cancelled; ?></h2><p>Cancelled</p></div>
  </div>

  <div class="actions">
    <a href="add_booking.php">➕ Add Booking</a>
    <a href="view_bookings.php">📖 View Bookings</a>
  </div>
</div>

<footer>@ <?php echo date("Y"); ?> RK Marriage Hall</footer>
</body>
</html>