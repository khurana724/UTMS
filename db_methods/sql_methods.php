<?php
	function select_all($table_name,$where_clause=[],$where_condition='AND'){
		$query = "SELECT * FROM `".$table_name."`";
		$where_string = '';
		if($where_clause!=[]){
			$where_string = resolve_where_clause($where_clause, $where_condition);
			$query = $query." WHERE ".$where_string;
		}
		$result = mysql_query($query) or DIE(mysql_error());
		$result_array = [];
		while($row = mysql_fetch_array($result)){
			array_push($result_array, $row);
		}
		return $result_array;
	}
	
	function select_fields($fields=[],$table_name,$where_clause=[],$where_condition='AND'){
		$select_string = "";
		for($i=0;$i<sizeof($fields);$i++){
			if($i<sizeof($fields) && $i!=(sizeof($fields)-1)){
				$select_string = $select_string."`".$fields[$i]."`,";
			}
			elseif($i>=(sizeof($fields)-1)){
				$select_string = $select_string."`".$fields[$i]."`";
			}
		}
		$query = "SELECT ".$select_string." FROM `".$table_name."`";
		$where_string = '';
		if($where_clause!=[]){
			$where_string = resolve_where_clause($where_clause, $where_condition);
			$query = $query." WHERE ".$where_string;
		}
		$result = mysql_query($query) or DIE(mysql_error());
		$result_array = [];
		while($row = mysql_fetch_array($result)){
			array_push($result_array, $row);
		}
		return $result_array;
	}
	
	function resolve_where_clause($where_clause, $where_condition){
		$where_string='';
		for($i=0;$i<sizeof($where_clause);$i++){
			if($i==0){
				$where_string = "`".$where_clause[$i]."`='".$where_clause[$i+1]."'";
			}
			$i = $i+2;
			if(sizeof($where_clause) > 1 && $i<sizeof($where_clause)){
				$where_string = $where_string." ".$where_condition." `".$where_clause[$i]."`='".$where_clause[$i+1]."'";
			}
		}
		return $where_string;
	}
	
	function insert($fields=[],$values=[],$table_name){
		$field_string = ''; $value_string = '';
		if(sizeof($fields)!=sizeof($values)){
			DIE ("Inconsistent Field and Values. Please check your query");
		}
		for($i=0;$i<sizeof($fields);$i++){
			if($i<sizeof($fields) && $i!=(sizeof($fields)-1)){
				$field_string = $field_string."`".$fields[$i]."`,";
			}
			elseif($i>=(sizeof($fields)-1)){
				$field_string = $field_string."`".$fields[$i]."`";
			}
		}
		for($i=0;$i<sizeof($values);$i++){
			if($i<sizeof($values) && $i!=(sizeof($values)-1)){
				$value_string = $value_string."'".$values[$i]."',";
			}
			elseif($i>=(sizeof($fields)-1)){
				$value_string = $value_string."'".$values[$i]."'";
			}
		}
		$query = "INSERT INTO `".$table_name."` (".$field_string.") VALUES (".$value_string.")";
		$result = mysql_query($query) or DIE(mysql_error());
	}
?>