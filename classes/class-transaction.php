<?php

class Transaction {
	private $transaction_id;
	private $account_id;
	private $date;
	private $amount;
	private $category_id;
	private $description;
	private $type;
	private $user_id;
	private $conn;

	public function __construct( $conn ) {
		$this->conn        = $conn;
	}

	public function get_transaction_id() {
		return $this->transaction_id;
	}
	public function get_date() {
		return $this->date;
	}
	public function get_amount() {
		return $this->amount;
	}
	public function get_category_id() {
		return $this->category_id;
	}
	public function get_description() {
		return $this->description;
	}
	public function get_type() {
		return $this->type;
	}
	public function get_user_id() {
		return $this->user_id;
	}

	// Create a new transaction
	public function create( $account_id, $date, $amount, $category_id, $description, $type, $user_id ) {
		$sql  = "INSERT INTO Transactions (account_id, date, amount, category_id, description, type, user_id) 
              VALUES (?, ?, ?, ?, ?, ?, ?)";
		$stmt = $this->conn->prepare( $sql );
		$stmt->bind_param( 'isdissi', $account_id, $date, $amount, $category_id, $description, $type, $user_id );
		$stmt->execute();
		$stmt->close();
	}

	// Update an existing transaction
	public function update( $transaction_id, $transaction_amount, $transaction_category, $transaction_account, $transaction_date, $transaction_description ) {
		$sql  = "UPDATE Transactions SET amount=?, category_id=?, account_id=?, date=?, description=?  WHERE transaction_id=?";
		$stmt = $this->conn->prepare( $sql );
		$stmt->bind_param( 'diissi', $transaction_amount, $transaction_category, $transaction_account, $transaction_date, $transaction_description, $transaction_id );
		$result = $stmt->execute();
		$stmt->close();

		return $result;
	}

	// Delete a transaction
	public function delete( $transction_id ) {
		$sql  = "DELETE FROM Transactions WHERE transaction_id=?";
		$stmt = $this->conn->prepare( $sql );
		$stmt->bind_param( 'i', $transction_id );
		$result = $stmt->execute();
		$stmt->close();

		return $result;
	}

	// Load transaction data by ID (replace with logic to handle errors)
	public function load( $id ) {
		$sql  = "SELECT * FROM Transactions WHERE transaction_id=?";
		$stmt = $this->conn->prepare( $sql );
		$stmt->bind_param( 'i', $id );
		$stmt->execute();
		$result      = $stmt->get_result();
		$transaction = $result->fetch_assoc();

		$stmt->close();

		return $transaction;
	}

}