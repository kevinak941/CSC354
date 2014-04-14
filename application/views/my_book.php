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
	}
</script>
<div data-role="page" id="p_book" ng-controller="p_book">
	<div data-role="header" class="ui-persist" data-position="fixed" data-tap-toggle="false">
		<a data-icon="gear" class="ui-btn-left" onclick="show_menu(this);">Menu</a>
		<h1>Book</h1>
	</div>
	<div data-role="content">
		<h2>Recipe Book</h2>
		<div ng-repeat="item in objects">
			<p>{{item.name}}</p>
			<p>{{item.tags}}</p>
			<p>{{item.created_on}}</p>
			<p>
				<a ng-click="view(item.id)" data-role="button" href="#p_object_view">View</a>
				<a ng-click="edit(item.id)" data-role="button" href="#p_object_edit">Edit</a>
			</p>
		</div>
		<div ng-if="objects.length == 0">
			There are no recipes in your book
		</div>
	</div>
	<?php $this->load->view('dashboard_footer.php', array('page'=>'p_book')); ?>
</div>