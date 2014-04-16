<script type="text/javascript">
	function p_feed($scope, selectedService) {
		$scope.feed = [];
	
		$scope.get_feed	=	function() {
			jQuery.post("<?php echo base_url('pages/feed');?>", {}, function(data) {
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
		$scope.clip		=	function(id) {
			jQuery.post("<?php echo base_url('objects/clip');?>", {'object_id': id}, function(response) {
				response = JSON.parse(response);
				catch_validation(response);
				if(response.status == "success") {
					show_note('success', 'Recipe clipped and added to your CookBook');
				}
			});
		}
		
		$scope.get_feed();
	}
</script>
<div data-role="page" id="p_feed" ng-controller="p_feed">
	<?php $this->load->view('dashboard_header.php'); ?>
	<div data-role="content">
		<div class="heading_block">
			<span>Feed</span>
		</div>

			<div class="content_block" ng-repeat="item in feed">
				<div class="user_block">
					<img src=""/>
					<span>{{item.firstname}} {{item.lastname}}</span>
					<div class="clear"></div>
				</div>
				<div class="feed_image">
					<img src=""/>
				</div>
				<p>{{item.name}}</p>
				<p>{{item.tags}}</p>
				<p>{{item.created_on}}</p>
				<p><a ng-click="view(item.id)" href="#p_object_view">View</a></p>
				<p><a ng-click="clip(item.id)">Clip</a></p>
			</div>
			<div ng-if="feed.length == 0">
				There are no recipes to show
			</div>

	</div>
	<?php $this->load->view('dashboard_footer.php', array('page'=>'p_feed')); ?>
</div>