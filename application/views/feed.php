<script type="text/javascript">
	function p_feed($scope, selectedService) {
		$scope.feed = [];
		$scope.loading = false;
	
		$scope.populate	=	function() {
			$scope.$apply(function() {
				$scope.loading = true;
			});
			jQuery.post("<?php echo base_url('pages/feed');?>", {}, function(response) {
				catch_validation(response);
				if(response.status == "success") {
					jQuery.each(response.data, function(i, item) {
						$scope.feed[i] = item;
					});
					$scope.$apply();
				}
				$scope.$apply(function() {
					$scope.loading = false;
				});
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
			$($event.target).addClass("green_button").text("Clipped");
			jQuery.post("<?php echo base_url('objects/clip');?>", {'object_id': id}, function(response) {
				response = JSON.parse(response);
				catch_validation(response);
			});
		}
		
		$scope.condense = function($event) {
			var $img = $($event.target).next('.feed_image');
			if($img.hasClass('hidden')) 
				$img.show().removeClass('hidden');
			else
				$img.hide().addClass('hidden');
		}
		
		$scope.selected_user = function(id) {
			selectedService.user_id = id;
		}
		
		$scope.dashboard = function(id) {
			selectedService.user_id = id;
			redirect('#p_dashboard');
		}
	}
</script>
<div data-role="page" id="p_feed" ng-controller="p_feed">
	<?php $this->load->view('dashboard_header.php'); ?>
	<div data-role="content">
		<div class="bc-loader" ng-show="loading">
			<span class="ui-icon-loading"></span>
			<h1>Retrieving Feed...</h1>
		</div>
		<div class="heading_block">
			<div class="icon icon-home"></div>
			<span>Feed</span>
		</div>
		<div class="content_block" ng-repeat="item in feed">
			<div class="user_block" ng-click="condense($event)">
				<img class="avatar" ng-if="item.avatar != null" ng-click="dashboard(item.user_id)" src="<?php echo avatar_url(); ?>{{item.avatar}}"/>
				<img class="avatar" ng-if="item.avatar == null" ng-click="dashboard(item.user_id)" src="<?php echo image_url(); ?>no_user.gif"/>
				<span>{{item.firstname}} {{item.lastname}}</span>
				<div class="right_block">
					<div class="dollar_icon">{{item.cost}}</div>
					<a ng-if="item.is_owner == false && item.is_clipped == null" class="ui-link ui-btn ui-shadow ui-corner-all" data-role="button" ng-click="clip(item.id, $event)">Clip</a>
					<a ng-if="item.is_owner == false && item.is_clipped != null" class="green_button ui-link ui-btn ui-shadow ui-corner-all" data-role="button">Clipped</a>
				</div>
				<div class="clear"></div>
			</div>
			<div class="feed_image" ng-click="view(item.id)">
				<img ng-if="item.object_images.length > 0" src="<?php echo image_url(); ?>{{item.object_images}}" alt=""/>
				<img ng-if="item.object_images == null" src="<?php echo image_url(); ?>no_image.gif" alt=""/>
			</div>
		</div>
	</div>
	<?php $this->load->view('dashboard_footer.php', array('page'=>'p_feed')); ?>
</div>