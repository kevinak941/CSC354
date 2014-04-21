<script type="text/javascript">
	function p_dashboard($scope, selectedService) {
		$scope.feed = [];

		$scope.get_feed	=	function() {
			jQuery.post("pages/dashboard", {}, function(data) {
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

		$scope.get_feed();
	}
</script>
<div data-role="page" id="p_dashboard" ng-controller="p_dashboard">
	<div data-role="header">
		<h1>Dashboard</h1>
		<a data-icon="gear" class="ui-btn-right">Options</a>
	</div>
	<div data-role="content">
		
	<div class="ui-grid-b"><!-- Top Row -->
		<div class="ui-block-a">Left Picture</div>
		<div class="ui-block-b">Username <br/>
			Cook Rank 1</div> 
		<div class="ui-block-c">Right Picture</div>
	</div>
	
	<div class="ui-grid-d">
		<div class="ui-block-a">00 <br/>
		Your Clips</div>
		<div class="ui-block-b">00 <br/>
		Been Clipped</div>
		<div class="ui-block-c">00 <br/>
		Followers</div>
		<div class="ui-block-d">00 <br/>
		Friends</div>
		<div class="ui-block-e">00 <br/>
		Clip $</div>
	</div>	
	<br/>
	<p style="border:1px solid black;">
		Person Bio: <br/>
			BioHeader1: <br/>
			BioHeader2: <br/>
			BioHeader3: <br/>
	</p>
	<div class="ui-grid-d"><!-- For Achiev -->
		<div class="ui-block-a">Achievement1</div>
		<div class="ui-block-b">Achievement2</div>
		<div class="ui-block-c">Achievement3</div>
		<div class="ui-block-d">Achievement4</div>
		<div class="ui-block-e">Achievement5</div>
		
		<div class="ui-block-f">Achievement6</div>
		<div class="ui-block-e">Achievement7</div>
		<div class="ui-block-e">Achievement8</div>
		<div class="ui-block-e">Achievement9</div>
		<div class="ui-block-e">Achievement10</div>
	</div>	
	<p>ACHIEVMENT FEED</p>
	<p>Achievement Name <br/>
	
	
	
		
		
	</div><!-- CLose content -->
	<?php $this->load->view('dashboard_footer.php', array('page'=>'p_dashboard')); ?>
</div>