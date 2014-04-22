<script type="text/javascript">
	function p_object_view($scope, selectedService) {
		$scope.object = false;
			// The selected object used for populating view
			
		/**
		 * Uses service to retrieve object data
		 */
		$scope.populate = function() {
			selectedService.get(function(data) {
				$scope.object = data;
			});
		};
		
		//Listen for call to populate
		$scope.$onRootScope('p_object_view.populate', function() {
			$scope.populate();
		});
	}
</script>
<style>
	#object_view_image { height:200px; width:200px; }
	#object_view_image img { height:100%; width:100%; }
</style>
<div data-role="page" id="p_object_view" ng-controller="p_object_view">
	<div data-role="header" class="ui-persist" data-position="fixed" data-tap-toggle="false">
		<a onclick="javascript:history.back();" data-icon="arrow-l" class="ui-btn-left">Back</a>
		<h1>View</h1>
	</div>
	<div data-role="content">
		<div class="heading_block">
			<span>View Recipe</span>
		</div>
		<div class="content_block">
		<div ng-if="object != false">
			<h2>{{object.name}}</h2>
			<div id="object_view_image">
				<img ng-if="item.object_images.length > 0" src="<?php echo image_url(); ?>{{object.object_images}}" alt=""/>
				<img ng-if="item.object_images == null" src="<?php echo image_url(); ?>no_image.gif" alt=""/>
			</div>
			<table cellpadding="10">
				<tr>
					<td>Tags</td>
					<td>{{object.tags}}</td>
				</tr>
				<tr>
					<td>Created On</td>
					<td>{{object.created_on}}</td>
				</tr>
			</table>
			<div ng-if="object.ingredients.length > 0">
			<h3>Ingredients</h3>
			<table cellpadding="5">
				<tr ng-repeat="ingre in object.ingredients">
					<td>
						<div class="ingredient_img" ng-if="ingre.data.image">
							<img src="htdocs/images/ingredients/{{ingre.data.image}}"/>
						</div>
					</td>
					<td>{{ingre.quantity}} {{ingre.unit}} {{ingre.data.value}}</td>
				</tr>
			</table>
			</div>
		</div>
		
		<div ng-if="object == false">
			<h2>Error</h2>
			<p>Unable to locate this item.</p>
		</div>
		</div>
	</div>
	<?php $this->load->view('dashboard_footer.php', array('page'=>'')); ?>
</div>