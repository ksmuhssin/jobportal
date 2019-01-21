<?php
namespace Cart;
class employ {
	private $employ_id;
	private $fullname;
	private $email;	
	private $address_id;

	public function __construct($registry) {
		$this->config = $registry->get('config');
		$this->db = $registry->get('db');
		$this->request = $registry->get('request');
		$this->session = $registry->get('session');

		if (isset($this->session->data['employ_id'])) {
			$employ_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "employ WHERE employ_id = '" . (int)$this->session->data['employ_id'] . "' AND status = '1'");

			if ($employ_query->num_rows) {
				$this->employ_id = $employ_query->row['employ_id'];
				$this->fullname = $employ_query->row['fullname'];
				$this->email = $employ_query->row['email'];
				
				$this->db->query("UPDATE " . DB_PREFIX . "employ SET language_id = '" . (int)$this->config->get('config_language_id') . "', ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "' WHERE employ_id = '" . (int)$this->employ_id . "'");

				
			} else {
				$this->logout();
			}
		}
	}

	public function login($email, $password, $override = false) {
		if ($override) {
			$employ_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "employ WHERE LOWER(email) = '" . $this->db->escape(utf8_strtolower($email)) . "' AND status = '1'");
		} else {
			$employ_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "employ WHERE LOWER(email) = '" . $this->db->escape(utf8_strtolower($email)) . "' AND (password = SHA1(CONCAT(salt, SHA1(CONCAT(salt, SHA1('" . $this->db->escape($password) . "'))))) OR password = '" . $this->db->escape(md5($password)) . "') AND status = '1' AND approved = '1'");
		}

		if ($employ_query->num_rows) {
			$this->session->data['employ_id'] = $employ_query->row['employ_id'];

			$this->employ_id = $employ_query->row['employ_id'];
			$this->fullname = $employ_query->row['fullname'];
			$this->email = $employ_query->row['email'];
			
			$this->db->query("UPDATE " . DB_PREFIX . "employ SET language_id = '" . (int)$this->config->get('config_language_id') . "', ip = '" . $this->db->escape($this->request->server['REMOTE_ADDR']) . "' WHERE employ_id = '" . (int)$this->employ_id . "'");

			return true;
		} else {
			return false;
		}
	}

	public function logout() {
		unset($this->session->data['employ_id']);

		$this->employ_id = '';		
		$this->fullname = '';		
		$this->email = '';

		
	}

	public function isLogged() {
		return $this->employ_id;
	}

	public function getId() {
		return $this->employ_id;
	}
	
	public function getFullName() {
		return $this->fullname;
	}

	public function getGroupId() {
		return $this->employ_group_id;
	}

	public function getEmail() {
		return $this->email;
	}


	public function getAddressId() {
		return $this->address_id;
	}

	public function getBalance() {
		$query = $this->db->query("SELECT SUM(amount) AS total FROM " . DB_PREFIX . "employ_transaction WHERE employ_id = '" . (int)$this->employ_id . "'");

		return $query->row['total'];
	}

	public function getRewardPoints() {
		$query = $this->db->query("SELECT SUM(points) AS total FROM " . DB_PREFIX . "employ_reward WHERE employ_id = '" . (int)$this->employ_id . "'");

		return $query->row['total'];
	}
}
