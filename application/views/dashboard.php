<script type="text/javascript">
	function p_dashboard($scope, selectedService) {
		$scope.feed = [];

		$scope.get_feed	=	function() {
			jQuery.post("pages/dashboard", {}, function(data) {
				if(data.status == "success") {
					jQuery.each(data.data, function(i, item) {
						$scope.feed[i] = item;
					});
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

		$scope.get_feed();
	}
</script>
<div data-role="page" id="p_dashboard" ng-controller="p_dashboard">
	<div data-role="header">
		<h1>Dashboard</h1>
		<a data-icon="gear" class="ui-btn-right">Options</a>
	</div>
	<div data-role="content">
		<h2>Dashboard</h2>
		
		
		
		
		
		
		
	</div><!-- CLose content -->
	<?php $this->load->view('dashboard_footer.php', array('page'=>'p_dashboard')); ?>
</div>