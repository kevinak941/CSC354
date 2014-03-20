<script type="text/javascript">
	function p_object_edit($scope) {
		$scope.name = "";
		$scope.tags = "";
		
		$scope.create	=	function() {
			var compiled_input = {};
			compiled_input['object_edit_tags'] = $scope.tags;
			compiled_input['object_edit_name'] = $scope.name;
			
			jQuery.post("objects/edit", compiled_input, function(data) {
				catch_validation(data);
			}, "json");
		};
	}
</script>
<div data-role="page" id="p_object_edit" ng-controller="p_object_edit">
	<div data-role="header">
		<a onclick="javascript:history.back();" data-icon="arrow-l" class="ui-btn-left">Back</a>
		<h1>Edit Recipe</h1>
	</div>
	<div data-role="content">
		<p>Take Picture</p>
		<label for="object_create_image">Add Picture</label>
		<input type="file" id="object_edit_image" name="object_edit_image" />
		<label for="object_create_tags">Name</label>
		<input type="text" id="object_edit_name" name="object_edit_name" ng-model="name" />
		<label for="object_create_tags">Tags</label>
		<input type="text" id="object_edit_tags" name="object_edit_tags" ng-model="tags" />
		
		<a id="object_edit" ng-click="create()" data-role="button">Create</a>
	</div>
	<?php $this->load->view('dashboard_footer.php', array('page'=>'')); ?>
</div>