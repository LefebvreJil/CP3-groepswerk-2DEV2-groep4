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
	  	$projects = $this->projectDAO->selectAll();
	    $this->set('projects', $projects);


	    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
	
			 header('Content-Type: application/json');
	     	echo json_encode($projects);
	    	die();
		}

	    //stuur terug via json
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
				//Untitled moet aangepast worden met dubbelklik
				'name' => "Dubbelklik om aan te passen"
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