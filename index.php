<html>
	<title>UTMS</title>
	<body>
		<center>
			<h2><u>UNICOI</u><br></h2><h3>Task Management System</h3>
			<form name = 'login_form' method = 'post'>
				<table>
					<tr>
						<td><strong>Username:</strong></td><td><input type = 'text' name = 'username' id = 'username'></td>
					</tr>
					<tr>
						<td><strong>Password:</strong></td><td><input type = 'password' name = 'password' id = 'password'></td>
					</tr>
					<tr>
						<td></td><td><br><input type = 'submit' name = 'login' id = 'login' value = 'Login'></td>
					</tr>
				</table>
			</form>
		</center>
	</body>
	<?php
		include('config.inc');
		if(isset($_POST['username'])){
			$row = select_all('login_details');
			for($n=0;$n<sizeof($row);$n++){
				$detail = $row[$n];
				if(($detail['username']==$_POST['username']) && ($detail['password']==$_POST['password'])){
					$_SESSION['name'] = $detail['member_name'];
					header('Location: home.php');
				}
			}
			echo "Incorrect Username/Password";
		}
	?>
</html>