<?php

require_once WWW_ROOT . 'controller' . DS . 'Controller.php';
require_once WWW_ROOT . 'dao' . DS . 'UserDAO.php';
require_once WWW_ROOT . 'phpass' . DS . 'Phpass.php';
require_once WWW_ROOT . 'php-image-resize' . DS . 'ImageResize.php';

class UsersController extends Controller {

	private $userDAO;

	function __construct() {
		$this->userDAO = new UserDAO();
	}

	public function index() {
		if(!empty($_POST)) {
			$this->_handleLogin();
		}
	}

	public function register() {
		if(!empty($_POST)){
			$this->_handleRegister();

			//iets willen sturen naar JS (nog testen)
			//echo json_encode($variabele);
		}
	}

	public function logout(){
		unset($_SESSION['user']);
		$this->redirect('index.php');
		$_SESSION['info']= 'Je bent uitgelogd.';
	}


	/*==================================================PRIVATE FUNCTIONS*/

	private function _handleLogin() {
		$errors = array();
		if(empty($_POST['email'])) { $errors['email'] = 'Gelieve uw email in te vullen'; }

		if(empty($_POST['password'])) {
			$errors['password'] = 'Gelieve uw wachtwoord in te vullen';
		}
		if(empty($errors)) {
			$existing = $this->userDAO->selectByEmail($_POST['email']);
			if(!empty($existing)) {
				$hasher = new \Phpass\Hash;
				if ($hasher->checkPassword($_POST['password'], $existing['password'])) {
					$_SESSION['user'] = $existing;
					$this->redirect('index.php?page=projects');
				} else {
					$_SESSION['error'] = 'Onbekende email of wachtwoord';
				}
			} else {
				$_SESSION['error'] = 'Onbekende email of wachtwoord';
			}
		} else {
			$_SESSION['error'] = 'Onbekende email of wachtwoord';
		}
		$this->set('errors', $errors);
	}

	
	private function _handleRegister() {
		$errors = array();
		$size = array();


		//VN AN Nickname Kwaliteiten Beroep
		if(empty($_POST['vn'])) { $errors['vn'] = 'Gelieve een voornaam in te vullen.';}
		if(empty($_POST['an'])) { $errors['an'] = 'Gelieve een achternaam in te vullen.';}
		if(empty($_POST['nickname'])) { $errors['nickname'] = 'Gelieve een nickname in te vullen.';}
		if(empty($_POST['job'])) {$errors['job'] = 'Gelieve je beroep of studierichting in te vullen.';}

		//email
		if(empty($_POST['email'])) {
			$errors['email'] = 'Please enter your email';
		} else {
			$existing = $this->userDAO->selectByEmail($_POST['email']);
			if(!empty($existing)) {
				$errors['email'] = 'Dit emailadres is al in gebruik.';
			}
		}

		//wachtwoord
		if(empty($_POST['password'])) { $errors['password'] = 'Gelieve een wachtwoord in te vullen.';}
		if($_POST['repassword'] != $_POST['password']) {$errors['repassword'] = 'De wachtwoorden zijn niet gelijk.';}

		//kijken of de image ok is
		if(!empty($_FILES["image"])){
			if(!empty($_FILES["image"]["error"])){ $errors["image"] = "De foto kon niet geüpload worden."; }

			if(empty($errors["image"])){
				$size = getimagesize($_FILES["image"]["tmp_name"]);
				if(empty($size)){ $errors["image"] = "upload een foto"; }
			}

			if(empty($errors["image"])){
				if($_FILES["image"]["size"] >=2097152){ 
					$errors["image"] = "De bestandsgrootte is te groot.";
				}
			}
		}




		//YAY geen errors meer
		if(empty($errors)) {
			$hasher = new \Phpass\Hash;
			$name = preg_replace("/\\.[^.\\s]{3,4}$/", "", $_FILES["image"]["name"]);


			//TIJD OVER => veranderen
			$extension = 'jpg';
			
			//array aanmaken
			$inserteduser["vn"] = $_POST['vn'];
			$inserteduser["an"] = $_POST['an'];
			$inserteduser["nickname"] = $_POST['nickname'];
			$inserteduser["beroep"] = $_POST['job'];
			$inserteduser["email"] = $_POST['email'];
			$inserteduser["paswoord"] = $hasher->hashPassword($_POST['password']);
			$inserteduser["pic"] = $name;
			$inserteduser["extensie"] = $extension;

			if(!empty($_POST['qualities'])){
				$inserteduser["kwaliteiten"] = $_POST['qualities'];
			}else{
				$inserteduser["kwaliteiten"] = "";
			}

			$this->userDAO->insert($inserteduser);

			//aan Jil: is dit ok? Jil zei ok
			$imageresize = new Eventviva\ImageResize($_FILES["image"]["tmp_name"]);
			$imageresize->save(WWW_ROOT."uploads".DS.$name.".".$extension);
			$imageresize->resizeToHeight(200);
			$imageresize->save(WWW_ROOT."uploads".DS.$name."_th.".$extension);

			$_SESSION["info"] = "Je profielfoto is succesvol opgeslagen.";

			if(!empty($inserteduser)) {
				$_SESSION['info'] = 'De registratie was succesvol!';
				$_SESSION['user'] = $inserteduser;
				$this->redirect('index.php?page=projects');
			}
		}
		$_SESSION['error'] = 'De registratie is mislukt.';
		$this->set('errors', $errors);
	}

}