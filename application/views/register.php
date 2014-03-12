<script type="text/javascript">
	function p_register($scope) {
		$scope.inputs	=	[
			{ 'type': 'text', 'label': 'Email', 'name': 'register_email', 'value': '' },
			{ 'type': 'password', 'label': 'Password', 'name': 'register_password', 'value': '' },	
			{ 'type': 'password', 'label': 'Confirm Password', 'name': 'register_password_confirm', 'value': '' }
		];
		
		$scope.create	=	function() {
			var compiled_input = {};
			jQuery.each($scope.inputs, function(i, item) {
				compiled_input[item.name] = item.value;
			});
			jQuery.post("login/register", compiled_input, function(data) {
				catch_validation(data);
			}, "json");
		};
	}
</script>
<div data-role="page" id="p_register" ng-controller="p_register">
	<div data-role="header">
		<a onclick="javascript:history.back();" data-icon="arrow-l" class="ui-btn-left">Back</a>
		<h1>Register</h1>
	</div>
	<div data-role="content">
		<div ng-repeat="input in inputs">
			<label for="{{input.name}}">{{input.label}}</label>
			<input type="{{input.type}}" name="{{input.name}}" id="{{input.name}}" ng-model="input.value" />
		</div>
		<a id="register_create" ng-click="create()" data-role="button">Create</a>
	</div>
	<div data-role="footer">
	
	</div>
</div>