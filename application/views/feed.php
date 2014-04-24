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
			$.mobile.changePage('#p_object_view');
		}
		$scope.clip		=	function(id, $event) {
			$($event.target).text("Clipped");
			jQuery.post("<?php echo base_url('objects/clip');?>", {'object_id': id}, function(response) {
				response = JSON.parse(response);
				catch_validation(response);
				if(response.status == "success") {
					show_note('success', 'Recipe clipped and added to your CookBook');
				}
			});
		}
		
		$scope.selected_user = function(id) {
			selectedService.user_id = id;
		}
		
		$scope.dashboard = function(id) {
			selectedService.user_id = id;
			redirect('#p_dashboard');
		}
		
		$scope.get_feed();
	}
</script>
<div data-role="page" id="p_feed" ng-controller="p_feed">
	<?php $this->load->view('dashboard_header.php'); ?>
	<div data-role="content">
		<div class="heading_block">
			<div class="icon icon-home"></div>
			<span>Feed</span>
		</div>

			<div class="content_block" ng-repeat="item in feed">
				<div class="user_block">
					<img ng-click="dashboard(item.user_id)" src="<?php echo avatar_url(); ?>{{item.avatar}}"/>
					<span>{{item.firstname}} {{item.lastname}}</span>
					<div class="right_block">
						<div class="dollar_icon"></div>
						<a ng-if="item.is_clipped == null" data-role="button" ng-click="clip(item.id, $event)">Clip</a>
						<a ng-if="item.is_clipped != null" data-role="button">Clipped</a>
					</div>
					<div class="clear"></div>
				</div>
				<div class="feed_image" ng-click="view(item.id)">
					<img ng-if="item.object_images.length > 0" src="<?php echo image_url(); ?>{{item.object_images}}" alt=""/>
					<img ng-if="item.object_images == null" src="<?php echo image_url(); ?>no_image.gif" alt=""/>
				</div>
				<p>{{item.name}}</p>
				
			</div>
			<div ng-if="feed.length == 0">
				There are no recipes to show
			</div>

	</div>
	<?php $this->load->view('dashboard_footer.php', array('page'=>'p_feed')); ?>
</div>