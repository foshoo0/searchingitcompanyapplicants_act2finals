<?php require_once 'core/models.php'; ?>
<?php require_once 'core/dbconfig.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<h1>Are you sure you want to delete this user?</h1>
	<?php $getApplicantByID = getApplicantByID($pdo, $_GET['applicant_id']); ?>
	<div class="container" style="border-style: solid; border-color: red; background-color: #ffcbd1;height: 500px;">
		<h2>First Name: <?php echo $getApplicantByID['first_name']; ?></h2>
		<h2>Last Name: <?php echo $getApplicantByID['last_name']; ?></h2>
		<h2>Contact Number: <?php echo $getApplicantByID['contact_number']; ?></h2>
		<h2>Gender: <?php echo $getApplicantByID['gender']; ?></h2>
        <h2>Age: <?php echo $getApplicantByID['age']; ?></h2>
		<h2>Address: <?php echo $getApplicantByID['address']; ?></h2>
		<h2>Role: <?php echo $getApplicantByID['role']; ?></h2>
		<h2>Speciality/Expertise: <?php echo $getApplicantByID['speciality']; ?></h2>
		<h2>Nationality: <?php echo $getApplicantByID['nationality']; ?></h2>

		<div class="deleteBtn" style="float: right; margin-right: 10px;">
			<form action="core/handleforms.php?applicant_id=<?php echo $_GET['applicant_id']; ?>" method="POST">
				<input type="submit" name="deleteApplicantBtn" value="Delete" style="background-color: #f69697; border-style: solid;">
			</form>			
		</div>	

	</div>
</body>
</html>