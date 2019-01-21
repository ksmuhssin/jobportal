<?php
namespace Cart;
class Company {
	private $company_id;
	private $fullname;
	private $email;	
	private $address_id;

	public function __construct($registry) {
		$this->config = $registry->get('config');
		$this->db = $registry->get('db');
		$this->request = $registry->get('request');
		$this->session = $registry->get('session');

		if (isset($this->session->data['company_id'])) {
			$company_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "company WHERE company_id = '" . (int)$this->session->data['company_id'] . "' AND status = '1'");

			if ($company_query->num_rows) {
				$this->company_id = $company_query->row['company_id'];
				$this->fullname = $company_query->row['full_name'];
				$this->email = $company_query->row['email'];
				
				$this->db->query("UPDATE " . DB_PREFIX . "company SET language_id = '" . (int)$this->config->get('config_language_id') . "', ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "' WHERE company_id = '" . (int)$this->company_id . "'");
			} else {
				$this->logout();
			}
		}
	}

	public function login($email, $password, $override = false) {
		if ($override) {
			$company_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "company WHERE LOWER(email) = '" . $this->db->escape(utf8_strtolower($email)) . "' AND status = '1'");
		} else {
			$company_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "company WHERE LOWER(email) = '" . $this->db->escape(utf8_strtolower($email)) . "' AND (password = SHA1(CONCAT(salt, SHA1(CONCAT(salt, SHA1('" . $this->db->escape($password) . "'))))) OR password = '" . $this->db->escape(md5($password)) . "') AND status = '1' AND approved = '1'");
		}

		if ($company_query->num_rows) {
			$this->session->data['company_id'] = $company_query->row['company_id'];

			$this->company_id = $company_query->row['company_id'];
			$this->fullname = $company_query->row['full_name'];
			$this->email = $company_query->row['email'];
			
			$this->db->query("UPDATE " . DB_PREFIX . "company SET language_id = '" . (int)$this->config->get('config_language_id') . "', ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "' WHERE company_id = '" . (int)$this->company_id . "'");

			return true;
		} else {
			return false;
		}
	}

	public function logout() {
		unset($this->session->data['company_id']);

		$this->company_id = '';		
		$this->fullname = '';		
		$this->email = '';
	}

	public function isLogged() {
		return $this->company_id;
	}

	public function getId() {
		return $this->company_id;
	}
	
	public function getFullName() {
		return $this->fullname;
	}

	public function getGroupId() {
		return $this->company_group_id;
	}

	public function getEmail() {
		return $this->email;
	}

	public function getAddressId() {
		return $this->address_id;
	}

	public function getBalance() {
		$query = $this->db->query("SELECT SUM(amount) AS total FROM " . DB_PREFIX . "company_transaction WHERE company_id = '" . (int)$this->company_id . "'");

		return $query->row['total'];
	}

	public function getRewardPoints() {
		$query = $this->db->query("SELECT SUM(points) AS total FROM " . DB_PREFIX . "company_reward WHERE company_id = '" . (int)$this->company_id . "'");

		return $query->row['total'];
	}
}
