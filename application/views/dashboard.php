<script type="text/javascript">
	function p_dashboard($scope, selectedService) {
		$scope.user = [];

		$scope.get	=	function() {
			jQuery.post("pages/dashboard", {}, function(response) {
				if(response.status == "success") {
					$scope.user = response.data;
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

		$scope.get();
	}
</script>
<style>
	.avatar_s { height:60px; width:60px; }
	.avatar_s img { height:100%; width:100%; }
	.username_title { 
		font-family: 'familiar_probold';
		font-size:20px;
		font-weight:bold;
	}
	.bottom-border {
		border-bottom:1px solid #000;
	}
</style>
<div data-role="page" id="p_dashboard" ng-controller="p_dashboard">
	<?php $this->load->view('dashboard_header.php'); ?>
	<div data-role="content">
		<div class="content_block">
		<div class="ui-grid-b bottom-border"><!-- Top Row -->
			<div class="ui-block-a">
				<div class="avatar_s">
					<img src="<?php echo avatar_url(); ?>{{user.avatar}}"/>
				</div>
			</div>
			<div class="ui-block-b">
				<p class="username_title">{{user.firstname}} {{user.lastname}}</p>
				<p class="rank_title">Cook Rank 1</p>
			</div> 
			<div class="ui-block-c">
				<div class="avatar_s">
					<img src="<?php echo base_url(); ?>"/>
				</div>
			</div>
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
			Clips $</div>
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
			
			<div class="ui-block-a">Achievement6</div>
			<div class="ui-block-b">Achievement7</div>
			<div class="ui-block-c">Achievement8</div>
			<div class="ui-block-d">Achievement9</div>
			<div class="ui-block-e">Achievement10</div>
		</div><br/><br/>	
		<p style="text-align:center">ACHIEVMENT FEED</p>
		<p>Achievement Name <br/>
		</div>
		
	</div><!-- CLose content -->
	<?php $this->load->view('dashboard_footer.php', array('page'=>'p_dashboard')); ?>
</div>