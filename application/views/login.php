
<script type="text/javascript">
	function p_login($scope, userService, refreshService) {
		$scope.inputs	=	[
			{ 'type': 'text', 'label': 'Email', 'name': 'login_email', 'value': '' },
			{ 'type': 'password', 'label': 'Password', 'name': 'login_password', 'value': '' }		
		];
		
		$scope.create	=	function() {
			var compiled_input = {};
			jQuery.each($scope.inputs, function(i, item) {
				compiled_input[item.name] = item.value;
			});
			jQuery.post("users/login", compiled_input, function(response) {
				catch_validation(response);
				if(response.status == 'success') {
					userService.store(response.data);
					refreshService.p_book($scope);
					redirect('#p_dashboard');
				}
			}, "json");
		};
	}
</script>
<!-- Convert Login to wire frame -->
<div data-role="page" id="p_login" ng-controller="p_login">
	<div data-role="header">
		<h1>BudgetChef</h1>
	</div>
	<div data-role="content">
		<div ng-repeat="input in inputs">
			<label for="{{input.name}}">{{input.label}}</label>
			<input type="{{input.type}}" name="{{input.name}}" id="{{input.name}}" ng-model="input.value" ng-enter="$parent.create()" />
		</div>
		
		<a data-role="button"  ng-click="create()">Login</a>
		<a data-role="button" href="#p_register">Sign Up</a>
		
		<fb:login-button show-faces="true" width="200" max-rows="1"></fb:login-button>

	</div>
	<div data-role="footer">
	
	</div>
</div>