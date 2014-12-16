<?php
require_once WWW_ROOT . 'dao' . DS . 'DAO.php';

class StickyNoteDAO extends DAO {
	
	public function selectAll() {
		$sql = "SELECT * FROM `w_sticky_notes`";
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function selectById($id) {
		$sql = "SELECT * FROM `w_sticky_notes` WHERE `id` = :id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function selectByProjectId($project_id) {
		$sql = "SELECT * FROM `w_sticky_notes` WHERE `project_id` = :project_id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':project_id', $project_id);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function insert($data) {
		$sql = "INSERT INTO `w_sticky_notes` (`project_id`,`user_id`, `text`) 
		VALUES (:project_id, :user_id, :tekst)";

		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':project_id', $data['project_id']);
		$stmt->bindValue(':user_id', $data['user_id']);
		$stmt->bindValue(':tekst', $data['text']);

		if($stmt->execute()) {
			$insertedId = $this->pdo->lastInsertId();
			return $this->selectById($insertedId);
		}
		return false;
	}

	public function deleteById($id){
		$sql = "DELETE FROM `w_sticky_notes` WHERE `id` = :id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
	}

	public function selectLast() {
		$sql = "SELECT * FROM `w_sticky_notes`
				ORDER BY `id` DESC
				LIMIT 1";
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function insertText($data) {

		$sql = "UPDATE `w_sticky_notes` SET `text` =  :tekst WHERE `id` = :id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':tekst', $data['text']);
		$stmt->bindValue(':id', $data['id_stickynote']);
		if($stmt->execute()) {
			$insertedId = $this->pdo->lastInsertId();
			return $this->selectById($insertedId);
		}
		return false;
	}

	public function updatePosition($data){
		$sql = "UPDATE `w_sticky_notes` SET `xPos` =  :xPos, `yPos` =  :yPos WHERE `id` = :id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':xPos', $data['xPos']);
		$stmt->bindValue(':yPos', $data['yPos']);
		$stmt->bindValue(':id', $data['id']);
		if($stmt->execute()) {
			$insertedId = $this->pdo->lastInsertId();
			return $this->selectById($insertedId);
		}
		return false;
	}
}