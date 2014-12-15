<?php
require_once WWW_ROOT . 'dao' . DS . 'DAO.php';

class ProjectDAO extends DAO {
	public function selectAll() {
		$sql = "SELECT * FROM `w_projects`";
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function selectLast() {
		$sql = "SELECT * FROM `w_projects`
				ORDER BY `id` DESC
				LIMIT 1";
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function selectById($id) {
		$sql = "SELECT * FROM `w_projects` WHERE `id` = :id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function deleteById($id){
		$sql = "DELETE FROM `w_projects` WHERE `id` = :id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
	}

	public function selectAllUsers($id) {
		$sql = "SELECT `w_users`.`nickname` 
		FROM `w_users` 
		LEFT JOIN `w_usersOnProjects` 
		ON `w_users`.`id` = `w_usersOnProjects`.`user_id`
		WHERE `w_usersOnProjects`.`project_id` = :id";

		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function insert($data) {
		$sql = "INSERT INTO `w_projects` (`name`,`description`, `date_added`) 
		VALUES (:name, :description, :date_added)";

		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':name', $data['name']);
		$stmt->bindValue(':description', $data['description']);
		$stmt->bindValue(':date_added', date('Y-m-d H:i:s'));

		if($stmt->execute()) {
			$insertedId = $this->pdo->lastInsertId();
			return $this->selectById($insertedId);
		}
		return false;
	}

	

	public function insertTitle($data) {

		$sql = "UPDATE `w_projects` SET `name` =  :name WHERE `id` = :id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':name', $data['name']);
		$stmt->bindValue(':id', $data['id']);
		if($stmt->execute()) {
			$insertedId = $this->pdo->lastInsertId();
			return $this->selectById($insertedId);
		}
		return false;
	}

	public function insertDescription($data) {

		$sql = "UPDATE `w_projects` SET `description` =  :description WHERE `id` = :id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':description', $data['description']);
		$stmt->bindValue(':id', $data['id']);
		if($stmt->execute()) {
			$insertedId = $this->pdo->lastInsertId();
			return $this->selectById($insertedId);
		}
		return false;
	}
}