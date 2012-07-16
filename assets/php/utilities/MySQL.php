<?php
/* MySQL.php
 * This file contains general MySQL functions
 */

// Include MySQL db variables


class MySQL{

	var $dbLink;	// Database connection link
	var $error;		// MySQL error message
	var $HOST = "localhost";
	var $USER = "root";
	var $PASS = "bosporus";
	var $NAME = "debtapp";

	// Class Constructor
	function MySQL(){
		$this->connect();
		// $this->HOST = $MYSQL_HOST;
		// $this->USER = $MYSQL_USER;
		// $this->PASS = $MYSQL_PASS;
		// $this->NAME = $MYSQL_NAME;
	}

	// Connects to database
	function connect(){
		// If there's already a connection, close it.
		if($this->dbLink){
			mysql_close($this->dbLink);
		}

		// Create the connection.
		$this->dbLink = mysql_connect($this->HOST, $this->USER, $this->PASS);

		// Check if the connection was successful.
		if(!$this->dbLink){
			$this->error = "Could not connect to server.";
			return false;
		}

		// Check if using database is successful.
		if(!$this->useDatabase()){
			$this->error = "Could not connect to database." .  mysql_error($this->dbLink);
			return false;
		}

		// If all goes well, return true.
		return true;
	}

	// Function to select the database to use.
	function useDatabase(){
		if(!mysql_select_db("debtapp")){
			$this->error = "Could not select database.";
			return false;
		}
		else{
			return true;
		}
	}

	// Function to execute SQL query.
	function executeSQL($sqlQuery){
		return mysql_query($sqlQuery);
	}
}

?>