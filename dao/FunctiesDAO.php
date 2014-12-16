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

	public function selectByProjectId_stickyNote($project_id) {
		$sql = "SELECT * FROM `w_sticky_notes` WHERE `project_id` = :project_id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':project_id', $project_id);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function insert_stickyNote($data) {
		$sql = "INSERT INTO `w_sticky_notes` (`project_id`,`user_id`, `xPos`, `yPos`, `text`) 
		VALUES (:project_id, :user_id, :xPos, :yPos, :tekst)";

		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':project_id', $data['project_id']);
		$stmt->bindValue(':user_id', $data['user_id']);
		$stmt->bindValue(':xPos', $data['xPos']);
		$stmt->bindValue(':yPos', $data['yPos']);
		$stmt->bindValue(':tekst', $data['text']);

		if($stmt->execute()) {
			$insertedId = $this->pdo->lastInsertId();
			return $this->selectById_stickyNote($insertedId);
		}
		return false;
	}

	public function deleteById_stickyNote($id){
		$sql = "DELETE FROM `w_sticky_notes` WHERE `id` = :id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
	}

	public function selectLast_stickyNote() {
		$sql = "SELECT * FROM `w_sticky_notes`
				ORDER BY `id` DESC
				LIMIT 1";
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function insertText_stickyNote($data) {

		$sql = "UPDATE `w_sticky_notes` SET `text` =  :tekst WHERE `id` = :id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':tekst', $data['text']);
		$stmt->bindValue(':id', $data['id_stickynote']);
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

	public function selectByProjectId_img($project_id) {
		$sql = "SELECT * FROM `w_images` WHERE `project_id` = :project_id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':project_id', $project_id);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function deleteById_img($id){
		$sql = "DELETE FROM `w_images` WHERE `id` = :id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
	}

	public function insert_img($data) {
		if(empty($errors)) {
			$sql = "INSERT INTO `w_images` (`project_id`, `user_id`, `xPos`,`yPos`, `file`,`extension`) 
			VALUES (:project_id, :user_id, :xPos, :yPos, :file, :extension)";

			$stmt = $this->pdo->prepare($sql);
			$stmt->bindValue(':project_id', $data['project_id']);
			$stmt->bindValue(':user_id', $data['user_id']);
			$stmt->bindValue(':xPos', $data['xPos']);
			$stmt->bindValue(':yPos', $data['yPos']);
			$stmt->bindValue(':file', $data['file']);
			$stmt->bindValue(':extension', $data['extension']);

			if($stmt->execute()) {
				$insertedId = $this->pdo->lastInsertId();
				return $this->selectById_img($insertedId);
			}
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

	public function deleteById_video($id){
		$sql = "DELETE FROM `w_videos` WHERE `id` = :id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
	}

	//TODOS ALGEMEEN
	public function selectAll_todo() {
		$sql = "SELECT * FROM `w_todos`";
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function selectById_todo($id) {
		$sql = "SELECT * FROM `w_todos` WHERE `id` = :id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function selectByProjectId_todo($project_id) {
		$sql = "SELECT * FROM `w_todos` WHERE `project_id` = :project_id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':project_id', $project_id);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function insert_todo($data) {
		$sql = "INSERT INTO `w_todos` (`project_id`,`user_id`) 
		VALUES (:project_id, :user_id)";

		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':project_id', $data['project_id']);
		$stmt->bindValue(':user_id', $data['user_id']);

		if($stmt->execute()) {
			$insertedId = $this->pdo->lastInsertId();
			return $this->selectById_todo($insertedId);
		}
		return false;
	}

	public function deleteById_todo($id){
		$sql = "DELETE FROM `w_todos` WHERE `id` = :id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
	}

	public function selectLast_todo() {
		$sql = "SELECT * FROM `w_todos`
				ORDER BY `id` DESC
				LIMIT 1";
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	//TODOS item

	public function selectAll_todoItem() {
		$sql = "SELECT * FROM `w_todoItems`";
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function selectById_todoItem($id) {
		$sql = "SELECT * FROM `w_todoItems` WHERE `id` = :id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function selectByTodoId_todoItem($todo_id) {
		$sql = "SELECT * FROM `w_todoItems` WHERE `todo_id` = :todo_id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':todo_id', $todo_id);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function insert_todoItem($data) {
		$sql = "INSERT INTO `w_todoItems` (`todo_id`,`title`, `done`) 
		VALUES (:todo_id, :title, :done)";

		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':todo_id', $data['todo_id']);
		$stmt->bindValue(':title', $data['title']);
		$stmt->bindValue(':done', $data['done']);

		if($stmt->execute()) {
			$insertedId = $this->pdo->lastInsertId();
			return $this->selectById_todo($insertedId);
		}
		return false;
	}

	public function update_todoItem($data) {

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

	public function deleteById_todoItem($id){
		$sql = "DELETE FROM `w_todoItems` WHERE `id` = :id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
	}
}