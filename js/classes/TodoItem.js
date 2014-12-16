module.exports = (function(){
	function TodoItem(el) {
		this.el = el;
		this.text = this.el.querySelector('.todo-item-text').innerHTML;
		this.deleteButton = this.el.querySelector('.btn-delete');
		this.deleteButton.addEventListener('click', this.deleteClickHandler.bind(this));
		this.chk = this.el.querySelector('.todo-item-checkbox');
		this.chk.addEventListener('change', this.changeHandler.bind(this));
	}
	
	TodoItem.prototype.deleteClickHandler = function(event) {
		bean.fire(this, "delete", this);
	};
	
	TodoItem.prototype.changeHandler = function(event) {
		bean.fire(this, "change", this);
	};
	
	TodoItem.prototype.toString = function() {
		return "[TodoItem " + this.text + " " + this.chk.checked + "]";
	};

	TodoItem.createWithText = function(text) {
		var template = Handlebars.compile($('#todo-template').text());
		var result = template(text);
		var el = $(result)[0];
		return new TodoItem(el);
	};

	return TodoItem;
})();