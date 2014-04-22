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
	.empty-achievement {
		width:50px; height:50px;
		background:#777; 
		border-radius:50px;
		margin:10px auto;
	}
	#dashboard_achievement_container tr > td {
		border:1px solid #000;
		border-top:none;
		width:20%;
		text-align:center;
	}
	#dashboard_achievement_container tr > td img {
		width:60px; height:60px;
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
				<p class="rank_title">{{user.rank.title}}</p>
			</div> 
			<div class="ui-block-c">
				<div class="avatar_s">
					<img src="<?php echo base_url(); ?>"/>
				</div>
			</div>
		</div>
		
		<div class="ui-grid-d">
			<div class="ui-block-a">{{user.num_clips}}<br/>
			Your Clips</div>
			<div class="ui-block-b">{{user.num_clipped}}<br/>
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
		
		<p style="text-align:center">ACHIEVMENT FEED</p>
		<p>Achievement Name <br/>
		</div>
		
	</div><!-- CLose content -->
	<?php $this->load->view('dashboard_footer.php', array('page'=>'p_dashboard')); ?>
</div>