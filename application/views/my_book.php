<script type="text/javascript">
	function p_book($scope, selectedService) {
		$scope.objects = [];
		$scope.clips = [];
	
		$scope.populate	=	function() {
			jQuery.post("<?php echo base_url('pages/book');?>", {}, function(data) {
				if(data.status == "success") {
					$scope.objects = data.data.objects;
					$scope.clips = data.data.clips;
					$scope.$apply();
				}
			}, "json");
		};
		
		$scope.init = function() {
			$("#p_book_tab_links li").click(function(e) {
				e.preventDefault();
				var i = $(this).index();
				$(this).tab('show');
			});
		};
		
		// -- Event Handlers
		/**
		 * Triggers a detail view for a specific object
		 */
		$scope.view		=	function(id) {
			selectedService.id = id;
			$.mobile.changePage('#p_object_view');
		}
		/**
		 * Triggers a detail view for a specific object
		 */
		$scope.edit		=	function(id) {
			selectedService.id = id;
		}
		
		// -- Listeners
		$scope.$onRootScope('p_book.populate', function() {
			$scope.populate();
		});
		
		$scope.init();
	}
</script>
<div data-role="page" id="p_book" ng-controller="p_book">
	<?php $this->load->view('dashboard_header.php'); ?>
	<div data-role="content">
		<div class="heading_block">
			<div class="icon icon-book"></div>
			<span>CookBook</span>
		</div>
		<div class="content_block">
			<ul id="p_book_tab_links" class="nav nav-tabs">
				<li class="active"><a href="#p_book_recipes" data-toggle="tab">My Recipes</a></li>
				<li><a href="#p_book_clips" data-toggle="tab">Clipped Recipes</a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="p_book_recipes">
					<ul ng-if="objects.length > 0" class="item_list">
						<li ng-repeat="item in objects">
							<div ng-click="view(item.id)">
								<div class="image">
									<img ng-if="item.object_images.length > 0" src="<?php echo image_url(); ?>{{item.object_images}}" alt=""/>
									<img ng-if="item.object_images == null" src="<?php echo image_url(); ?>no_image.gif" alt=""/>
								</div>
								<div class="content">
								<p class="title">{{item.name}}</p>
								<p>{{item.tags}}</p>
								
								</div>
								<!--<div class="control_bar">
									<a ng-click="view(item.id)" data-role="button" href="#p_object_view">View</a>
									<a ng-click="edit(item.id)" data-role="button" href="#p_object_edit">Edit</a>
								</div>-->
								<span class="date">{{item.created_on}}</span>
								<div class="clear"></div>
							</div>
						</li>
					</ul>
					<div ng-if="objects.length == 0">
						<p>There are no recipes in your book</p>
					</div>
				</div>
				<div class="tab-pane" id="p_book_clips">
					<ul class="item_list">
						<li ng-repeat="item in clips">
							<div ng-click="view(item.id)">
								<div class="image">
									<img ng-if="item.object_images.length > 0" src="<?php echo image_url(); ?>{{item.object_images}}" alt=""/>
									<img ng-if="item.object_images == null" src="<?php echo image_url(); ?>no_image.gif" alt=""/>
								</div>
								<div class="content">
									<p class="title">{{item.name}}</p>
									<p>{{item.tags}}</p>
								</div>
								<span class="date">{{item.created_on}}</span>
								<div class="clear"></div>
							</div>
						</li>
					</ul>
					<div ng-if="clips.length == 0">
						<p>You have not yet saved any clips.</p>
						<p>Whenever you see a recipe you'd like to save, just click the clip button!</p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php $this->load->view('dashboard_footer.php', array('page'=>'p_book')); ?>
</div>