<?php

require_once WWW_ROOT . 'controller' . DS . 'Controller.php';
require_once WWW_ROOT . 'dao' . DS . 'ProjectDAO.php';
require_once WWW_ROOT . 'dao' . DS . 'SessionDAO.php';

class ProjectsController extends Controller {

	private $projectDAO;
	private $sessionDAO;

	function __construct() {
		$this->projectDAO = new ProjectDAO();
		$this->sessionDAO = new SessionDAO();
	}

	public function index() {
	
	}

	public function whiteboard(){
		
	}

	public function addProject(){
		$this->_handleAddProject();
	}

	public function addSession(){
		$this->_handleAddSession();
	}

	private function _handleAddProject() {
		$errors = array();

		if(empty($errors)) {	
			$insertedproject = $this->projectDAO->insert(array(
				//$_POST NOG AANPASSEN!!
				//Untitled moet een Post pop-up worden.
				'name' => "Untitled"
			));

			$_SESSION["info"] = "Je project is met succes toegevoegd.";

			if(!empty($insertedproject)) {
				$_SESSION['info'] = 'De toevoeging van het project was succesvol!';
				$this->redirect('index.php?page=projects');
			}
		}
		$_SESSION['error'] = 'De toevoeging van het project is mislukt.';
		$this->set('errors', $errors);
	}

	private function _handleAddSession() {
		$errors = array();

		if(empty($errors)) {	
			$insertedsession = $this->sessionDAO->insert(array(
				'project_id' => "1"
			));

			$_SESSION["info"] = "Je sessie is met succes toegevoegd.";

			if(!empty($insertedsession)) {
				$_SESSION['info'] = 'De toevoeging van het sessie was succesvol!';
				$this->redirect('index.php?page=projects');
			}
		}
		$_SESSION['error'] = 'De toevoeging van het sessie is mislukt.';
		$this->set('errors', $errors);
	}


}