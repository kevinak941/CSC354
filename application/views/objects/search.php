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
			$.mobile.changePage('#p_object_view');
		}
	}
</script>
<div data-role="page" id="p_object_search" ng-controller="p_object_search">
	<?php $this->load->view('dashboard_header.php'); ?>
	<div data-role="content">
		<div class="heading_block">
			<span>Search</span>
		</div>
		<div class="content_block">
		<label for="object_search_search">Search Terms</label>
		<input type="text" id="object_search_search" name="object_search_search" ng-model="term" />
		
		<a id="object_search" ng-click="search()" data-role="button">Search</a>
		
		<div ng-if="results.length > 0">
			<ul class="item_list">
				<li ng-repeat="item in results">
					<div ng-click="view(item.id)">
						<div class="image">
							<img ng-if="item.object_images.length > 0" src="<?php echo image_url(); ?>{{item.object_images}}" alt=""/>
							<img ng-if="item.object_images == null" src="<?php echo image_url(); ?>no_image.gif" alt=""/>
						</div>
						<div class="content">
							<p class="title">{{item.name}}</p>
						</div>
						<span class="date">{{item.created_on}}</span>
						<div class="clear"></div>
					</div>
				</li>
			</ul>
		</div>
		</div>
	</div>
	<?php $this->load->view('dashboard_footer.php', array('page'=>'p_object_search')); ?>
</div>