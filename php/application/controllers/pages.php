<?php

/* PHP Stub Calls for Database Functions */

Public function load_db() {
	$this->load->database();
}

Public function print_query_result($query-string) {
	$query = $this->db->query($query_string);
	foreach ($query->result() as $row)
	{
		echo $row->title;
		echo $row->name;
		echo $row->body;
	}
}


Public function login() {

}

Public function logout() {

}