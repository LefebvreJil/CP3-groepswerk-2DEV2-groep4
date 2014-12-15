<?php
require_once WWW_ROOT . 'controller' . DS . 'Controller.php';
require_once WWW_ROOT . 'dao' . DS . 'ProjectDAO.php';

class ProjectsController extends Controller {

	private $projectDAO;
	private $userDAO;

	function __construct() {
		$this->projectDAO = new ProjectDAO();
	}

	public function index() {
	  	$projects = $this->projectDAO->selectAll();

	    $id = "25";
	    $usersOnProject = $this->projectDAO->selectAllUsers($id);

	    if(!empty($_POST['name'])){
			$data = $_POST;
			$TitelToevoegen = $this->projectDAO->insertTitle($data);
		}

		if(!empty($_POST['description'])){
			$data = $_POST;
			$TitelToevoegen = $this->projectDAO->insertDescription($data);
		}

	    if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			header('Content-Type: application/json');
	     	echo json_encode(array('projects' => $projects, 'usersOnProject'=> $usersOnProject));
	    	die();
		}
	}

	public function whiteboard(){
		if(!empty($_GET['id'])){
			$project = $this->projectDAO->selectById($_GET['id']);
			$this->set('project', $project);

			$_POST['ok'] = 'ok';
			var_dump($_POST);
			$this->_handleAddStickyNote();
		}else{
			$this->redirect('index.php?page=projects');
		}
	}

	public function addProject(){
		$this->_handleAddProject();
	}

	private function _handleAddProject() {
		$confirm = true;
	  	$data = $_POST;

	  	if($data){
		  	$insertedproject = $this->projectDAO->insert($data);
		  	$projects_last = $this->projectDAO->selectLast();

	    	$this->set('projects_last', $projects_last);
	    	$this->set("data", $data);
	  		$this->set("confirm", $confirm);

	        if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
				header('Content-Type: application/json');
		        echo json_encode(array('result' => true, 'projects_last'=>$projects_last));
		        die();
			}
	  	}
	}

	private function _handleAddStickyNote(){

		if(!empty($_POST)){
			$data['project_id'] = '';
			$data['user_id'] = '';
			$data['xPos'] = '';
			$data['yPos'] = '';
			$data['width'] = '';
			$data['height'] = '';
			$data['color'] = '';
			$data['rotation'] = '';
			$data['text'] = '';
		}
	}
}