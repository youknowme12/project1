<?php
include 'header.php';
$conn = mysqli_connect("localhost","root","","transfer") or die("connection failed");

$sid = (isset($_GET['cid']) ? $_GET['cid'] : '');

$sql = ("SELECT * FROM customer WHERE cid = '$sid'");
$squery = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($squery);


if(isset($_POST['submits']))
{
  $reciever=$_POST['reciever'];
  $amount=$_POST['amount'];
  $sender=(isset($_GET['cid']) ? $_GET['cid'] : '');


  $sql="SELECT * FROM customer WHERE cid = $sender";
  $squery=mysqli_query($conn, $sql) or die("unsuccessfull");
  $sdata= mysqli_fetch_array($squery, MYSQLI_ASSOC);

  $sql="SELECT * FROM customer WHERE cid = $reciever";
  $squery=mysqli_query($conn, $sql) or die("unsuccessfull");
  $sdata1 = mysqli_fetch_array($squery);

  if ($amount > $sdata['balance']) {
  	echo '<script type="text/javascript">';
    echo ' alert("Insufficient Balance")'; 
    echo '</script>';
  }
  else {

  	$newbalance = $sdata['balance'] - $amount;
  	$sql = "UPDATE customer SET balance ='$newbalance' WHERE cid = '$sender'";
  	mysqli_query($conn, $sql);

  	$newbalance = $sdata1['balance'] + $amount;
  	$sql ="UPDATE customer SET balance ='$newbalance' WHERE cid ='$reciever'";
  	mysqli_query($conn, $sql);

  	$senders = $sdata['cname'];
  	$recievers = $sdata1['cname'];
  	$sql = "INSERT INTO `transaction`(`Sender`, `Receiver`, `Amount`) VALUES ('$senders','$recievers','$amount')";
  	$ans = mysqli_query($conn, $sql);

  	if ($ans) {
  		echo "<script type='text/javascript'>
        alert('Transaction Successful.');
        window.location='customer.php';
        </script>";
  	}
  	$newbalance = 0;
  	$amount = 0;

  }

}
?>

<html>
<head>
	<title>Transfer</title>
<link rel="stylesheet" type="text/css" href="css style/style2.css">
</head>
<body background="images/cid.jpg">
<div class="Money">
	
		Money Transfer

</div>


<form method="POST">
	<div align="center" style="color: white;">
		<h3> <?php echo ("ID : " . $data['cid'] ); ?> </h3> <br>
		<h3> <?php echo ("Name : " . $data['cname'] ); ?> </h3> <br>
		<h3> <?php echo ("Account No. : " . $data['caccount'] ); ?> </h3> <br>
		<h3> <?php echo ("Current Balance : " . $data['balance'] ); ?> </h3> <br>
	</div>
</form>

	 <div style="margin-top:20px">
	<form method="POST">
			<div align="center">
				<label style="color: white; font-size: 20px">Select Reciever : </label>
				<Select name="reciever">
				<option value="" disabled selected> </option>
                <?php
                    $sid=$_GET['cid'];
                    $sql = "SELECT * FROM customer where cid!=$sid";
                    $squery=mysqli_query($conn, $sql);
                    if(!$squery)
                    {
                        echo "Error ".$sql."<br/>".mysqli_error($conn);
                    }
                    while($rows = mysqli_fetch_array($squery)) {
                    ?>
                    <option value="<?php echo $rows['cid'];?>" >

                        <?php echo $rows['cname'] ;?>

                    </option>
                <?php
                   }
                ?>
			</Select>
			</div>
			<br>
			<div align="center" class="amount">
			<label align="center" style="color: white; font-size: 20px">Enter Amount : </label>
			<input type="number" name="amount" required="required">
			</div>
			<br>
			<div align="center">
				<button type="submit" name="submits" class="btn btn-success">Submit</button>
			</div>

</form>
</div>
</body>
</html>