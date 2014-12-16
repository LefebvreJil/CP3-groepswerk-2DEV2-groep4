<?php
require_once WWW_ROOT . 'dao' . DS . 'DAO.php';

class FunctiesDAO extends DAO {

	//TODOS item

	public function selectAll() {
		$sql = "SELECT * FROM `w_todoItems`";
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function selectById($id) {
		$sql = "SELECT * FROM `w_todoItems` WHERE `id` = :id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function selectByTodoId($todo_id) {
		$sql = "SELECT * FROM `w_todoItems` WHERE `todo_id` = :todo_id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':todo_id', $todo_id);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function insert($data) {
		$sql = "INSERT INTO `w_todoItems` (`todo_id`,`title`, `done`) 
		VALUES (:todo_id, :title, :done)";

		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':todo_id', $data['todo_id']);
		$stmt->bindValue(':title', $data['title']);
		$stmt->bindValue(':done', $data['done']);

		if($stmt->execute()) {
			$insertedId = $this->pdo->lastInsertId();
			return $this->selectById($insertedId);
		}
		return false;
	}

	public function update($data) {

		$sql = "UPDATE `w_todoItems` SET `done` =  :done WHERE `id` = :id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':done', $data['done']);
		$stmt->bindValue(':id', $data['id']);
		if($stmt->execute()) {
			$insertedId = $this->pdo->lastInsertId();
			return $this->selectById($insertedId);
		}
		return false;
	}

	public function deleteById($id){
		$sql = "DELETE FROM `w_todoItems` WHERE `id` = :id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
	}
}