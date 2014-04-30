<script type="text/javascript">
	function p_dashboard($scope, selectedService) {
		$scope.user = [];

		$scope.get	=	function() {
			var data = {};
			$scope.user = [];
			if(selectedService.user_id != null) data.id = selectedService.user_id;
			jQuery.post("pages/dashboard", data, function(response) {
				catch_validation(response);
				if(response.status == "success") {
					$scope.user = response.data;
					$scope.$apply();
					init_tooltip();
				}
			}, "json");
		};
		
		$scope.add_friend = function(id, $event) {
			$($event.target).addClass("green_button").text("Friends");
			jQuery.post("users/add_friend", {'id':id}, function(response) {
				catch_validation(response);
			}, "json");
		}

		/**
		 * Triggers a detail view for a specific object
		 */
		$scope.view		=	function(id) {
			selectedService.id = id;
		}

	}
</script>
<style>
	.avatar_s { height:80px; width:80px; }
	.avatar_s img { height:100%; width:100%; }
	.username_title { 
		font-family: 'familiar_probold';
		font-size:20px;
		font-weight:bold;
	}
	.bottom-border {
		border-bottom:1px solid rgb(185, 176, 151);
	}
	.empty-achievement {
		width:40px; height:40px;
		background:#777; 
		border-radius:100px;
		margin:15px auto;
	}
	#dashboard_achievement_container tr > td {
		border:1px solid rgb(185, 176, 151);
		border-top:none;
		width:20%;
		text-align:center;
	}
	#dashboard_header_container { padding-bottom:1px; }
	#dashboard_header_container > .avatar_s:first-child { float: left; }
	#dashboard_header_container .rank_image { float:right; }
	#dashboard_header_container > .content { padding:20px 10px 0px; float:left; }
	#dashboard_achievement_container tr > td:last-child { border-right:none; }
	#dashboard_achievement_container tr > td:first-child { border-left:none; }
	#dashboard_achievement_container tr > td img {
		width:60px; height:60px;
	}
	#dashboard_count_container { text-align:center }
	#dashboard_count_container div > p { margin:10px 0 0; font-weight:bold; font-size:26px; }
	#dashboard_bio_container { border:1px solid rgb(185, 176, 151); border-width:1px 0 0; text-align:center; padding:10px 10px; }
	#dashboard_bio_container p { text-shadow:none; font-weight:normal; font-size:14px; }
</style>
<div data-role="page" id="p_dashboard" ng-controller="p_dashboard">
	<?php $this->load->view('dashboard_header.php'); ?>
	<div data-role="content">
		<div class="content_block">
		<div id="dashboard_header_container" class="heading_block"><!-- Top Row -->
			<div class="avatar_s">
				<img ng-if="user.avatar!=null" src="<?php echo avatar_url(); ?>{{user.avatar}}"/>
				<img ng-if="user.avatar==null" src="<?php echo image_url(); ?>no_user.gif"/>
			</div>
			<div class="content">
				<p class="username_title text-1">{{user.firstname}} {{user.lastname}}</p>
				<p class="rank_title text-2">{{user.rank.title}}</p>
			</div> 
			<div class="avatar_s rank_image rank-{{user.rank.id}}">
				<img ng-if="user.rank.id != null" src="<?php echo image_url();?>ranks/rank-{{user.rank.id}}.png"/>
			</div>
			<div class="clear"></div>
		</div>
		
		<div class="ui-grid-d" id="dashboard_count_container">
			<div class="text-1 ui-block-a">
				<p class="text-1"><span ng-if="user.num_clipped < 10">0</span>{{user.num_clips}}</p>
				<span class="text-2">Clips</span>
			</div>
			<div class="text-1 ui-block-b">
				<p class="text-1"><span ng-if="user.num_clipped < 10">0</span>{{user.num_clipped}}</p>
				<span class="text-2">Been Clipped</span>
			</div>
			<div class="text-1 ui-block-c">
				<p class="text-1"><span ng-if="user.num_recipes < 10">0</span>{{user.num_recipes}}</p>
				<span class="text-2">Recipes</span>
			</div>
			<div class="text-1 ui-block-d">
				<p class="text-1"><span ng-if="user.num_friends < 10">0</span>{{user.num_friends}}</p>
				<span class="text-2">Friends</span>
			</div>
			<div class="text-1 ui-block-e">
				<p class="text-1"><span ng-if="user.num_cash < 10">0</span>{{user.num_cash}}</p>
				<span class="text-2">Clips $</span>
			</div>
		</div>	
		<br/>
		<div class="text-3 heading_block" id="dashboard_bio_container">
			<p>{{user.bio}}</p>
		</div>
		<table width="100%"	id="dashboard_achievement_container"><!-- For Achiev -->
			<tr>
			<td ng-if="user.achievements.owned[0] != undefined">
				<img 	title="{{user.achievements.owned[0].title}} <em>{{user.achievements.owned[0].description}}</em>" rel="tooltip" 
						src="<?php echo base_url();?>htdocs/images/achievements/{{user.achievements.owned[0].image}}"/>
			</td>
			<td ng-if="user.achievements.owned[0] == undefined">
				<div class="empty-achievement"></div>
			</td>
			
			<td ng-if="user.achievements.owned[1] != undefined">
				<img 	title="{{user.achievements.owned[1].title}} <em>{{user.achievements.owned[1].description}}</em>" rel="tooltip" 
						src="<?php echo base_url();?>htdocs/images/achievements/{{user.achievements.owned[1].image}}"/>
			</td>
			<td ng-if="user.achievements.owned[1] == undefined">
				<div class="empty-achievement"></div>
			</td>
			
			<td ng-if="user.achievements.owned[2] != undefined">
				<img 	title="{{user.achievements.owned[2].title}} <em>{{user.achievements.owned[2].description}}</em>" rel="tooltip" 
						src="<?php echo base_url();?>htdocs/images/achievements/{{user.achievements.owned[2].image}}"/>
			</td>
			<td ng-if="user.achievements.owned[2] == undefined">
				<div class="empty-achievement"></div>
			</td>
			
			<td ng-if="user.achievements.owned[3] != undefined">
				<img 	title="{{user.achievements.owned[3].title}} <em>{{user.achievements.owned[3].description}}</em>" rel="tooltip" 
						src="<?php echo base_url();?>htdocs/images/achievements/{{user.achievements.owned[3].image}}"/>
			</td>
			<td ng-if="user.achievements.owned[3] == undefined">
				<div class="empty-achievement"></div>
			</td>
			
			<td ng-if="user.achievements.owned[4] != undefined">
				<img  	title="{{user.achievements.owned[4].title}} <em>{{user.achievements.owned[4].description}}</em>" rel="tooltip" 
						src="<?php echo base_url();?>htdocs/images/achievements/{{user.achievements.owned[4].image}}"/>
			</td>
			<td ng-if="user.achievements.owned[4] == undefined">
				<div class="empty-achievement"></div>
			</td>
			</tr>
			
			<tr>
				<td ng-if="user.achievements.owned[5] != undefined">
					<img 	title="{{user.achievements.owned[5].title}} <em>{{user.achievements.owned[5].description}}</em>" rel="tooltip" 
							src="<?php echo base_url();?>htdocs/images/achievements/{{user.achievements.owned[5].image}}"/>
				</td>
				<td ng-if="user.achievements.owned[5] == undefined">
					<div class="empty-achievement"></div>
				</td>
				<td ng-if="user.achievements.owned[6] != undefined">
					<img 	title="{{user.achievements.owned[6].title}} <em>{{user.achievements.owned[6].description}}</em>" rel="tooltip" 
							src="<?php echo base_url();?>htdocs/images/achievements/{{user.achievements.owned[6].image}}"/>
				</td>
				<td ng-if="user.achievements.owned[6] == undefined">
					<div class="empty-achievement"></div>
				</td>
				<td ng-if="user.achievements.owned[7] != undefined">
					<img 	title="{{user.achievements.owned[7].title}} <em>{{user.achievements.owned[7].description}}</em>" rel="tooltip" 
							src="<?php echo base_url();?>htdocs/images/achievements/{{user.achievements.owned[7].image}}"/>
				</td>
				<td ng-if="user.achievements.owned[7] == undefined">
					<div class="empty-achievement"></div>
				</td>
				<td ng-if="user.achievements.owned[8] != undefined">
					<img 	title="{{user.achievements.owned[8].title}} <em>{{user.achievements.owned[8].description}}</em>" rel="tooltip" 
							src="<?php echo base_url();?>htdocs/images/achievements/{{user.achievements.owned[8].image}}"/>
				</td>
				<td ng-if="user.achievements.owned[8] == undefined">
					<div class="empty-achievement"></div>
				</td>
				<td ng-if="user.achievements.owned[9] != undefined">
					<img 	title="{{user.achievements.owned[9].title}} <em>{{user.achievements.owned[9].description}}</em>" rel="tooltip" 
							src="<?php echo base_url();?>htdocs/images/achievements/{{user.achievements.owned[9].image}}"/>
				</td>
				<td ng-if="user.achievements.owned[9] == undefined">
					<div class="empty-achievement"></div>
				</td>
			</tr>
		</table>
		<div class="basic_form_block">
			<div ng-if="user.is_owner!=true">
				<a ng-if="user.is_friend == false" ng-click="add_friend(user.id, $event)" data-role="button" class="add_button ui-link ui-btn ui-shadow ui-corner-all">Add Friend</a>
				<a ng-if="user.is_friend == true" data-role="button" class="green_button localadd_button ui-link ui-btn ui-shadow ui-corner-all">Friends</a>
			</div>
			<div ng-if="user.is_owner==true">
				<a data-role="button" class="add_button ui-link ui-btn ui-shadow ui-corner-all" href="#p_edit_profile">Edit</a>
			</div>
		</div>
		</div>
		
	</div><!-- CLose content -->
	<?php $this->load->view('dashboard_footer.php', array('page'=>'p_dashboard')); ?>
</div>