<?php
include 'db.php'; session_start();
if (!isset($_SESSION['admin_logged_in'])) { header("Location: login.php"); exit(); }
if (isset($_GET['cancel_id'])) {
 $id=intval($_GET['cancel_id']); $conn->query("UPDATE bookings SET status='Cancelled' WHERE id=$id");
 echo "<script>alert('Booking cancelled!');window.location='view_bookings.php';</script>";
}
?>
<!DOCTYPE html><html><head><meta charset="utf-8"><title>View Bookings</title>
<style>
body{margin:0;font-family:Arial;background:linear-gradient(135deg,#f3e8ff,#fce1ff);color:#222}
header{background:#222;color:#fff;padding:1px 16px;display:flex;justify-content:space-between;align-items:center;height:50px}
.logout{background:#e74c3c;color:#fff;padding:8px 12px;border-radius:6px;text-decoration:none}
.page{max-width:1100px;margin:20px auto;padding:0 18px}
.page-header{display:flex;justify-content:space-between;align-items:center;margin:18px 0}
.home-btn{padding:6px 14px;background:#007bff;color:#fff;text-decoration:none;border-radius:6px}
table{width:100%;border-collapse:collapse;background:#fff;border-radius:6px;overflow:hidden;box-shadow:0 6px 18px rgba(0,0,0,0.08)}
th,td{padding:12px;border-bottom:1px solid #eee;text-align:center}
th{background:#222;color:#fff}
tr:nth-child(even){background:#fafafa}
.cancel-btn{background:#e74c3c;color:#fff;padding:6px 10px;border-radius:6px;text-decoration:none}
footer{text-align:center;margin:30px auto;padding:12px;color:#333}
</style></head><body>
<header><h1>RK Marriage Hall</h1><a class="logout" href="logout.php">Logout</a></header>
<div class="page"><div class="page-header"><h2>All Bookings</h2><a class="home-btn" href="index.php">Home</a></div>
<table>
<tr><th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Hall</th><th>Date</th><th>From</th><th>To</th><th>Payment</th><th>Status</th><th>Action</th></tr>
<?php
$res=$conn->query("SELECT * FROM bookings ORDER BY date, from_time");
if($res && $res->num_rows>0){ while($row=$res->fetch_assoc()){
 $from=date("H:i", strtotime($row['from_time']));
 $to=date("H:i", strtotime($row['to_time']));
 echo "<tr><td>{$row['id']}</td><td>".htmlspecialchars($row['customer_name'])."</td><td>".htmlspecialchars($row['email'])."</td><td>".htmlspecialchars($row['phone'])."</td><td>{$row['hall_type']}</td><td>{$row['date']}</td><td>$from</td><td>$to</td><td>{$row['payment']}</td><td>{$row['status']}</td><td>";
 if($row['status']!='Cancelled'){echo "<a class='cancel-btn' href='?cancel_id={$row['id']}'>Cancel</a>";} else {echo "-";}
 echo "</td></tr>";
}} else {echo "<tr><td colspan='11'>No bookings found</td></tr>";}
?>
</table></div>
<footer>@<?php echo date("Y"); ?> RK Marriage Hall</footer>
</body></html>