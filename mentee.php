<?php 
	include('functions.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Mentee Profile</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header">
		<h2>Mentee Profile Page</h2>
	</div>
	<div class="content">
		<!-- notification message -->
		<?php if (isset($_SESSION['success'])) : ?>
			<div class="error success" >
				<h3>
					<?php 
						echo $_SESSION['success']; 
						unset($_SESSION['success']);
					?>
				</h3>
			</div>
		<?php endif ?>
		<!-- logged in user information -->
		<div class="profile_info">

			<div>
				<?php  if (isset($_SESSION['user'])) : ?>
					<strong><?php echo $_SESSION['user']['username']; ?></strong>

					<small>
						<i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i> 
						<br>
						<a href="mentee.php?logout='1'" style="color: red;">logout</a>
					</small>
				<?php endif ?>
			</div>
		</div>
		<?php if(count(showMentor()) > 0): ?>
		<hr>
		<div>				
				<h3>Mentee's Mentor</h3>
					<?php if(showMentor()) {?>
						<strong><?php echo showMentor()['username']; ?></strong>
						<small>
							<i  style="color: #888;">(<?php echo ucfirst(showMentor()['user_type']) ?>)</i>
						</small>
					<?php } ?>
		</div>
		<?php endif ?>
	</div>
</body>
</html>