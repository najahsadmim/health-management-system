<?php

include "../config.php";


$sql = "SELECT * FROM Doctor";

$result = $conn->query($sql);

?>


<!DOCTYPE html>
<html>

<head>

<title>Find Doctors</title>


<style>

body{
    font-family:Arial;
    background:#f3fffc;
    padding:30px;
}


.card{

background:white;
padding:20px;
margin:20px;
border-radius:15px;
box-shadow:0 5px 15px #ddd;

}


h1{
color:#009f8b;
}


button{

background:#009f8b;
color:white;
border:none;
padding:10px 20px;
border-radius:10px;

}

</style>

</head>


<body>


<h1>
Find Doctors
</h1>


<?php

while($doctor = $result->fetch_assoc())
{

?>


<div class="card">

<h2>
Dr. <?php echo $doctor['FullName']; ?>
</h2>


<p>
Specialization:
<?php echo $doctor['Specialization']; ?>
</p>


<p>
Qualification:
<?php echo $doctor['Qualification']; ?>
</p>


<p>
Experience:
<?php echo $doctor['Experience']; ?> years
</p>


<p>
Location:
<?php echo $doctor['Location']; ?>
</p>


<p>
Consultation Fee:
৳<?php echo $doctor['ConsultationFee']; ?>
</p>


<p>
Available Time:
<?php echo $doctor['AvailableTime']; ?>
</p>


<button>
Book Appointment
</button>


</div>


<?php

}

?>


</body>

</html>