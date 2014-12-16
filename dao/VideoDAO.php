<?php
require_once WWW_ROOT . 'dao' . DS . 'DAO.php';

class VideoDAO extends DAO {

	//VIDEO

	public function selectAll() {
		$sql = "SELECT * FROM `w_videos`";
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function selectById($id) {
		$sql = "SELECT * FROM `w_videos` WHERE `id` = :id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function insert($data) {
		if(empty($errors)) {
			$sql = "INSERT INTO `w_videos` (`project_id`, `user_id`, `file`,`extension`) 
			VALUES (:project_id, :user_id, :file, :extension)";

			$stmt = $this->pdo->prepare($sql);
			$stmt->bindValue(':project_id', $data['project_id']);
			$stmt->bindValue(':user_id', $data['user_id']);
			$stmt->bindValue(':file', $data['file']);
			$stmt->bindValue(':extension', $data['extension']);

			if($stmt->execute()) {
				$insertedId = $this->pdo->lastInsertId();
				return $this->selectById($insertedId);
			}
		}
		return false;
	}

	public function deleteById($id){
		$sql = "DELETE FROM `w_videos` WHERE `id` = :id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
	}
}