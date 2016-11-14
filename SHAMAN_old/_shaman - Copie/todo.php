
<!doctype html>
<html lang="en" data-framework="angularjs">
	<head>
		<meta charset="utf-8">
		<title>AngularJS • TodoMVC</title>

		<link rel="stylesheet" href="node_modules/todomvc-app-css/index.css">
		<style>


		[ng-cloak] { 



			display: none; 
width:100%;

		}





html, body { height: 100%; width: 100%; margin: 0; }.

		</style>












 <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-theme.min.css" rel="stylesheet" media="screen">

    <!-- Custom CSS -->
    <link href="css/4-col-portfolio.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/navbar-fixed-top.css" rel="stylesheet">

    <!-- Custom styles for context menu -->
    <link href="css/jquery-ui.css" type="text/css" rel="stylesheet">




  <script src="js/jquery-1.11.3.min.js" type="text/javascript"></script>
  <script src="js/jquery-ui.min.js" type="text/javascript"></script>
  <script src="js/jquery.ui-contextmenu.min.js" type="text/javascript"></script>

  <script src="js/BootstrapMenu.min.js"></script>




































	</head>
	<body ng-app="todomvc"  style="width:100%;">





<?php
include('menu_top_todos.php');
?>


<div  style="width:100%;background-color: red;"/>

		<div ng-view  style="width:100%;;background-color: red;"/></div>

		<script type="text/ng-template" id="todomvc-index.html" style="width:100%;;background-color: red;">








			<section id="todoapp" style="width:100%;">










				<header id="footer" ng-show="todos.length" ng-cloak>
				<br><br><br><br><br>
					<span id="todo-count"><strong>{{remainingCount}}</strong>
						<ng-pluralize count="remainingCount" when="{ one: 'item left', other: 'items left' }"></ng-pluralize>
					</span>
					<ul id="filters">
						<li>
							<a ng-class="{selected: status == ''} " href="#/">All</a>
						</li>
						<li>
							<a ng-class="{selected: status == 'active'}" href="#/active">Active</a>
						</li>
						<li>
							<a ng-class="{selected: status == 'completed'}" href="#/completed">Completed</a>
						</li>
					</ul>
					<button id="clear-completed" ng-click="clearCompletedTodos()" ng-show="completedCount">Clear completed</button>
				</header>




<br><br>


















				<header id="header">
					<h1>My todos</h1>
					<form id="todo-form" ng-submit="addTodo()">
						<input id="new-todo" placeholder="Add todo" ng-model="newTodo" ng-disabled="saving" autofocus>
					</form>
				</header>
				<section id="main" ng-show="todos.length" ng-cloak>
					<input id="toggle-all" type="checkbox" ng-model="allChecked" ng-click="markAll(allChecked)">
					<label for="toggle-all">Mark all as complete</label>
					<ul id="todo-list">
						<li ng-repeat="todo in todos | filter:statusFilter track by $index" ng-class="{completed: todo.completed, editing: todo == editedTodo}">
							<div class="view">
								<input class="toggle" type="checkbox" ng-model="todo.completed" ng-change="toggleCompleted(todo)">
								<label ng-dblclick="editTodo(todo)">{{todo.title}}</label>
								<button class="destroy" ng-click="removeTodo(todo)"></button>
							</div>
							<form ng-submit="saveEdits(todo, 'submit')">
								<input class="edit" ng-trim="false" ng-model="todo.title" todo-escape="revertEdits(todo)" ng-blur="saveEdits(todo, 'blur')" todo-focus="todo == editedTodo">
							</form>
						</li>
					</ul>
				</section>
				



























			</section>
			
		</script>




</div>







		<script src="node_modules/angular/angular.js"></script>
		<script src="node_modules/angular-route/angular-route.js"></script>
		<script src="node_modules/angular-resource/angular-resource.js"></script>
		<script src="js/app.js"></script>
		<script src="js/controllers/todoCtrl.js"></script>
		<script src="js/services/todoStorage.js"></script>
		<script src="js/directives/todoFocus.js"></script>
		<script src="js/directives/todoEscape.js"></script>
	</body>
</html>
