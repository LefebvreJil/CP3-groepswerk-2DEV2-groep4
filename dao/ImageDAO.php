<?php
require_once WWW_ROOT . 'dao' . DS . 'DAO.php';

class ImageDAO extends DAO {
	public function selectAll() {
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

	public function insert($data) {
		$errors = $this->getValidationErrors($data);
		if(empty($errors)) {
			$sql = "INSERT INTO `w_images` (`user_id`, `xPos`,`yPos`, `file`,`extension`) 
			VALUES (:user_id, :xPos, :yPos, :file, :extension)";

			$stmt = $this->pdo->prepare($sql);
			$stmt->bindValue(':user_id', $data['user_id']);
			$stmt->bindValue(':xPos', $data['xPos']);
			$stmt->bindValue(':yPos', $data['yPos']);
			$stmt->bindValue(':file', $data['file']);
			$stmt->bindValue(':extension', $data['extension']);

			if($stmt->execute()) {
				$insertedId = $this->pdo->lastInsertId();
				return $this->selectById($insertedId);
			}
		}
		return false;
	}

	public function getValidationErrors($data) {
		$errors = array();
		// if(empty($data['vn'])) { $errors['voornaam'] = "Gelieve uw voornaam in te vullen"; }
		// if(empty($data['an'])) { $errors['achternaam'] = "Gelieve uw achternaam in te vullen"; }
		// if(empty($data['nickname'])) { $errors['nickname'] = "Gelieve een nickname in te vullen"; }
		// if(empty($data['email'])) { $errors['email'] = "Gelieve uw email in te vullen"; }
		// if(empty($data['beroep'])) { $errors['beroep'] = "Gelieve uw beroep in te vullen"; }
		// if(empty($data['paswoord'])) { $errors['paswoord'] = "Gelieve uw wachtwoord in te vullen"; }
		// if(empty($data['pic'])) { $errors['pic'] = "Gelieve een foto up te loaden"; }
		return $errors;
	}
}