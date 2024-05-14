<?php

class Account {
	private $account_id;
	private $user_id;
	private $account_type;
	private $name;
	private $balance;
	private $conn;

	public function __construct( $conn ) {
		$this->conn      = $conn;
	}

	public function create( $user_id, $account_type, $name, $balance ) {
		$sql  = "INSERT INTO Accounts (user_id, account_type, name, balance) 
              VALUES (?, ?, ?, ?)";
		$stmt = $this->conn->prepare( $sql );
		$stmt->bind_param( 'issd', $user_id, $account_type, $name, $balance );
		$stmt->execute();
		$stmt->close();
	}

	public function update( $account_id, $account_type, $name, $balance ) {
		$sql  = "UPDATE Accounts SET account_type=?, name=?, balance=?  WHERE account_id=?";
		$stmt = $this->conn->prepare( $sql );
		$stmt->bind_param( 'ssdi', $account_type, $name, $balance, $account_id );
		$result = $stmt->execute();
		$stmt->close();

		return $result;
	}

	public function delete( $account_id ) {
		$sql  = "DELETE FROM Accounts WHERE account_id=?";
		$stmt = $this->conn->prepare( $sql );
		$stmt->bind_param( 'i', $account_id );
		$result = $stmt->execute();
		$stmt->close();

		return $result;
	}

	public function load( $id ) {
		$sql  = "SELECT * FROM Accounts WHERE account_id=?";
		$stmt = $this->conn->prepare( $sql );
		$stmt->bind_param( 'i', $id );
		$stmt->execute();
		$result      = $stmt->get_result();
		$account = $result->fetch_assoc();

		$stmt->close();

		return $account;
	}

	public function get_id() {
		return $this->account_id;
	}
	public function get_user_id() {
		return $this->user_id;
	}
	public function get_account_type() {
		return $this->account_type;
	}
	public function get_name() {
		return $this->name;
	}
	public function get_balance() {
		return $this->balance;
	}
}