<script type="text/javascript">
	function p_ranks($scope) {
		$scope.ranks = [];
	
		$scope.populate	=	function() {
			jQuery.post("<?php echo base_url('pages/ranks');?>", {}, function(data) {
				if(data.status == "success") {
					jQuery.each(data.data, function(i, item) {
						$scope.ranks[i] = item;
					});
					$scope.$apply();
				}
			}, "json");
		};
		
		// -- Event Handlers

		// -- Listeners
		$scope.$onRootScope('p_achievements.populate', function() {
			$scope.populate();
		});
	}
</script>
<div data-role="page" id="p_ranks" ng-controller="p_ranks">
	<?php $this->load->view('dashboard_header.php'); ?>
	<div data-role="content">
		<div class="heading_block">
			<span>Ranks</span>
		</div>
		<div class="content_block">
			<ul class="scroll_list">
			<li ng-repeat="item in ranks">
				<div class="image">
				<img src="htdocs/images/ranks/rank-{{item.id}}.png" />
				</div>
				<div class="content">
				<p>{{item.title}}</p>
				<p>{{item.description}}</p>
				</div>
				<div class="clear"></div>
			</li>
			</ul>
			<div ng-if="ranks.length == 0">
				There are no ranks to show
			</div>
		</div>
	</div>
	<?php $this->load->view('dashboard_footer.php', array('page'=>'p_book')); ?>
</div>