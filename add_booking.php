<?php
include 'db.php'; session_start();
if (!isset($_SESSION['admin_logged_in'])) { header("Location: login.php"); exit(); }
if ($_SERVER['REQUEST_METHOD']=='POST') {
 $customer_name=$_POST['customer_name']; $email=$_POST['email']; $phone=$_POST['phone'];
 $hall_type=$_POST['hall_type']; $date=$_POST['date'];
 $from_time=$_POST['from_time'].":00"; $to_time=$_POST['to_time'].":00";
 $payment=$_POST['payment'];
 $chk=$conn->prepare("SELECT * FROM bookings WHERE hall_type=? AND date=? AND status!='Cancelled' AND (from_time < ? AND to_time > ?)");
 $chk->bind_param("ssss",$hall_type,$date,$to_time,$from_time); $chk->execute(); $res=$chk->get_result();
 if ($res->num_rows>0) { echo "<script>alert('❌ Already booked!');window.location='add_booking.php';</script>"; }
 else {
  $ins=$conn->prepare("INSERT INTO bookings (customer_name,email,phone,hall_type,date,from_time,to_time,payment,status) VALUES (?,?,?,?,?,?,?,?, 'Confirmed')");
  $ins->bind_param("ssssssss",$customer_name,$email,$phone,$hall_type,$date,$from_time,$to_time,$payment);
  if($ins->execute()){echo "<script>alert('✅ Booking added successfully!');window.location='view_bookings.php';</script>";}
  else{echo "<script>alert('⚠️ Error!');window.location='add_booking.php';</script>";}
 }
}
?>
<!DOCTYPE html><html><head><meta charset="utf-8"><title>Add Booking</title>
<style>
body{margin:0;font-family:Arial;background:linear-gradient(135deg,#f3e8ff,#fce1ff);color:#222}
header{background:#222;color:#fff;padding:1px 16px;display:flex;justify-content:space-between;align-items:center;height:50px}
.logout{background:#e74c3c;color:#fff;padding:8px 12px;border-radius:6px;text-decoration:none}
.form-box{background:#fff;padding:30px;margin:30px auto;width:650px;border-radius:10px;box-shadow:0 6px 18px rgba(0,0,0,0.08)}
.form-box h2{display:flex;justify-content:space-between;align-items:center;margin:0 0 20px}
.home-btn{padding:6px 14px;background:#007bff;color:#fff;text-decoration:none;border-radius:6px}
.form-box label{font-weight:700;display:block;margin-top:10px;text-align:left}
.form-box input,.form-box select{padding:5px;margin:5px 0 5px 0;border:1px solid #ccc;border-radius:6px;width:100%}
.row{display:flex;gap:10px}
.row input{flex:1}
.form-box button{padding:10px 20px;background:#000;color:#fff;border:none;border-radius:6px;cursor:pointer}
footer{text-align:center;margin:30px auto;padding:12px;color:#333}
</style></head><body>
<header><h1>RK Marriage Hall</h1><a class="logout" href="logout.php">Logout</a></header>
<form method="POST" class="form-box">
<h2>Add Booking <a class="home-btn" href="index.php">Home</a></h2>
<label>Customer Name</label><input type="text" name="customer_name" required>
<label>Email</label><input type="email" name="email" required>
<label>Phone</label><input type="text" name="phone" required>
<label>Hall Type</label><select name="hall_type" required>
<option value="">Select Hall Type</option><option>Banquet</option><option>Mini Hall</option><option>Open Ground</option>
</select>
<label>Date / Time</label>
<div class="row">
<input type="date" name="date" required>
<input type="time" name="from_time" required>
<input type="time" name="to_time" required>
</div>
<label>Payment Status</label><select name="payment" required>
<option value="Advance">Advance</option><option value="Full">Full</option>
</select>
<button type="submit">Save Booking</button>
</form>
<footer>@ <?php echo date("Y"); ?> RK Marriage Hall</footer>
</body></html>