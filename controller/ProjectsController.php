<?php
require_once WWW_ROOT . 'controller' . DS . 'Controller.php';
require_once WWW_ROOT . 'dao' . DS . 'ProjectDAO.php';
require_once WWW_ROOT . 'dao' . DS . 'FunctiesDAO.php';
require_once WWW_ROOT . 'dao' . DS . 'ImageDAO.php';
require_once WWW_ROOT . 'php-image-resize' . DS . 'ImageResize.php';

class ProjectsController extends Controller {

	private $projectDAO;
	private $functieDAO;
	private $imageDAO;

	function __construct() {
		$this->projectDAO = new ProjectDAO();
		$this->functieDAO = new FunctiesDAO();
		$this->imageDAO = new ImageDAO();
	}

	public function index() {
	  	$projects = $this->projectDAO->selectAll();

	    // $id = "25";
	    // $usersOnProject = $this->projectDAO->selectAllUsers($id);

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
	     	echo json_encode(array('projects' => $projects));
	    	die();
		}
	}

	public function UpdateFunctie(){
		if(!empty($_POST['id_stickynote'])){
			$data = $_POST;
			$inhoudToevoegen = $this->functieDAO->insertText_stickyNote($data);
		}
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			header('Content-Type: application/json');
	     	echo json_encode(array('data' => $_POST));
	    	die();
		}
	}

	public function whiteboard(){
		$project_id = $_GET['id'];
		$existing = $this->projectDAO->selectById($_GET['id']);

		if($project_id){
			if(!empty($existing)){

				$stickyNotes = $this->functieDAO->selectByProjectId_stickyNote($project_id);
				$this->set('stickyNotes', $stickyNotes);

				$todos = $this->functieDAO->selectByProjectId_todo($project_id);
				$this->set('todos', $todos);

				$imges = $this->functieDAO->selectByProjectId_img($project_id);
				$this->set('imges', $imges);


				$project = $this->projectDAO->selectById($project_id);
				$this->set('project', $project);

				
				if(!empty($_FILES)){
					$this->_handleAddImage();
				}

				
			}else{
				$this->redirect('index.php?page=projects');
			}
		}else{
			$this->redirect('index.php?page=projects');
		}

		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			header('Content-Type: application/json');
	     	echo json_encode(array('stickyNotes' => $stickyNotes, 'todos' => $todos, 'imges' => $imges));
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

	public function deleteProject(){
		print_r($_POST);
		if($_POST['action'] = 'delete'){
			$ProjectId_verwijderd = $this->projectDAO->selectById($_POST['id_project']);
			$ProjectVerwijderen = $this->projectDAO->deleteById($_POST['id_project']);
			if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
				header('Content-Type: application/json');
		     	echo json_encode(array('Verwijderde_project' => $ProjectId_verwijderd));
		    	die();
			}
		}
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

	private function _handleAddImage(){
		$errors = array();
		$size = array();

		if(!empty($_FILES["image"])){
			if(!empty($_FILES["image"]["error"])){ $errors["image"] = "De foto kon niet geüpload worden."; }

			if(empty($errors["image"])){
				$size = getimagesize($_FILES["image"]["tmp_name"]);
				if(empty($size)){ $errors["image"] = "Upload een foto"; }
			}

			if(empty($errors["image"])){
				if($_FILES["image"]["size"] >=2097152){ 
					$errors["image"] = "De bestandsgrootte is te groot.";
				}
			}
		}

		if(empty($errors)) {

			$name = preg_replace("/\\.[^.\\s]{3,4}$/", "", $_FILES["image"]["name"]);
			$extension = 'jpg';

			$insertImage['user_id'] = $_SESSION['user']['id'];
			$insertImage['project_id'] = $_GET['id'];
			$insertImage['xPos'] = "0";
			$insertImage['yPos'] = "0";
			$insertImage['file'] = $name;
			$insertImage['extension'] = $extension;

			$imageresize = new Eventviva\ImageResize($_FILES["image"]["tmp_name"]);
			$imageresize->save(WWW_ROOT."uploads".DS.$name.".".$extension);
			$imageresize->resizeToHeight(200);
			$imageresize->save(WWW_ROOT."uploads".DS.$name."_th.".$extension);

			$this->functieDAO->insert_img($insertImage);

			if(!empty($insertImage)) {
				$_SESSION['info'] = 'De upload was succesvol!';
				$this->redirect('index.php?page=whiteboard&id=' . $_GET['id']);
			}
		}
		$_SESSION['error'] = 'De upload is mislukt.';
		$this->set('errors', $errors);
	}

	private function _handleAddStickyNote(){

		if(!empty($_POST['text'])){
			$data['project_id'] = $_POST['id'];
			$data['user_id'] = $_SESSION['user']['id'];
			$data['xPos'] = '0';
			$data['yPos'] = '0';
			$data['text'] = $_POST['text'];

			$insertedNote = $this->functieDAO->insert_stickyNote($data);
			$stickyNote_last = $this->functieDAO->selectLast_stickyNote();

			if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
				header('Content-Type: application/json');
		        echo json_encode(array('result' => true, 'stickyNote_last'=>$stickyNote_last));
		        die();
			}
		}
	}

	private function _handleAddTodo(){

		if(!empty($_POST['project_id'])){
			$data['project_id'] = $_POST['project_id'];
			$data['user_id'] = $_SESSION['user']['id'];

			$insertedTodo = $this->functieDAO->insert_todo($data);
			$todo_last = $this->functieDAO->selectLast_todo();

			if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
				header('Content-Type: application/json');
		        echo json_encode(array('result' => true, 'todo_last'=>$todo_last));
		        die();
			}
		}
	}
}