<script type="text/javascript">
	function p_dashboard($scope, selectedService) {
		$scope.feed = [];

		$scope.get_feed	=	function() {
			jQuery.post("<?php echo base_url('pages/dashboard');?>", {}, function(data) {
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
	<div data-role="header" class="ui-persist" data-position="fixed" data-tap-toggle="false">
		<h1>Dashboard</h1>
		<a data-icon="gear" class="ui-btn-right">Options</a>
	</div>
	<div data-role="content">
		
	<div class="ui-grid-b"><!-- Top Row -->
		<div class="ui-block-a">Left Picture</div>
		<div class="ui-block-b">John Doe</div> 
		<div class="ui-block-c">Right Picture</div>
	</div>
	
	<div class="ui-grid-d">
		<div class="ui-block-a">00</div>
		<div class="ui-block-b">00</div>
		<div class="ui-block-c">00</div>
		<div class="ui-block-d">00</div>
		<div class="ui-block-e">00</div>
	</div>		
		
	
		
		
	</div><!-- CLose content -->
	<?php $this->load->view('dashboard_footer.php', array('page'=>'p_dashboard')); ?>
</div>