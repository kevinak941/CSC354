<script type="text/javascript">
	function p_edit_profile($scope, selectedService) {
		$scope.fname = "";
		$scope.lname = "";
		$scope.bio = "";
		$scope.loading = false;

		$scope.populate	=	function() {
			$scope.$apply(function() {
				$scope.loading = true;
			});
			jQuery.post("pages/dashboard", {id: null}, function(response) {
				if(response.status == "success") {
					$scope.fname = response.data.firstname;
					$scope.lname = response.data.lastname;
					$scope.bio	 = response.data.bio;
				}
				$scope.loading = false;
				$scope.$apply();
			}, "json");
		};
		
		$scope.save	=	function() {
			var compiled_input = {};
			compiled_input['profile_first_name'] = $scope.fname;
			compiled_input['profile_last_name'] = $scope.lname;
			compiled_input['profile_bio'] = $scope.bio;
			
			jQuery.post("<?php echo base_url('pages/edit_profile');?>", compiled_input, function(data) {
				if(catch_validation(data) == true) {
					selectedService.user_id = null;
					redirect('#p_dashboard');
				}
			}, "json");
		};
	}
</script>
<div data-role="page" id="p_edit_profile" ng-controller="p_edit_profile">
	<?php $this->load->view('dashboard_header.php'); ?>
	<div data-role="content">
		<div class="heading_block">
			<div class="icon icon-home"></div>
			<span>Edit Profile</span>
		</div>
		<div class="content_block">
			<div class="bc-loader" ng-show="loading">
				<span class="ui-icon-loading"></span>
				<h1>Retrieving Your Info...</h1>
			</div>
			<div class="basic_form_block">
				<label for="profile_first_name">First Name</label>
				<input type="text" id="profile_first_name" name="profile_first_name" ng-model="fname" />
				<label for="profile_first_name">Last Name</label>
				<input type="text" id="profile_last_name" name="profile_last_name" ng-model="lname" />
				<label for="profile_bio">Bio</label>
				<textarea id="profile_bio" name="profile_bio" ng-model="bio"></textarea>
				<a ng-click="save()" data-role="button">Save</a>
			</div>
		</div>
	</div><!-- CLose content -->
	<?php $this->load->view('dashboard_footer.php', array('page'=>'p_dashboard')); ?>
</div>