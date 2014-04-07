/**
 * For angular controllers
 */
 
var BCApp = angular
			.module('BCApp', [])
			.config(['$provide', '$locationProvider', function($provide, $locationProvider){
				$provide.decorator('$rootScope', ['$delegate', function($delegate){

					Object.defineProperty($delegate.constructor.prototype, '$onRootScope', {
						value: function(name, listener){
							var unsubscribe = $delegate.$on(name, listener);
							this.$on('$destroy', unsubscribe);
						},
						enumerable: false
					});

					$locationProvider.html5Mode(true).hashPrefix('!');
					
					return $delegate;
				}]);
			}]);

/**
 * Angular Directives
 */
BCApp.directive('ngEnter', function() {
	return function(scope, element, attrs) {
		element.bind("keydown keypress", function(event) {
			if(event.which === 13) {
				scope.$apply(function() {
					scope.$eval(attrs.ngEnter, {'event': event });
				});
				event.preventDefault();
			}
		});
	};
});
