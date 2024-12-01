<?php 
require_once 'core/dbconfig.php'; 
require_once 'core/models.php'; 

if (!isset($_SESSION['username'])) {
	header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Applicants Data</title>
	<link rel="stylesheet" href="styles.css">
	<script src="https://code.jquery.com/jquery-3.7.1.min.js" 
	        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" 
	        crossorigin="anonymous"></script>
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
		form {
			margin-bottom: 20px;
			text-align: center;
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

		/* FOR BUTTONS LITTLE ANIMATION */
		.controls a, .action-links a {
			display: inline-block;
			padding: 8px 15px;
			font-size: 14px;
			font-weight: bold;
			text-decoration: none;
			color: #fff;
			background-color: #007bff;
			border: none;
			border-radius: 4px;
			box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
			transition: background-color 0.3s ease, transform 0.2s ease;
			margin-right: 5px;
		}
		.controls a:hover, .action-links a:hover {
			background-color: #0056b3;
			transform: scale(1.05);
			text-decoration: none;
		}
		.controls a:active, .action-links a:active {
			background-color: #004085;
			transform: scale(1);
		}

		/* FOR CONTROLS BUTTON LITTLE ANIMATION*/
		input[type="text"], input[type="submit"] {
			padding: 8px 10px;
			font-size: 14px;
			margin: 5px;
		}
		input[type="submit"] {
			background-color: #007bff;
			color: #fff;
			border: none;
			border-radius: 4px;
			cursor: pointer;
			transition: background-color 0.3s ease, transform 0.2s ease;
		}
		input[type="submit"]:hover {
			background-color: #0056b3;
			transform: scale(1.05);
		}
		input[type="submit"]:active {
			background-color: #004085;
			transform: scale(1);
		}
	</style>
</head>
<body>
	<?php if (isset($_SESSION['message'])): ?>
		<h1>
			<?php echo $_SESSION['message']; ?>
		</h1>
		<?php unset($_SESSION['message']); ?>
	<?php endif; ?>

	<div class="controls">
		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="GET">
			<input type="text" name="searchInput" placeholder="Search here">
			<input type="submit" name="searchBtn" value="Search">
		</form>
		<p>
			<a href="index.php">Clear Search Query</a>
			<a href="insert.php">Insert New User</a>
			<a href="actlogs.php">View Activity Logs Here</a>
			<a href="core/handleforms.php?logoutAUser=1">Logout</a>
		</p>
	</div>

	<table>
		<thead>
			<tr>
			    <th>Applicant ID</th>
				<th>First Name</th>
				<th>Last Name</th>
				<th>Contact Number</th>
				<th>Gender</th>
				<th>Age</th>
				<th>Address</th>
				<th>Role</th>
				<th>Speciality</th>
				<th>Nationality</th>
				<th>Date Added</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			$data = isset($_GET['searchBtn']) 
				? searchForAapplicant($pdo, $_GET['searchInput']) 
				: getAllApplicants($pdo);
			foreach ($data as $row): ?>
				<tr>
					<td><?php echo htmlspecialchars($row['applicant_id']); ?></td>
					<td><?php echo htmlspecialchars($row['first_name']); ?></td>
					<td><?php echo htmlspecialchars($row['last_name']); ?></td>
					<td><?php echo htmlspecialchars($row['contact_number']); ?></td>
					<td><?php echo htmlspecialchars($row['gender']); ?></td>
					<td><?php echo htmlspecialchars($row['age']); ?></td>
					<td><?php echo htmlspecialchars($row['address']); ?></td>
					<td><?php echo htmlspecialchars($row['role']); ?></td>
					<td><?php echo htmlspecialchars($row['speciality']); ?></td>
					<td><?php echo htmlspecialchars($row['nationality']); ?></td>
					<td><?php echo htmlspecialchars($row['date_added']); ?></td>
					<td class="action-links">
						<a href="edit.php?applicant_id=<?php echo $row['applicant_id']; ?>">Edit</a>
						<a href="delete.php?applicant_id=<?php echo $row['applicant_id']; ?>">Delete</a>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</body>
</html>
