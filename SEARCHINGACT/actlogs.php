<?php  
require_once 'core/models.php'; 
require_once 'core/handleforms.php'; 

if (!isset($_SESSION['username'])) {
	header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Activity Logs</title>
	<link rel="stylesheet" href="styles/styles.css">
	<style>
		body {
			font-family: Arial, sans-serif;
			margin: 0;
			padding: 20px;
			background-color: #f4f4f9;
		}
		h1 {
			color: green;
			text-align: center;
			background-color: #e9f9e9;
			border: 1px solid #c3e6c3;
			padding: 10px;
			margin-bottom: 20px;
		}
		/* FOR BUTTON LITTLE ANIMATION */
		.buttonContainer {
			text-align: center;
			margin-bottom: 20px;
		}
		.btn {
			display: inline-block;
			padding: 10px 20px;
			font-size: 16px;
			font-weight: bold;
			text-decoration: none;
			color: #fff;
			background-color: #007bff;
			border: none;
			border-radius: 4px;
			box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
			transition: background-color 0.3s ease, transform 0.2s ease;
		}
		.btn:hover {
			background-color: #0056b3;
			transform: scale(1.05);
			text-decoration: none;
		}
		.btn:active {
			background-color: #004085;
			transform: scale(1);
		}
		table {
			width: 100%;
			border-collapse: collapse;
			margin-top: 20px;
			background-color: #fff;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
		}
		th, td {
			padding: 12px;
			text-align: left;
			border-bottom: 1px solid #ddd;
		}
		th {
			background-color: #f8f9fa;
			color: #333;
		}
		tr:nth-child(even) {
			background-color: #f2f2f2;
		}
		tr:hover {
			background-color: #e9ecef;
		}
	</style>
</head>
<body>
	<h1>Activity Logs</h1>
	<div class="buttonContainer">
		<a href="index.php" class="btn">Go Back to Homepage</a>
	</div>
	<div class="tableClass">
		<table>
			<tr>
				<th>Activity Log ID</th>
				<th>Username</th>
				<th>Action</th>
				<th>Details</th>
				<th>Date Added</th>
			</tr>
			<?php $getAllActivityLogs = getAllActivityLogs($pdo); ?>
			<?php foreach ($getAllActivityLogs as $row) { ?>
			<tr>
				<td><?php echo $row['log_id']; ?></td>
				<td><?php echo $row['username']; ?></td>
				<td><?php echo $row['action']; ?></td>
				<td><?php echo $row['details']; ?></td>
				<td><?php echo $row['timestamp']; ?></td>
			</tr>
			<?php } ?>
		</table>
	</div>
</body>
</html>
