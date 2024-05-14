<?php
class Budget {
	// Properties
	private $budget_id;
	private $name;
	private $amount;
	private $startDate;
	private $endDate;
	private $conn;

	// Constructor
	public function __construct( $conn ) {
		$this->conn = $conn;
	}

	public function create( $user_id, $category_id, $amount, $start_date, $end_date  ) {
		$sql  = "INSERT INTO Budgets (user_id, category_id, amount, start_date, end_date) 
              VALUES (?, ?, ?, ?, ?)";
		$stmt = $this->conn->prepare( $sql );
		$stmt->bind_param( 'iidss', $user_id, $category_id, $amount, $start_date, $end_date );
		$stmt->execute();
		$stmt->close();
	}

	// Update an existing transaction
	public function update( $budget_id, $category_id, $amount, $start_date, $end_date ) {
		$sql  = "UPDATE Budgets SET category_id=?, amount=?, start_date=?, end_date=?  WHERE budget_id=?";
		$stmt = $this->conn->prepare( $sql );
		$stmt->bind_param( 'idssi', $category_id, $amount, $start_date, $end_date, $budget_id );
		$result = $stmt->execute();
		$stmt->close();

		return $result;
	}

	// Delete a transaction
	public function delete( $budget_id ) {
		$sql  = "DELETE FROM Budgets WHERE budget_id=?";
		$stmt = $this->conn->prepare( $sql );
		$stmt->bind_param( 'i', $budget_id );
		$result = $stmt->execute();
		$stmt->close();

		return $result;
	}
	public function load( $id ) {
		$sql  = "SELECT * FROM Budgets WHERE budget_id=?";
		$stmt = $this->conn->prepare( $sql );
		$stmt->bind_param( 'i', $id );
		$stmt->execute();
		$result      = $stmt->get_result();
		$transaction = $result->fetch_assoc();

		$stmt->close();

		return $transaction;
	}
}