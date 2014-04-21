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
<style>
	.nav-tabs li { width:50%; }
	.nav-tabs li a { width:100%; text-align:center; font-size:16px; }
	#p_book_recipes > ul { list-style-type:none; }
	ul.item_list li div.image { float:left; height:100px; width:100px; margin-right:10px; }
	ul.item_list li  div.content { float:left; padding-top:10px; }
	ul.item_list li div.image img { height:100%; width:100%; }
</style>
<div data-role="page" id="p_book" ng-controller="p_book">
	<?php $this->load->view('dashboard_header.php'); ?>
	<div data-role="content">
		<div class="heading_block">
			<span>CookBook</span>
		</div>
		<div class="content_block">
		<ul id="p_book_tab_links" class="nav nav-tabs">
			<li class="active"><a href="#p_book_recipes" data-toggle="tab">My Recipes</a></li>
			<li><a href="#p_book_clips" data-toggle="tab">Clips</a></li>
		</ul>
		<div class="tab-content">
			<div class="tab-pane active" id="p_book_recipes">
				<ul ng-if="objects.length > 0" class="item_list">
				<li ng-repeat="item in objects" class="recipe_row">
					<div class="image"><img src="<?php echo image_url(); ?>{{item.object_images}}"/></div>
					<div class="content">
					<p>{{item.name}}</p>
					<p>{{item.tags}}</p>
					<p>{{item.created_on}}</p>
					</div>
					<p>
						<a ng-click="view(item.id)" data-role="button" href="#p_object_view">View</a>
						<a ng-click="edit(item.id)" data-role="button" href="#p_object_edit">Edit</a>
					</p>
					<div class="clear"></div>
				</li>
				</ul>
				<div ng-if="objects.length == 0">
					<p>There are no recipes in your book</p>
				</div>
			</div>
			<div class="tab-pane" id="p_book_clips">
				<ul class="item_list">
				<li ng-repeat="item in clips">
					<div class="image"><img src="<?php echo image_url(); ?>{{item.object_images}}"/></div>
					<div class="content">
					<p>{{item.name}}</p>
					<p>{{item.tags}}</p>
					<p>{{item.created_on}}</p>
					</div>
					<p>
						<a ng-click="view(item.id)" data-role="button" href="#p_object_view">View</a>
					</p>
					<div class="clear"></div>
				</li>
				</ul>
				<div ng-if="clips.length == 0">
					<p>You have not yet saved any clips.</p>
					<p>Whenever you see a recipe you'd like to save, just click the clip button!</p>
				</div>
			</div>
		</div>
	</div>
	<?php $this->load->view('dashboard_footer.php', array('page'=>'p_book')); ?>
</div>