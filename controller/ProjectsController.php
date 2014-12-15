<?php
require_once WWW_ROOT . 'controller' . DS . 'Controller.php';
require_once WWW_ROOT . 'dao' . DS . 'ProjectDAO.php';
require_once WWW_ROOT . 'dao' . DS . 'FunctiesDAO.php';

class ProjectsController extends Controller {

	private $projectDAO;
	private $functieDAO;

	function __construct() {
		$this->projectDAO = new ProjectDAO();
		$this->functieDAO = new FunctiesDAO();
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
		$project_id = $_GET['id'];

		if($project_id){
			$stickyNotes = $this->functieDAO->selectByProjectId_stickyNote($project_id);
			$this->set('stickyNotes', $stickyNotes);

			$project = $this->projectDAO->selectById($project_id);
			$this->set('project', $project);
		}else{
			$this->redirect('index.php?page=projects');
		}

		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			header('Content-Type: application/json');
	     	echo json_encode(array('stickyNotes' => $stickyNotes));
	    	die();
		}
	}

	public function addNote(){
		$this->_handleAddStickyNote();
	}

	public function addTodo(){
		$this->_handleAddTodo();
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
			$data['project_id'] = $_POST['id'];
			$data['user_id'] = $_SESSION['user']['id'];
			$data['xPos'] = '0';
			$data['yPos'] = '0';
			$data['width'] = '150';
			$data['height'] = '200';
			$data['color'] = $_POST['color'];
			$data['rotation'] = $_POST['rotation'];
			$data['text'] = $_POST['text'];

			$insertedNote = $this->functieDAO->insert_stickyNote($data);
		}
	}

	private function _handleAddTodo(){

		if(!empty($_POST)){
			$data['project_id'] = $_POST['project_id'];
			$data['user_id'] = $_SESSION['user']['id'];

			$insertedNote = $this->functieDAO->insert_todo($data);
		}
	}
}