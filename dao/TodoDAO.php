<?php
require_once WWW_ROOT . 'dao' . DS . 'DAO.php';

class TodoDAO extends DAO {

	//TODOS ALGEMEEN

	public function selectAll() {
		$sql = "SELECT * FROM `w_todos`";
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function selectById($id) {
		$sql = "SELECT * FROM `w_todos` WHERE `id` = :id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function selectByProjectId($project_id) {
		$sql = "SELECT * FROM `w_todos` WHERE `project_id` = :project_id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':project_id', $project_id);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function insert($data) {
		$sql = "INSERT INTO `w_todos` (`project_id`,`user_id`) 
		VALUES (:project_id, :user_id)";

		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':project_id', $data['project_id']);
		$stmt->bindValue(':user_id', $data['user_id']);

		if($stmt->execute()) {
			$insertedId = $this->pdo->lastInsertId();
			return $this->selectById($insertedId);
		}
		return false;
	}

	public function deleteById($id){
		$sql = "DELETE FROM `w_todos` WHERE `id` = :id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
	}

	public function selectLast() {
		$sql = "SELECT * FROM `w_todos`
				ORDER BY `id` DESC
				LIMIT 1";
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
}