<?php 
include('functions.php');

if (!isMentor()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: index.php');
}

if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location: index.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Mentor Profile</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<style>
	.header {
		background: #003366;
	}
	button[name=register_btn] {
		background: #003366;
	}
	</style>
</head>
<body>
	<div class="header">
		<h2>Mentor - Profile Page</h2>
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
						<a href="mentor.php?logout='1'" style="color: red;">logout</a>
					</small>

				<?php endif ?>
			</div>
		</div>
		<?php if(count(showMentees()) > 0): ?>
		<hr>
		<div>				
			<h3>Mentor's Mentees</h3>
			<div>
				<?php foreach (showMentees() as $mentees) {?>
					<strong><?php echo $mentees[1]; ?></strong>
					<small>
						<i  style="color: #888;">(<?php echo ucfirst($mentees[3]) ?>)</i>
					</small>
					<br>
				<?php } ?>
			</div>
		</div>
		<?php endif ?>
		<?php if(count(getMentees()) > 0): ?>
		<hr>
		<div>				
			<h3>Mentees Without Mentors</h3>
			<table>
				<tr>
					<th>ID</th>
					<th>Mentee Username</th>
					<th>Action</th>
				</tr>

				<?php foreach (getMentees() as $mentees) {?>
				<tr>
					<th><?php echo $mentees[0]?></th>
					<th><?php echo $mentees[1]?></th>
					<th><button style="color: blue; border-radius: 8px; padding: 5px 24px; font-size: 10px;" name="add" onclick="updateMentor(<?php echo $_SESSION['user']['id'].", ".$mentees[0]?>)">Add Mentee</button></th>
				</tr>
				<?php } ?>
			</table>
		</div>
		<?php endif ?>
	</div>
</body>
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script>
	function updateMentor(id, mentee_id)
	{
		$.ajax({
			url: 'functions.php',
			type: 'post',
			data: {add:true, "id": id, mentee_id:mentee_id},
			success: function(output) 
			{
				alert('success, server says '+output);
				window.location.href=window.location.href;
			}, error: function()
			{
				alert('something went wrong, Adding mentee failed');
			}
		});
	}
</script>
</html>