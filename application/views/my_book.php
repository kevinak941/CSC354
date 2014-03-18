<script type="text/javascript">
	function p_book($scope) {
		$scope.feed = [];
	
		$scope.get_feed	=	function() {
			jQuery.post("objects/book", {}, function(data) {
				if(data.status == "success") {
					jQuery.each(data.data, function(i, item) {
						$scope.feed[i] = item;
					});
					$scope.$apply();
				}
			}, "json");
		};
		
		$scope.get_feed();
	}
</script>
<div data-role="page" id="p_book" ng-controller="p_book">
	<div data-role="header">
		<h1>Dashboard</h1>
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
	<div data-role="footer">
	
	</div>
</div>