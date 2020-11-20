<html>
<head>
	<title>All Transaction</title>
	<style>
		.first {
			padding: 50px; 
			text-align: center;
			color: #FFF8DC;
			text-shadow: 2px 2px #008B8B;
		}

		table.new {
  			table-layout: auto;
  			height: auto;
  			width: 80%; 
  			border-collapse: collapse;
  			text-align: center;

		}

		table,th,td {
		    border: 2px solid black;
		}

		td {
			font-size: 25px;
		}

		thead {
        	background-color: #2F4F4F;
        	color: #ffffff;
        	font-size: 30px;
      	}

		tbody tr:nth-child(odd) {
		    background: #ffffff;
		}
		tbody tr:nth-child(even) {
		    background: #f4f4f4;
		}
	</style>
</head>
<body background="images/cid.jpg">
	<?php include 'header.php' ?>
	<div class="first">
		<h1> All Transactions </h1>
	</div>
	<div align="center">
        <table class="new">
	       <thead>
                <th>Sender</th>
                <th>Reciever</th>
                <th>Amount</th>
	        </thead>
	        <tbody>
        		<?php
        			
            		$conn = mysqli_connect("localhost","root","","transfer") or die("connection failed");

            		$sql=mysqli_query($conn,"SELECT * from transaction");
            		while($result=mysqli_fetch_assoc($sql))
            		{
        		?>
                <tr>
                    <td><?php echo $result['Sender'];?></td>
                    <td><?php echo $result['Receiver'];?></td>
                    <td><?php echo $result['Amount'];?></td>
                </tr> 
        		<?php
        		    }
        		?>
    		</tbody>
</table>
    </div>
    </div>
</body>
</html>

