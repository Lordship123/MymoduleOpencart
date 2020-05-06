<?php
class ModelSaleParoff extends Model {
		public function addReturn($data) {
		$this->db->query("UPDATE `" . DB_PREFIX . "paroff` SET return_status_id = '" . (int)$data['return_status_id'] . "' WHERE id = '" .$_GET['return_id'] ." '");
	
		return $this->db->getLastId();
	}

	public function editReturn($id, $data) {
		$this->db->query("UPDATE `" . DB_PREFIX . "paroff` SET return_status_id = '" . $this->db->escape($data['return_status_id']) . "'");
	}

		public function deleteReturn($id) {
		$this->db->query("DELETE FROM `" . DB_PREFIX . "paroff` WHERE id = '" . (int)$id . "'");
	}


public function getReturn($id) {
		$query = $this->db->query("SELECT DISTINCT *, (SELECT CONCAT(c.firstname, ' ', c.lastname) FROM " . DB_PREFIX . "customer c WHERE c.customer_id = r.customer_id) AS customer FROM `" . DB_PREFIX . "paroff` r WHERE r.id = '" . (int)$id . "'");

		return $query->row;
	}

	// public function getReturns($data = array()) {
	// 	$sql = "SELECT *, CONCAT(r.firstname, ' ', r.lastname) AS customer FROM `" . DB_PREFIX . "paroff` r";


		public function getReturns($data = array()) {
		$sql = "SELECT *, CONCAT(r.firstname, ' ', r.lastname) AS customer, (SELECT rs.name FROM " . DB_PREFIX . "return_status rs WHERE rs.return_status_id = r.return_status_id AND rs.language_id = '" . (int)$this->config->get('config_language_id') . "') AS status FROM `" . DB_PREFIX . "paroff` r";

		$implode = array();

		if (!empty($data['filter_id'])) {
			$implode[] = "r.id = '" . (int)$data['filter_id'] . "'";
		}

		if (!empty($data['filter_order_id'])) {
			$implode[] = "r.order_id = '" . (int)$data['filter_order_id'] . "'";
		}

		if (!empty($data['filter_customer'])) {
			$implode[] = "CONCAT(r.firstname, ' ', r.lastname) LIKE '" . $this->db->escape($data['filter_customer']) . "%'";
		}

		if (!empty($data['filter_form'])) {
			$implode[] = "r.form = '" . $this->db->escape($data['filter_form']) . "'";
		}

		if (!empty($data['filter_age'])) {
			$implode[] = "r.age = '" . $this->db->escape($data['filter_age']) . "'";
		}
		
		if (!empty($data['filter_email'])) {
			$implode[] = "r.email = '" . $this->db->escape($data['filter_email']) . "'";
		}

		if (!empty($data['filter_status'])) {
			$implode[] = "r.status = '" . $this->db->escape($data['filter_status']) . "'";
		}


		if (!empty($data['filter_company'])) {
			$implode[] = "r.company = '" . $this->db->escape($data['filter_company']) . "'";
		}
		

		if (!empty($data['filter_return_status_id'])) {
			$implode[] = "r.return_status_id = '" . (int)$data['filter_return_status_id'] . "'";
		}

		if (!empty($data['filter_date_added'])) {
			$implode[] = "DATE(r.date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
		}

		if (!empty($data['filter_date_modified'])) {
			$implode[] = "DATE(r.date_modified) = DATE('" . $this->db->escape($data['filter_date_modified']) . "')";
		}

		if ($implode) {
			$sql .= " WHERE " . implode(" AND ", $implode);
		}

		$sort_data = array(
			'customer',
			'status',
			'r.age',
			'r.email',
			'r.form'
		);
 
		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY id";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}		

		

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$query = $this->db->query($sql);

		return $query->rows;
	}

	public function getTotalReturns($data = array()) {
		$sql = "SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "paroff`r";

		$implode = array();

		if (!empty($data['filter_id'])) {
			$implode[] = "r.id = '" . (int)$data['filter_id'] . "'";
		}

		if (!empty($data['filter_customer'])) {
			$implode[] = "CONCAT(r.firstname, ' ', r.lastname) LIKE '" . $this->db->escape($data['filter_customer']) . "%'";
		}

		if (!empty($data['filter_order_id'])) {
			$implode[] = "r.order_id = '" . $this->db->escape($data['filter_order_id']) . "'";
		}

		if (!empty($data['filter_company'])) {
			$implode[] = "r.company = '" . $this->db->escape($data['filter_company']) . "'";
		}

		if (!empty($data['filter_model'])) {
			$implode[] = "r.model = '" . $this->db->escape($data['filter_model']) . "'";
		}

		if (!empty($data['filter_return_status_id'])) {
			$implode[] = "r.return_status_id = '" . (int)$data['filter_return_status_id'] . "'";
		}

		if (!empty($data['filter_date_added'])) {
			$implode[] = "DATE(r.date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
		}

		if (!empty($data['filter_date_modified'])) {
			$implode[] = "DATE(r.date_modified) = DATE('" . $this->db->escape($data['filter_date_modified']) . "')";
		}

		if ($implode) {
			$sql .= " WHERE " . implode(" AND ", $implode);
		}

		$query = $this->db->query($sql);

		return $query->row['total'];
	}



	
}
