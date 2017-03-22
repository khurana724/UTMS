<?php
include 'config.inc';
?>
<html>
	<title>Edit Task</title>
	<body>
		<fieldset>
			<h4 align='right'>Welcome, <?php echo $_SESSION['name'] ?> [ <a href='logout.php'>Logout</a> ]</h4>
		</fieldset>
		<br>
		<fieldset>
			<h4 align = 'center'>Edit Task ( <?php echo date("Y-m-d") ?> )</h4>
			<fieldset>
				<form name="combined_edit" method="post">
					<?php
						function generate_selected_dropdown($options=[],$selected_option){
							foreach($options as $option){
								if($option==$selected_option){
									echo "<option value='".$option."' selected>".$option."</option>";
								}
								else{
									echo "<option value='".$option."'>".$option."</option>";
								}
							}
						}
						$row = select_all('team_task',['task_owner',$_GET['member'],'date',date("Y-m-d")]);
						for($n=0;$n<sizeof($row);$n++){
							$detail = $row[$n];
							echo "<div id = 'sec".$n."' style='float: left; width: ".(100/sizeof($row))."%'>";
					?>
							<table>
								<tr>
									<td><b>Category => </b></td>
									<td>
										<select name='categories<?php echo $n ?>' id='categories<?php echo $n ?>' size=3>
											<?php generate_selected_dropdown(['Dev-Ops', 'Automation', 'Functional'],$detail['category']); ?>
										</select>
									</td>
								</tr>
								<tr>
									<td><b>User Story => </b></td>
									<td><input type='text' name='user_story<?php echo $n ?>' id='user_story<?php echo $n ?>', value="<?php echo $detail['user_story'] ?>"></td>
								</tr>
								<tr>
									<td><b>Task ID => </b></td>
									<td><input type='text' name='task_id<?php echo $n ?>' id='task_id<?php echo $n ?>', value="<?php echo $detail['task_id'] ?>"></td>
								</tr>
								<tr>
									<td><b>Task Summary => </b></td>
									<td><textarea name='task_summary<?php echo $n ?>' id='task_summary<?php echo $n ?>'><?php echo $detail['task_summary'] ?></textarea></td>
								</tr>
								<tr>
									<td><b>Status => </b></td>
									<td>
										<select name='status<?php echo $n ?>' id='status<?php echo $n ?>' size=2>
											<?php generate_selected_dropdown(['Complete', 'In-Progress'],$detail['status']); ?>
										</select>
									<td>
								</tr>
							</table>
					<?php
							echo "</div>";
						}
					?>
					<tr><td><br><input type='submit' name='update_task' id='update_task' value='Update All Tasks'></td></tr>
				</form>
			</fieldset>
			<?php
				if(isset($_POST['categories0'])){
					for($n=0;$n<sizeof($row);$n++){
						$where_clause = ['task_owner',$_GET['member'],'user_story',$row[$n]['user_story'],'date',date("Y-m-d"),'task_id',$row[$n]['task_id']];
						update(['category','user_story','task_id','task_summary','status'],[$_POST['categories'.$n],$_POST['user_story'.$n],$_POST['task_id'.$n],$_POST['task_summary'.$n],$_POST['status'.$n]],'team_task',$where_clause);
					}
					echo "Navigating to Status Sheet";
					header('Location: status_sheet.php');
				}
			?>
			</div>
		</fieldset>
	</body>
</html>