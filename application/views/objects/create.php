<script type="text/javascript">
	function p_object_create($scope) {
		$scope.name = "";
		$scope.tags = "";
		
		$scope.create	=	function() {
			var compiled_input = {};
			compiled_input['object_create_tags'] = $scope.tags;
			compiled_input['object_create_name'] = $scope.name;
			
			jQuery.post("objects/create", compiled_input, function(data) {
				catch_validation(data);
			}, "json");
		};
	}
</script>
<div data-role="page" id="p_object_create" ng-controller="p_object_create">
	<div data-role="header">
		<a onclick="javascript:history.back();" data-icon="arrow-l" class="ui-btn-left">Back</a>
		<h1>Create Recipe</h1>
	</div>
	<div data-role="content">
		<p>Take Picture</p>
		<label for="object_create_image">Add Picture</label>
		<input type="file" id="object_create_image" name="object_create_image" />
		<label for="object_create_tags">Name</label>
		<input type="text" id="object_create_name" name="object_create_name" ng-model="name" />
		<label for="object_create_tags">Tags</label>
		<input type="text" id="object_create_tags" name="object_create_tags" ng-model="tags" />
		
		<a id="object_create" ng-click="create()" data-role="button">Create</a>
	</div>
	<div data-role="footer">
	
	</div>
</div>