<?php

class Account {
	private $account_id;
	private $user_id;
	private $account_type;
	private $name;
	private $balance;

	public function __construct( $account_id, $user_id, $account_type, $name, $balance ) {
		$this->account_id   = $account_id;
		$this->user_id      = $user_id;
		$this->account_type = $account_type;
		$this->name         = $name;
		$this->balance      = $balance;
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