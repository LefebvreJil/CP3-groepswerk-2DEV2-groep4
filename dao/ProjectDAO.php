<?php
require_once WWW_ROOT . 'dao' . DS . 'DAO.php';


//Nog aanpassen aan w_project structuur
class ProjectDAO extends DAO {
	public function selectAll() {
		$sql = "SELECT * FROM `w_projects`";
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function selectById($id) {
		$sql = "SELECT * FROM `w_projects` WHERE `id` = :id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function insert($data) {
		$errors = $this->getValidationErrors($data);
		if(empty($errors)) {
			$sql = "INSERT INTO `w_projects` (`name`, `date_added`) 
			VALUES (:name, :date_added)";

			$stmt = $this->pdo->prepare($sql);
			$stmt->bindValue(':name', $data['name']);
			$stmt->bindValue(':date_added', date('Y-m-d H:i:s'));

			if($stmt->execute()) {
				$insertedId = $this->pdo->lastInsertId();
				return $this->selectById($insertedId);
			}
		}
		return false;
	}

	public function getValidationErrors($data) {
		$errors = array();
		return $errors;
	}
}