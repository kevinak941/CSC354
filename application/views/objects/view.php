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
	#object_view_image { width:100%; max-width:800px; margin:0px auto;}
	#object_view_image img { height:100%; width:100%; }
	.info-list { list-style-type:none; background:#F9EFBD; margin:0; padding:0;}
	.info-list > li { font-size:12px; padding:10px; background:#F9EFBD; border-bottom:1px solid rgb(185, 176, 151) }
	.info-list > li:nth-child(even) { background: #FDFAEE; }
	.info-list > li:last-child { border-bottom:none; }
	.info-list > li > span { float:right; font-weight:bold; }
</style>
<div data-role="page" id="p_object_view" ng-controller="p_object_view">
	<div data-role="header" class="ui-persist" data-position="fixed" data-tap-toggle="false">
		<a onclick="javascript:history.back();" data-icon="arrow-l" class="ui-btn-left">Back</a>
		<h1>Budget Chef</h1>
	</div>
	<div data-role="content">
		<div class="heading_block">
			<span>{{object.name}}</span>
		</div>
		<div class="content_block">
		<div ng-if="object != false">
			<div id="object_view_image">
				<img ng-if="object.object_images != null" src="<?php echo image_url(); ?>{{object.object_images}}" alt=""/>
				<img ng-if="object.object_images == null" src="<?php echo image_url(); ?>no_image.gif" alt=""/>
			</div>
			<div ng-if="object.ingredients.length > 0">
			<div class="sub_heading_block">
				<span>Ingredients</span>
			</div>
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
			<div>
				<div class="sub_heading_block">
					<span>Info</span>
				</div>
				<ul class="info-list">
					<li> Owner 
						<span ng-if="object.firstname != null && object.lastname != null">{{object.firstname}} {{object.lastname}}</span>
						<span ng-if="object.firstname == null || object.lastname == null">User #{{object.user_id}}</span>
					</li>
					<li>
					Tags
					<span>{{object.tags}}</span>
					</li>
					
					<li>
					Created On
					<span>{{object.created_on}}</span>
					</li>
				</ul>
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