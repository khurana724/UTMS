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
								<td><textarea name='task_summary' id='task_summary'></textarea></td>
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
					<?php
					if(isset($_POST['user_story'])){
						if($_POST['categories']=='nil' || $_POST['status']=='nil'){
							DIE("You have incorrectly selected either the Category or the status. Please verify your option and try again");
						}
						insert(['category','user_story','task_id','task_summary','status','task_owner','date'],[$_POST['categories'],$_POST['user_story'],$_POST['task_id'],$_POST['task_summary'],$_POST['status'],$_SESSION['name'],date("Y-m-d")],'team_task');
						header('Location: status_sheet.php');
					}
					?>
				</fieldset>
			</div>
			<div id = 'sec2' style='float: left; width: 65%'>
			<fieldset><b>Team Task Status: ( <a href="edit_task.php?member=<?php echo $_SESSION['name'] ?>">Edit My Task </a> )</b>	
				<table border=1 align='center'>
					<tr align='center'><td><b>User Story</b></td><td><b>Task Number</b></td><td><b>Task Summary</b></td><td><b>Status</b></td><tr>
					<?php
						function print_row($row){
							for($n=0;$n<sizeof($row);$n++){
								$detail = $row[$n];
								if($detail['date']==date("Y-m-d")){
									echo "<tr align='center'><td>".$detail['user_story']."</td><td>".$detail['task_id']."</td>";
									echo "<td align='left'>".$detail['task_summary']."</td><td>[".$detail['status']."]</td></tr>";
								}
								else{
									echo  "<tr><td align='center' colspan=4><b>No Task Data available yet</b></td></tr>";
								}
							}
						}
						/*
						---------------------------------------------------------------------------------------------------------------------------------------
																		Section for Dev-Ops
						---------------------------------------------------------------------------------------------------------------------------------------
						*/
						$row = select_all('team_task',['category','Dev-Ops']);
						if(sizeof($row)>0){
							echo "<tr><td align='center' colspan=4><b>Dev-Ops</b></td></tr>";
							print_row($row);
						}
						/*
						---------------------------------------------------------------------------------------------------------------------------------------
																		Section for Automation
						---------------------------------------------------------------------------------------------------------------------------------------
						*/
						$row = select_all('team_task',['category','Automation']);
						if(sizeof($row)>0){
							echo "<tr><td align='center' colspan=4><b>Automation</b></td></tr>";
							print_row($row);
						}
						/*
						---------------------------------------------------------------------------------------------------------------------------------------
																		Section for Functional
						---------------------------------------------------------------------------------------------------------------------------------------
						*/
						$row = select_all('team_task',['category','Functional']);
						if(sizeof($row)>0){
							echo "<tr><td align='center' colspan=4><b>Functional</b></td></tr>";
							print_row($row);
						}
						/*
						---------------------------------------------------------------------------------------------------------------------------------------
						---------------------------------------------------------End---------------------------------------------------------------------------
						---------------------------------------------------------------------------------------------------------------------------------------
						*/
					?>
				</table>
			</fieldset>
			</div>
		</fieldset>
	</body>
</html>