<script type="text/javascript">
	function p_object_search($scope, selectedService) {
		$scope.term	= "";
			// The term input by the user
		$scope.results	= [];
			// Array of results populated by search function
		
		/**
		 * Compiles search term and sends ajax request for results
		 */
		$scope.search	=	function() {
			var compiled_input = {};
			compiled_input['object_search_search'] = $scope.term;
			
			jQuery.post("<?php echo base_url('objects/search');?>", compiled_input, function(data) {
				catch_validation(data);
				if(data.data.hasOwnProperty('results')) {
					$scope.results = data.data.results;
					$scope.$apply();
				}
			}, "json");
		};
		
		/**
		 * Triggers a detail view for a specific object
		 */
		$scope.view		=	function(id) {
			selectedService.id = id;
		}
	}
</script>
<div data-role="page" id="p_object_search" ng-controller="p_object_search">
	<div data-role="header" class="ui-persist">
		<a data-icon="gear" class="ui-btn-left" onclick="show_menu(this);">Menu</a>
		<h1>Search</h1>
	</div>
	<div data-role="content">
		<label for="object_search_search">Search Terms</label>
		<input type="text" id="object_search_search" name="object_search_search" ng-model="term" />
		
		<a id="object_search" ng-click="search()" data-role="button">Search</a>
		
		<div ng-if="results.length > 0">
			<p>Your Results</p>
			<div ng-repeat="item in results">
				<p>{{item.name}}</p>
				<p>{{item.created_on}}</p>
				<p><a ng-click="view(item.id)" href="#p_object_view" data-role="button">View</a></p>
			</div>
		</div>
	</div>
	<?php $this->load->view('dashboard_footer.php', array('page'=>'p_object_search')); ?>
</div>