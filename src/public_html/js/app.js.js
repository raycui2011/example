/*<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
<script>
  function contactController($scope,$http) {
     var responsePromise = $http.get("/list-contacts.php");
     $scope.myData = {};
     responsePromise.success(function(data, status, headers, config) {
        $scope.myData = data;
     });
     
     responsePromise.error(function(data, status, headers, config) {
        alert("AJAX failed!");
     });
   }
</script>
*/

var app = angular.module('myApp', []);

app.controller('tasksController', function($scope, $http) {
  getTask(); // Load all available tasks 
  function getTask(){  
  $http.post("ajax/getTask.php").success(function(data){
        $scope.tasks = data;
       });
  };
  $scope.addTask = function (task) {
    $http.post("ajax/addTask.php?task="+task).success(function(data){
        getTask();
        $scope.taskInput = "";
      });
  };
  $scope.deleteTask = function (task) {
    if(confirm("Are you sure to delete this line?")){
    $http.post("ajax/deleteTask.php?taskID="+task).success(function(data){
        getTask();
      });
    }
  };