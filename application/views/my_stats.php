<script type="text/javascript">
	function p_stats($scope, selectedService) {
		$scope.stats = {};
	
		$scope.populate	=	function() {
			jQuery.post("<?php echo base_url('pages/stats');?>", {}, function(response) {
				if(response.status == "success") {
					$scope.stats = response.data;
					$scope.$apply();
				}
			}, "json");
		};
		
		// -- Event Handlers

		// -- Listeners
		$scope.$onRootScope('p_stats.populate', function() {
			$scope.populate();
		});
	}
</script>
<div data-role="page" id="p_stats" ng-controller="p_stats">
	<?php $this->load->view('dashboard_header.php'); ?>
	<div data-role="content">
		<ul class="scroll_list">
		<li>
			<p>Recipes: {{stats.recipes}}</p>
		</li>
		<li>
			<p>Clips: {{stats.clips}}</p>
		</li>
		</ul>
	</div>
	<?php $this->load->view('dashboard_footer.php', array('page'=>'p_book')); ?>
</div>