<script type="text/javascript">
	function p_book($scope) {
		$scope.feed = [];
	
		$scope.populate	=	function() {
			jQuery.post("objects/book", {}, function(data) {
				if(data.status == "success") {
					jQuery.each(data.data, function(i, item) {
						$scope.feed[i] = item;
					});
					$scope.$apply();
				}
			}, "json");
		};
		
		$scope.init = function() {
			$scope.populate();
			console.log('fired');
		};
		
		$scope.$onRootScope('p_book.populate', function() {
			$scope.populate();
		});
		
		
		//$scope.init();
	}
</script>
<div data-role="page" id="p_book" ng-controller="p_book">
	<div data-role="header">
		<h1>Book</h1>
	</div>
	<div data-role="content">
		<h2>Recipe Book</h2>
		<div ng-repeat="item in feed">
			<p>{{item.name}}</p>
			<p>{{item.tags}}</p>
			<p>{{item.created_on}}</p>
		</div>
		<div ng-if="feed.length == 0">
			There are no recipes in your book
		</div>
	</div>
	<?php $this->load->view('dashboard_footer.php', array('page'=>'p_book')); ?>
</div>