<?php
require_once WWW_ROOT . 'dao' . DS . 'DAO.php';

class FunctiesDAO extends DAO {

	//STICKY NOTE
	public function selectAll_stickyNote() {
		$sql = "SELECT * FROM `w_sticky_notes`";
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function selectById_stickyNote($id) {
		$sql = "SELECT * FROM `w_sticky_notes` WHERE `id` = :id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function insert_stickyNote($data) {
		$sql = "INSERT INTO `w_sticky_notes` (`project_id`,`user_id`, `xPos`, `yPos`,`width`, `height`, `color`,`rotation`, `text`) 
		VALUES (:project_id, :user_id, :xPos, :yPos, :width, :height, :color, :rotation, :tekst)";

		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':project_id', $data['project_id']);
		$stmt->bindValue(':user_id', $data['user_id']);
		$stmt->bindValue(':xPos', $data['xPos']);
		$stmt->bindValue(':yPos', $data['yPos']);
		$stmt->bindValue(':width', $data['width']);
		$stmt->bindValue(':height', $data['height']);
		$stmt->bindValue(':color', $data['color']);
		$stmt->bindValue(':rotation', $data['rotation']);
		$stmt->bindValue(':tekst', $data['text']);

		if($stmt->execute()) {
			$insertedId = $this->pdo->lastInsertId();
			return $this->selectById_stickyNote($insertedId);
		}
		return false;
	}


	//IMG
	public function selectAll_img() {
		$sql = "SELECT * FROM `w_images`";
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function selectById_img($id) {
		$sql = "SELECT * FROM `w_images` WHERE `id` = :id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function insert_img($data) {
		$sql = "INSERT INTO `w_images` (`name`,`description`, `date_added`) 
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

	//VIDEO
	public function selectAll_video() {
		$sql = "SELECT * FROM `w_videos`";
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function selectById_video($id) {
		$sql = "SELECT * FROM `w_videos` WHERE `id` = :id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function insert_video($data) {
		$sql = "INSERT INTO `w_videos` (`name`,`description`, `date_added`) 
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

	//TODOS
	//`w_todos` 
}