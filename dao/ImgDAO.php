<?php
require_once WWW_ROOT . 'dao' . DS . 'DAO.php';

class ImgDAO extends DAO {

	public function selectAll_img() {
		$sql = "SELECT * FROM `w_images`";
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function selectById($id) {
		$sql = "SELECT * FROM `w_images` WHERE `id` = :id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function selectByProjectId($project_id) {
		$sql = "SELECT * FROM `w_images` WHERE `project_id` = :project_id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':project_id', $project_id);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function deleteById($id){
		$sql = "DELETE FROM `w_images` WHERE `id` = :id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
	}

	public function insert($data) {
		if(empty($errors)) {
			$sql = "INSERT INTO `w_images` (`project_id`, `user_id`, `file`,`extension`) 
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

	public function updatePosition($data){
		$sql = "UPDATE `w_images` SET `xPos` =  :xPos, `yPos` =  :yPos WHERE `id` = :id";
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