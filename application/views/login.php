<script type="text/javascript">
	function p_login($scope) {
		$scope.inputs	=	[
			{ 'type': 'text', 'label': 'Email', 'name': 'login_email', 'value': '' },
			{ 'type': 'password', 'label': 'Password', 'name': 'login_password', 'value': '' }		
		];
	}
</script>
<div data-role="page" id="p_login" ng-controller="p_login">
	<div data-role="header">
		<h1>Login</h1>
	</div>
	<div data-role="content">
		<div ng-repeat="input in inputs">
			<label for="input.name">{{input.label}}</label>
			<div class="ui-input-text ui-body-inherit ui-corner-all ui-shadow-inset">
				<input type="input.type" name="input.name" id="input.name" ng-model="input.value" />
			</div>
		</div>
		<a data-role="button">Login</a>
		<a data-role="button" href="#p_register">Sign Up</a>
		
		<fb:login-button show-faces="true" width="200" max-rows="1"></fb:login-button>

	</div>
	<div data-role="footer">
	
	</div>
</div>