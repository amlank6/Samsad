<?php
class Database_Framework
{
	// +++++++++ SERVER DATABASE CONNECTION DETAILS +++++++++ //
	protected $host					=	"localhost";
	protected $username				=	"root";
	protected $password				=	"";
	protected $database				=	"samsad";
	protected $connection			=	"";
	// ++++++++++++++++++++++++++++++++++++++++++++++++++++++ //

	function connect_database() 
	{
		$conn	=	 mysql_connect($this->host,$this->username,$this->password);
		if(!$conn)
		{
		die("Contact Server Administrator<br /><b>Database Error : </b>" . mysql_error());
		}
		return $this->connection = $conn;
	}

	function select_database() 
	{
		$check_database_existence	=	mysql_select_db($this->database);  
		if(!$check_database_existence)
		{
		die("<b>Error : </b>" . mysql_error());
		}
		else
		{
		return $check_database_existence;
		}
	}
	
	function _sendQuery($query)
    {
		mysql_select_db($this->database);  
		mysql_query("SET NAMES 'utf8'", $this->connection);
		mysql_query("SET CHARACTER SET utf8", $this->connection);
		mysql_query("SET CHARACTER_SET_CONNECTION=utf8", $this->connection);
		$x = mysql_query($query, $this->connection) or die("Error:- ". mysql_error(). "<br />with query:- ".$query);
		return $x;
		mysql_close($this->connection);
	}
	
	function fetch_data($table_name, $fields, $where, $order, $limit, $desc, $limitBegin, $monitoring)
	{
	/*
	$table			=	"detail";
	$fields			=	"*";	
	$where			=	"1=1";
	$order 			= 	"id"; 
	$limit 			= 	"";  	// 	Display Only 10 Rows
	$desc			=	"";	//	0 Means Ascending Order 1 Means Descending Order
	$limitBegin		=	"0";	//	Display Rows From O	
	$monitoring 	= 	false;	//	Flase Means Do Not Display Query
	$database_query	=	$db_functions->fetch_data($table, $fields, $where, $order, $limit, $desc, $limitBegin, $monitoring);

	foreach($database_query as $row)
	{
	$name1 			=	$row["std_name"];
	$sex1 			=	$row["std_sex"];
	$caste1 		=	$row["std_caste"];
	$agreement1 	=	$row["std_agreement"];
	}
	echo "Name:".$name1."<br/>"; 
	echo "Sex:".$sex1 ."<br/>"; 
	echo "Caste:".$caste1 ."<br/>"; 
	echo "Agreement:".$agreement1 ."<br/>"; 
	*/

	$query = 'SELECT ' . $fields . ' FROM ' . $table_name . ' WHERE ' . $where;

	if (!empty($groupby))
	{
	$query .= ' GROUP BY ' . $groupby;
	}

	if (!empty($order)) {
	$query .= ' ORDER BY ' . $order;
	if ($desc == "0") 
	{ $query .= ' ASC '; }
	else
	{ $query .= ' DESC '; }
	}

	if (!empty($limit)) {
	$query .= ' LIMIT ' . $limitBegin . ', ' . $limit;
	}
	
	$result = $this->_sendQuery($query);
	$resultArray = array();
	while ($row = mysql_fetch_assoc($result)) 
	{
	$resultArray[] = $row;
	}
	if ($monitoring)  { echo $query; }
	return $resultArray;
	}
	
	function count_rows($table_name, $fields) 
	{
		$query	= 	"SELECT * FROM ".$table_name.' WHERE '.$fields;
		return mysql_num_rows($this->_sendQuery($query));
	}
	
	function insert_data($table_name, $data)
	{
	/* INSERT DATA INTO TABLE NAME DETAIL
	$table_name					=	"detail";
	$data	=	array(
	'std_name' 					=> 	$_POST["name1"],
	'std_sex' 					=> 	$_POST["sex"],
	'std_caste' 				=> 	$_POST["caste"],
	);
	$x = $db_functions->insert_data($table_name, $data);
	echo ">>>".$x; // SHOWING RESULT OF DATABASE QUERY (1 > TRUE 0 > FALSE)
	*/
	
		$query	 =	'INSERT INTO ' . $table_name . ' ( ' . implode(',', array_keys($data)) . ' )';
		$query	.=	' VALUES(\'' . implode('\',\'', $data) . '\')';
		return $this->_sendQuery($query);
	}

	function update_data($table_name, $data, $where)
    {
	/*
		$table_name					=	"customer_schedule";
		$where	=	"unique_id = '".$unique_id."'";
		$data	=	array(
		'cx_routine_schedule' 		=> 	$cx_routine_schedule,
		'cx_best_day' 				=> 	$_POST["best_day_call"],
		'cx_best_time' 				=> 	$_POST["time"],
		'cx_session_date' 			=> 	$_POST["demo1"],
		'cx_session_timezone' 		=>	$_POST["timezone"],
		'cx_session_support_data' 	=> 	$db_next_date_data
		);
		$database		->	update_data($table_name, $data, $where);
	*/
		if (is_array($data)) 
		{
		$update = array();
		foreach ($data as $key => $val)
		{
		$update[] .= $key . '=\'' . $val . '\'';
		}

		$query = 'UPDATE ' . $table_name . ' SET ' . implode(',', $update) . ' WHERE ' . $where;
		return $this->_sendQuery($query);
        }
    }

	function delete_data($table_name, $where)
	{
		// $where	=	"unique_id = '".$id."'"; 
		$query	=	"DELETE FROM ".$table_name. " WHERE ".$where;
		return $this->_sendQuery($query);
	}
	
	function truncate($table_name)
    {
        $query = 'TRUNCATE TABLE `' . $table . '`';
        return $this->_sendQuery($query);
    }
	
	function duplicate_value($table_name, $column_name)
	{
		$query = "SELECT DISTINCT ".$column_name." FROM ".$table_name;
		$this->_sendQuery($query);
		$resultArray = array();
		while ($row = mysql_fetch_assoc($result)) 
		{ 	$resultArray[] = $row; 	}
		if ($monitoring)  { echo $query; }
		return $resultArray;
	}
	
	function in($table_name, $column_name, $search_string)
	{
		$query = "SELECT * FROM ".$table_name." WHERE ".$column_name." IN (".$search_string.")";
		$this->_sendQuery($query);
		$resultArray = array();
		while ($row = mysql_fetch_assoc($result)) 
		{ 		$resultArray[] = $row; 		}
		if ($monitoring)  { echo $query; }
		return $resultArray;
	}
	
	function insert_unique_values($table_name, $column_name)
	{
		$query = "UPDATE ".$table_name." SET ".$column_name.= FLOOR(10000 + RAND() * 89999);
		return $this->_sendQuery($query);
	}
	
	function make_safe_string($val) 
	{
		$bad1		=		 array('/\blike\b/i','/\bdrop\b/i', '/\bor\b/i', '/\bscript\b/i', '/\balert\b/i', '/\bdelete\b/i', '/\binsert\b/i', '/\bselect\b/i');
		$val		=		 strip_tags($val);					// STRIP PHP & HTML TAGS
		$val		=		 preg_replace($bad1, '', $val);		// STRIP HARMFUL CODES 1 FOR SQL INJECTION
		$val		=		 addslashes($val);
		return $val;
	}
}	
?>