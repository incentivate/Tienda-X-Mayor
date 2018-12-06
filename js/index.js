angular.module('miApp', []).controller('ctrl', function ($scope, $http) {
	
	$http.get('../php/subirImagenes.php')
		.then(function(response) {
			$scope.productos = response.data;
		}); // CIERRA EL GET
	
	$http.get('../php/borrarImagenes.php')
		.then(function(response) {
			$scope.productosParaBorrar = response.data;
		}); // CIERRA EL GET
		

		console.log($scope.productosParaBorrar);
}); // CIERRA EL MODULO