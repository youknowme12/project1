<!DOCTYPE html>
<html>
<head>
	<title>Customers</title>
<link rel="stylesheet" type="text/css" href="css style/style1.css">
</head>
<body background="images/cid.jpg">
<?php include 'header.php'; ?>
<div id="main">
	<h1 class="first"> Customer List </h1>
	<?php
	  $conn = mysqli_connect("localhost","root","","transfer") or die("connection failed");

	  $sql = "SELECT * FROM customer ; ";
	  $result = mysqli_query($conn, $sql) or die("query unsucessfull");

	  if(mysqli_num_rows($result) > 0) {
	?>
	<table class = "a" >
		<thead>
			<th>cid</th>
			<th>Customer Name</th>
			<th>Account No</th>
			<th>Phone No</th>
			<th>Email Address</th>
			<th>Balance</th>
			<th>Transaction</th>
		</thead>
		<tbody>
			<?php
			  while ($row = mysqli_fetch_assoc($result)) {
			  	$id = $row['cid']
			?>
			<tr>
				<td><?php echo $row['cid']; ?></td>
				<td><?php echo $row['cname']; ?></td>
				<td><?php echo $row['caccount']; ?></td>
				<td><?php echo $row['phone']; ?></td>
				<td><?php echo $row['emailaddress']; ?></td>
				<td><?php echo $row['balance']; ?></td>
				<td><a href="transfer.php?cid=<?php echo $id ?>">Transfer</a></td>
			</tr>
		<?php } ?>
		</tbody>
	</table>
<?php } ?>
</div>
</body>
</html>