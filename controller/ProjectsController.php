<?php

require_once WWW_ROOT . 'controller' . DS . 'Controller.php';
require_once WWW_ROOT . 'dao' . DS . 'ProjectDAO.php';

class ProjectsController extends Controller {

	private $projectDAO;

	function __construct() {
		$this->projectDAO = new ProjectDAO();
	}

	public function index() {
	
	}

	public function whiteboard(){
		
	}

	public function addProject(){
		$this->_handleAddProject();
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

}