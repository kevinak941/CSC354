<script type="text/javascript">
	function p_object_search($scope) {
		$scope.search	= "";
		$scope.results	= [];
		
		$scope.create	=	function() {
			var compiled_input = {};
			compiled_input['object_search_search'] = $scope.search;
			
			jQuery.post("objects/search", compiled_input, function(data) {
			console.log(data);
				catch_validation(data);
				if(data.data.hasOwnProperty('results')) {
					$scope.results = data.data.results;
					$scope.$apply();
					console.log($scope.results);
				}
			}, "json");
		};
	}
</script>
<div data-role="page" id="p_object_search" ng-controller="p_object_search">
	<div data-role="header">
		<a onclick="javascript:history.back();" data-icon="arrow-l" class="ui-btn-left">Back</a>
		<h1>Search</h1>
	</div>
	<div data-role="content">
		<label for="object_search_search">Search Terms</label>
		<input type="text" id="object_search_search" name="object_search_search" ng-model="search" />
		
		<a id="object_search" ng-click="create()" data-role="button">Search</a>
		
		<div ng-if="results.length > 0">
			<p>Your Results</p>
			<div ng-repeat="item in results">
				<p>{{item.name}}</p>
				<p>{{item.created_on}}</p>
			</div>
		</div>
	</div>
	<?php $this->load->view('dashboard_footer.php', array('page'=>'p_object_search')); ?>
</div>