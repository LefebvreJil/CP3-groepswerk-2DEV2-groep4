module.exports = (function(){
	function TodoInputForm(el) {
		this.el = el;
		this.input = this.el.querySelector('.todo-input');
		this.el.addEventListener('submit', this.submitHandler.bind(this));
	}

	TodoInputForm.prototype.submitHandler = function(event) {
		event.preventDefault();
		bean.fire(this, "create-todo", this.input.value);
		this.input.value = '';
	};
	
	return TodoInputForm;
})();