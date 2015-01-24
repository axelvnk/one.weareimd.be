<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>todo met angular</title>
    <style type="text/css">
        .done {
            text-decoration: line-through;
            color: gray;
        }
    </style>
</head>
<body ng-app="todoApp">
<div class="container" ng-controller="TodoController" ng-init="index()">
    <form ng-submit="save()">
        <label for="todo">Wat moet er nog gedaan worden?</label>
        <input type="text" ng-model="newTodo" placeholder="Todo" required>
        <input type="text" ng-model="newDescription" placeholder="Description">
        <button type="submit">Bewaren</button>
    </form>
    <ul>
        <li ng-repeat="t in todos">
            <input type="checkbox" ng-model="t.done" ng-checked="t.done" ng-click="update(t.id, $index)">
            <span ng-class="{'done': t.done}">{{ t.todo }} - <i>{{ t.description }}</i></span>
            <a ng-click="delete(t.id, $index)" href="#">delete</a>
        </li>
    </ul>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.0-rc.5/angular.min.js"></script>
<script src="/angular/app.js" type="text/javascript"></script>
<script src="/angular/factories/TodoFactory.js" type="text/javascript"></script>
<script src="/angular/controllers/TodoController.js" type="text/javascript"></script>
</body>
</html>
