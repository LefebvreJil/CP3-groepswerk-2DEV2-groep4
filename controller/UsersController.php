<?php

require_once WWW_ROOT . 'controller' . DS . 'Controller.php';
require_once WWW_ROOT . 'dao' . DS . 'UserDAO.php';

class UsersController extends Controller {

	private $userDAO;

	function __construct() {
		$this->userDAO = new UserDAO();
	}

	public function index() {
		if(!empty($_POST['action'])) {
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
		if(empty($_POST['loginEmail'])) {
			$errors['loginEmail'] = 'Gelieve uw email in te vullen';
		}
		if(empty($_POST['loginPaswoord'])) {
			$errors['loginPaswoord'] = 'Gelieve uw wachtwoord in te vullen';
		}
		if(empty($errors)) {
			$existing = $this->userDAO->selectByEmail($_POST['loginEmail']);
			if(!empty($existing)) {
				$hasher = new \Phpass\Hash;
				if ($hasher->checkPassword($_POST['loginPaswoord'], $existing['wachtwoord'])) {
					$_SESSION['user'] = $existing;
					$this->redirect('index.php');
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
		if(empty($_POST['registerVoornaam'])) { $errors['registerVoornaam'] = 'Gelieve een voornaam in te vullen.';}
		if(empty($_POST['registerAchternaam'])) { $errors['registerAchternaam'] = 'Gelieve een achternaam in te vullen.';}
		if(empty($_POST['registerNickname'])) { $errors['registerNickname'] = 'Gelieve een nickname in te vullen.';}
		if(empty($_POST['registerKwaliteiten'])) { $errors['registerKwaliteiten'] = 'Gelieve kwaliteiten in te vullen.';}
		if(empty($_POST['registerBeroep'])) {$errors['registerBeroep'] = 'Gelieve je beroep of studierichting in te vullen.';}

		//email
		if(empty($_POST['registerEmail'])) {
			$errors['registerEmail'] = 'Please enter your email';
		} else {
			$existing = $this->userDAO->selectByEmail($_POST['registerEmail']);
			if(!empty($existing)) {
				$errors['registerEmail'] = 'Het emailadress dat u wilt gebruiken is al in gebruik. Gelieve een ander op te geven.';
			}
		}

		//wachtwoord
		if(empty($_POST['registerPaswoord'])) { $errors['registerPaswoord'] = 'Gelieve een wachtwoord in te vullen.';}
		if($_POST['registerPaswoordHerhaling'] != $_POST['registerPaswoord']) {$errors['registerPaswoordHerhaling'] = 'De wachtwoorden zijn niet gelijk.';}

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
			$inserteduser = $this->userDAO->insert(array(
				'vn' => $_POST['registerVoornaam'],
				'an' => $_POST['registerAchternaam'],
				'nickname' => $_POST['registerNickname'],
				'kwaliteiten' => $_POST['registerKwaliteiten'],
				'beroep' => $_POST['registerBeroep'],
				'email' => $_POST['registerEmail'],
				'paswoord' => $hasher->hashPassword($_POST['registerPaswoord']),
				'pic' => $name, 
				'extensie' => $extension
			));

			//Jil: is dit ok? ok
			$imageresize = new Eventviva\ImageResize($_FILES["image"]["tmp_name"]);
			$imageresize->save(WWW_ROOT."uploads".DS.$name.".".$extension);
			$imageresize->resizeToHeight(200);
			$imageresize->save(WWW_ROOT."uploads".DS.$name."_th.".$extension);

			$_SESSION["info"] = "Je profielfoto is succesvol opgeslagen.";

			if(!empty($inserteduser)) {
				$_SESSION['info'] = 'De registratie was succesvol!';
				$_SESSION['user'] = $inserteduser;
				$this->redirect('index.php');
			}
		}
		$_SESSION['error'] = 'De registratie is mislukt.';
		$this->set('errors', $errors);
	}

}