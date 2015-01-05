app.factory("TodoFactory", function($http){
	var TodoFactory = {};

	TodoFactory.index = function(){
		return $http.get("/api/v1/todos");
	}

	TodoFactory.create = function(data){
		return $http.post("/api/v1/todos", data);
	}

	TodoFactory.update = function(id){
		return $http.put("/api/v1/todos/"+id);
	}

	TodoFactory.destroy = function(id)
	{
		return $http.delete("/api/v1/todos/"+id);
	}

	return TodoFactory;
});
