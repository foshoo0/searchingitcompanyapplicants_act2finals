<?php require_once 'core/handleforms.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<h1>Edit the user!</h1>
	<form action="core/handleforms.php" method="POST">
		<p>
			<label for="firstName">First Name</label> 
			<input type="text" name="first_name">
		</p>
		<p>
			<label for="firstName">Last Name</label> 
			<input type="text" name="last_name">
		</p>
		<p>
			<label for="firstName">Contact Number</label> 
			<input type="text" name="contact_number">
		</p>
		<p>
			<label for="firstName">Gender</label> 
			<input type="text" name="gender">
		</p>
        <p>
			<label for="firstName">Age</label> 
			<input type="text" name="age">
		</p>
		<p>
			<label for="firstName">Address</label> 
			<input type="text" name="address">
		</p>
		<p>
			<label for="firstName">Role in the company</label> 
			<input type="text" name="role">
		</p>
		<p>
			<label for="firstName">Speciality or Expertise</label> 
			<input type="text" name="speciality">
		</p>
		<p>
			<label for="firstName">Nationality</label> 
			<input type="text" name="nationality">
			<input type="submit" name="insertApplicantBtn">
		</p>
	</form>
</body>
</html>