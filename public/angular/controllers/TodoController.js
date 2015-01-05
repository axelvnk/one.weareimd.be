app.controller("TodoController", function($scope, TodoFactory){

	$scope.index = function(){
		TodoFactory.index()
			.success(function(data){
				$scope.todos = data.todos;
			});
	}

	$scope.save = function(){
		var newData = {
			"todo": $scope.newTodo,
			"description": $scope.newDescription,
			"done": false
		};

		TodoFactory.create(newData)
			.success(function(data){
				$scope.todos.push(data.todos);
				$scope.newTodo="";
				$scope.newDescription="";
			});
	}

	$scope.update = function(id) {
		TodoFactory.update(id)
			.success(function(data) {
		});
	}

	$scope.delete = function(id, $index){
		TodoFactory.destroy(id)
			.success(function(data){
				$scope.todos.splice($index, 1);
			});
	}

});
