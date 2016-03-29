<?php
/**
 * ----------------------------------------------
 * Advanced Guestbook 2.2 (PHP/MySQL)
 * Copyright (c)2001 Chi Kien Uong
 * URL: http://www.proxy2.de
 * ----------------------------------------------
 */

class book_sql {

    var $conn_id;
    var $result;
    var $record;
    var $db = array();

    function book_sql() {
        global $GB_DB;
        $this->db =& $GB_DB;
    }
    
    function connect() {
        $this->conn_id = mysql_connect($this->db['host'],$this->db['user'],$this->db['pass']);
        if ($this->conn_id == 0) {
            $this->sql_error("Connection Error");
        }
        if (!mysql_select_db($this->db['dbName'], $this->conn_id)) {
            $this->sql_error("Database Error");
        }
		mysql_query("SET NAMES 'utf8'", $this->conn_id);
        return $this->conn_id;
    }

    function query($query_string, $show=0) {
        $this->result = mysql_query($query_string,$this->conn_id);
        if (!$this->result) {
            $this->sql_error("Query Error: ".$query_string);
        }
		if ($show==1) $this->sql_print($query_string);
        return $this->result;
    }

    function fetch_array($query_id) {
        $this->record = mysql_fetch_array($query_id,MYSQL_ASSOC);
        return $this->record;
    }

    function num_rows($query_id) {
        return ($query_id) ? mysql_num_rows($query_id) : 0;
    }


    function num_fields($query_id) {
        return ($query_id) ? mysql_num_fields($query_id) : 0;
    }

    function insert_id() {
        return mysql_insert_id($link_id);
    }

    function free_result($query_id) {
        return mysql_free_result($query_id);
    }
  
    function sql_error($message) {
        global $TEC_MAIL;
        $description = mysql_error();
        $number = mysql_errno();
        $error ="MySQL Error : $message\n";
        $error.="Error Number: $number $description\n"; 
        $error.="Date        : ".date("D, F j, Y H:i:s")."\n";
        $error.="IP          : ".getenv("REMOTE_ADDR")."\n";
        $error.="Browser     : ".getenv("HTTP_USER_AGENT")."\n";
        $error.="Referer     : ".getenv("HTTP_REFERER")."\n";
        $error.="PHP Version : ".PHP_VERSION."\n";
        $error.="OS          : ".PHP_OS."\n";
        $error.="Server      : ".getenv("SERVER_SOFTWARE")."\n";
        $error.="Server Name : ".getenv("SERVER_NAME")."\n";
        echo "<b><font size=4 face=Arial>$message</font></b><hr>";
        echo "<pre>$error</pre>";
        $headers = "From: ".$this->db['user']."@".$this->db['host']."\nX-Mailer: Advanced Guestbook 2";
        @mail("$TEC_MAIL","Query Error: - Error","$error","$headers");
        exit();
    }
	
    function sql_print($message) {
		echo "<font size=2 face=Arial><b>Query:</b> $message</font><hr>";
    }

}

?>