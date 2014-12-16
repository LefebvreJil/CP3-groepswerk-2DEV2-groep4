var TodoInputForm = require('./TodoInputForm');
var TodoItem = require('./TodoItem');

function TodoApplication(el) {
	this.todoList = el.querySelector('.todo-list');
	this.todoItems = [];
	var todoItemElements = this.todoList.querySelectorAll('.todo-item');
	[].forEach.call(todoItemElements, function(todoItemEl){
		var todoItem = new TodoItem(todoItemEl);
		bean.on(todoItem, "delete", this.deleteTodoHandler.bind(this));
		bean.on(todoItem, "change", this.todoItemChangeHandler.bind(this));
		this.todoItems.push(todoItem);
	}, this);
	
	this.todoForm = new TodoInputForm(el.querySelector('.todo-input-form'));
	bean.on(this.todoForm, 'create-todo', this.createTodoHandler.bind(this));
	this.logTodos();
}

TodoApplication.prototype.createTodoHandler = function(text) {
	var todoItem = TodoItem.createWithText(text);
	bean.on(todoItem, "delete", this.deleteTodoHandler.bind(this));
	bean.on(todoItem, "change", this.todoItemChangeHandler.bind(this));
	this.todoItems.push(todoItem);
	this.todoList.appendChild(todoItem.el);
	this.logTodos();
};

TodoApplication.prototype.deleteTodoHandler = function(todoItem) {
	this.todoList.removeChild(todoItem.el);
	this.todoItems.splice(this.todoItems.indexOf(todoItem), 1);
	this.logTodos();
};

TodoApplication.prototype.todoItemChangeHandler = function(todoItem) {
	this.logTodos();
};

TodoApplication.prototype.logTodos = function() {
	console.log(String(this.todoItems));
};