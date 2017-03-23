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
	query = "SELECT * FROM `#[table_name}`"
	$where_string = '';
	if where_clause!=[]
		where_string = resolve_where_clause(where_clause, where_condition)
		query = "#{query} WHERE #{where_string}"
	end
end