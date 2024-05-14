<?php
require_once 'db_connect.php';
require_once '../helpers.php';

$conn = OpenCon();

if ( isset( $_POST['category_name'] ) ) {
	add_new_category( $conn, $_POST['category_name'] );
	header( "Location: /dashboard/" );
}