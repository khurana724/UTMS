require "mysql2"
require "pry"

$db_client = Mysql2::Client.new(:host => "localhost", :username => "root", :database=> "utms")

def resolve_where_clause(db_query, where_clause = [], where_condition = 'AND')
  where_string='', index = 0
  where_clause.each do |where|
    where_string = "`#{where_clause[index]}`='#{where_clause[index + 1]}'" if index == 0
    index += 2
    if  where_clause.size > 1 && index < where_clause.size && index != 0
      where_string = "#{where_string} #{where_condition} `#{where_clause[index]}`='#{where_clause[index + 1]}'"
    end
    break if index == where_clause.size
  end
  return "#{db_query} WHERE #{where_string}"
end

def select_all(table_name, where_clause = [], where_condition = 'AND')
  db_query = "SELECT * FROM `#{table_name}`"
  db_query = resolve_where_clause(db_query, where_clause, where_condition) unless where_clause == []
  result_array = []
  $db_client.query(db_query).each do |row|
    result_array << row
  end
  result_array
end

def select_fields(table_name, fields = [], where_clause = [], where_condition = 'AND')
  select_string = ""
  fields.each_with_index do |field, index|
    if index < fields.size && index != fields.size-1
      select_string = "#{select_string}`#{field}`,"
    elsif index >= fields.size-1
      select_string = "#{select_string}`#{field}`"
    end
  end
  db_query = "SELECT #{select_string} FROM `#{table_name}`"
  db_query = resolve_where_clause(db_query, where_clause, where_condition) unless where_clause == []
  result_array = []
  $db_client.query(db_query).each do |row|
    result_array << row
  end
  result_array
end

def insert(table_name, fields = [], values = [])
  field_string = ''
  value_string = ''
  unless fields.size == values.size
    warn 'Inconsistent Field and Values. Please check your query'
    abort
  end
  fields.each_with_index do |field, index|
    if index < fields.size && index != fields.size - 1
      field_string = "#{field_string}`#{field}`,"
    elsif index >= fields.size - 1
      field_string = "#{field_string}`#{field}`"
    end
  end
  values.each_with_index do |value, index|
    if index < values.size && index != values.size - 1
      value_string = "#{value_string}`#{value}`,"
    elsif index >= values.size - 1
      value_string = "#{value_string}`#{value}`"
    end
  end
  db_query = "INSERT INTO `#{table_name}` (#{field_string}) VALUES (#{value_string})"
  $db_client.query(db_query)
end

def update(table_name, fields = [], values = [], where_clause = [], where_condition = 'AND')
  update_string = '';
  unless fields.size == values.size
    warn 'Inconsistent Field and Values. Please check your query'
    abort
  end
  fields.each_with_index do |field, index|
    if index < fields.size && index != fields.size - 1
      update_string = "#{update_string}`#{field}`='"+values[index]+"',"
    elsif index >= fields.size - 1
      update_string = "#{update_string}`#{field}`='"+values[index]+"'"
    end
  end
  db_query = "UPDATE `#{table_name}` SET #{update_string}";
  db_query = resolve_where_clause(db_query, where_clause, where_condition) unless where_clause == []
  $db_client.query(db_query)
end

def delete_fields(table_name,where_clause=[],where_condition='AND')
  unless where_clause!=[]
    warn 'WHERE Clause cannot be empty for a DELETE statement'
    abort
  end
  db_query = "DELETE FROM `#{table_name}`"
  db_query = resolve_where_clause(db_query, where_clause, where_condition)
  $db_client.query(db_query)
end