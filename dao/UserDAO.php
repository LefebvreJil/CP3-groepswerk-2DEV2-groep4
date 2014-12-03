<?php
require_once WWW_ROOT . 'dao' . DS . 'DAO.php';

class UserDAO extends DAO {
	public function selectAll() {
		$sql = "SELECT * FROM `w_users`";
		$stmt = $this->pdo->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function selectById($id) {
		$sql = "SELECT * FROM `w_users` WHERE `id` = :id";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':id', $id);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}

	public function selectByEmail($email) {
		$sql = "SELECT * FROM `w_users` WHERE `email` = :email";
		$stmt = $this->pdo->prepare($sql);
		$stmt->bindValue(':email', $email);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_ASSOC);
	}


	public function insert($data) {
		$errors = $this->getValidationErrors($data);
		if(empty($errors)) {
			$sql = "INSERT INTO `w_users` (`vn`, `an`,`nickname`,`email`,`pic`, `extensie`,`kwaliteiten`,`beroep`,`password`) 
			VALUES (:vn, :an, :nickname, :email, :pic, :extensie, :kwaliteiten, :beroep, :wachtwoord)";

			$stmt = $this->pdo->prepare($sql);
			$stmt->bindValue(':vn', $data['vn']);
			$stmt->bindValue(':an', $data['an']);
			$stmt->bindValue(':nickname', $data['nickname']);
			$stmt->bindValue(':email', $data['email']);
			$stmt->bindValue(':pic', $data['pic']);
			$stmt->bindValue(':extensie', $data['extensie']);
			$stmt->bindValue(':kwaliteiten', $data['kwaliteiten']);
			$stmt->bindValue(':beroep', $data['beroep']);
			$stmt->bindValue(':wachtwoord', $data['wachtwoord']);

			if($stmt->execute()) {
				$insertedId = $this->pdo->lastInsertId();
				return $this->selectById($insertedId);
			}
		}
		return false;
	}

	public function getValidationErrors($data) {
		$errors = array();
		if(empty($data['vn'])) { $errors['voornaam'] = "Gelieve uw voornaam in te vullen"; }
		if(empty($data['an'])) { $errors['achternaam'] = "Gelieve uw achternaam in te vullen"; }
		if(empty($data['nickname'])) { $errors['nickname'] = "Gelieve een nickname in te vullen"; }
		if(empty($data['email'])) { $errors['email'] = "Gelieve uw email in te vullen"; }
		if(empty($data['kwaliteiten'])) { $errors['kwaliteiten'] = "Gelieve uw kwaliteiten in te vullen"; }
		if(empty($data['beroep'])) { $errors['beroep'] = "Gelieve uw beroep in te vullen"; }
		if(empty($data['wachtwoord'])) { $errors['wachtwoord'] = "Gelieve uw wachtwoord in te vullen"; }
		if(empty($data['pic'])) { $errors['pic'] = "Gelieve een foto up te loaden"; }
		return $errors;
	}
}