require "mysql2"
require "pry"

$db_client = Mysql2::Client.new(:host => "localhost", :username => "root", :database=> "utms")

def resolve_where_clause(where_clause=[], where_condition = 'AND')
	where_string='', index = 0
	where_clause.each do |where|
		where_string = "`#{where_clause[index]}`='#{where_clause[index + 1]}'" if index == 0
		index += 2
		if(where_clause.size > 1 && index < where_clause.size && index != 0)
			where_string = "#{where_string} #{where_condition} `#{where_clause[index]}`='#{where_clause[index + 1]}'"
		end
		break if index == where_clause.size
	end
	where_string
end

def select_all(table_name,where_clause=[],where_condition='AND')
	db_query = "SELECT * FROM `#{table_name}`"
	where_string = '';
	if where_clause!=[]
		where_string = resolve_where_clause(where_clause, where_condition)
		db_query = "#{db_query} WHERE #{where_string}"
	end
	result_array = [];
	$db_client.query(db_query).each do |row|
		result_array << row
	end
	result_array
end

def select_fields(fields=[],table_name,where_clause=[],where_condition='AND'){
	select_string = "";
	# TODO: Manipulate method from here
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

puts select_all('login_details',['primary_contact','9569793959'])