<script type="text/javascript">
	function p_stats($scope, selectedService) {
		$scope.stats = {};
	
		$scope.populate	=	function() {
			jQuery.post("pages/stats", {}, function(response) {
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
<style>
	.scroll_list {
		list-style:none;
		margin:0px;
		padding:0px;
	}
	.scroll_list li { padding:5px; }
	.scroll_list .image { float:left; }
	.scroll_list .content { float:left; margin-left:10px; }
	.scroll_list .content p:first-child { font-size:18px; margin-top:10px; }
</style>
<div data-role="page" id="p_stats" ng-controller="p_stats">
	<div data-role="header" class="ui-persist">
		<a data-icon="gear" class="ui-btn-left" onclick="show_menu(this);">Menu</a>
		<h1>Stats</h1>
	</div>
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