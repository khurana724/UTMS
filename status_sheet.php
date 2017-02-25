<?php
include 'config.inc';
?>
<html>
	<title>Status Sheet : : UTMS</title>
	<body>
		<fieldset>
			<h4 align='right'>Welcome, <?php echo $_SESSION['name'] ?> [ <a href='logout.php'>Logout</a> ]</h4>
		</fieldset>
		<br>
		<fieldset>
			<center>
				| <a href='home.php'>Home</a>
				| <a href='status_sheet.php'>Status Sheet</a> | <a href='hours.php'>Hours Tracking</a> | <a href='defects.php'>Defects</a>
				| <a href='tracking_sheet.php'>Tracking Sheet</a> | <a href='framework_new_methods.php'> New Methods for Framework</a> |
			</center>
		</fieldset>
		<br>
		<fieldset>
			<h4 align = 'center'>Status Sheet</h4>
			<div id = 'sec1' style='float: left; width: 35%'>
				<fieldset><b>Enter your task:</b>
					<form name = 'task_details' method='post'>
						<table>
							<tr>
								<td><b>Category => </b></td>
								<td>
									<select name='categories' id='categories' size=4>
										<option value='nil' selected>Select a option</option>
										<option value='Dev-Ops'>Dev-Ops</option>
										<option value='Functional'>Functional</option>
										<option value='Automation'>Automation</option>
									</select>
								</td>
							</tr>
							<tr>
								<td><b>User Story => </b></td>
								<td><input type='text' name='user_story' id='user_story'></td>
							</tr>
							<tr>
								<td><b>Task ID => </b></td>
								<td><input type='text' name='task_id' id='task_id'></td>
							</tr>
							<tr>
								<td><b>Task Summary => </b></td>
								<td><textarea name='task_smmary' id='task_smmary'></textarea></td>
							</tr>
							<tr>
								<td><b>Status => </b></td>
								<td>
									<select name='status' id='status' size=3>
										<option value='nil' selected>Select a option</option>
										<option value='Complete'>Complete</option>
										<option value='In-Progress'>In-Progress</option>
									</select>
								<td>
							</tr>
							<tr><td><br><input type='submit' name='submit_task' id='submit_task' value='Submit Task'></td></tr>
						</table>
					</form>
				</fieldset>
				<?php
					if(isset($_POST['user_story'])){
						
					}
				?>
			</div>
			<div id = 'sec2' style='float: left; width: 65%'>
			<fieldset><b>Team Task Status:</b>
				<table border=1 align='center'>
					<tr><td>User Story</td><td>Task Number</td><td>Task Summary</td><td>Status</td><tr>
					<tr><td align='center' colspan=4><b>Dev-Ops</b></td></tr>
					<tr>
						<td>-</td><td>-</td><td>-</td><td>-</td>
					</tr>
					<tr><td align='center' colspan=4><b>Automation</b></td></tr>
					<tr>
						<td>-</td><td>-</td><td>-</td><td>-</td>
					</tr>
					<tr><td align='center' colspan=4><b>Functional</b></td></tr>
					<tr>
						<td>-</td><td>-</td><td>-</td><td>-</td>
					</tr>
				</table>
			</fieldset>
			</div>
		</fieldset>
	</body>
</html>