<script type="text/javascript">
	function p_achievements($scope, selectedService) {
		$scope.achievements = [];
		$scope.new = [];
	
		$scope.populate	=	function() {
			jQuery.post("<?php echo base_url('pages/achievements');?>", {}, function(data) {
				if(data.status == "success") {
					jQuery.each(data.data.achievements, function(i, item) {
						$scope.achievements[i] = item;
					});
					$scope.new = data.data.new;
					if($scope.new.length > 0) {
						//$('#achievement_pop').popup('open');
					}
					$scope.$apply();
				}
			}, "json");
		};
		
		// -- Event Handlers

		// -- Listeners
		$scope.$onRootScope('p_achievements.populate', function() {
			$scope.populate();
		});
	}
</script>
<style>
	.scroll_list {
		list-style:none;
		margin:0px;
		padding:0px;
	}
	.scroll_list li { padding:5px; }
	.scroll_list .image { float:left; }
	.scroll_list .content { float:left; margin-left:10px; }
	.scroll_list .content p:first-child { font-size:18px; margin-top:10px; }
</style>
<div data-role="page" id="p_achievements" ng-controller="p_achievements">
	<div data-role="header" class="ui-persist" data-position="fixed" data-tap-toggle="false">
		<a data-icon="gear" class="ui-btn-left" onclick="show_menu(this);">Menu</a>
		<h1>Achievements</h1>
	</div>
	<div data-role="content">
		<ul class="scroll_list">
		<li ng-repeat="item in achievements" ng-class="{'transparent': !item.owned}">
			<div class="image">
			<img src="htdocs/images/achievements/{{item.image}}" />
			</div>
			<div class="content">
			<p>{{item.title}}</p>
			<p>{{item.description}}</p>
			</div>
			<div class="clear"></div>
		</li>
		</ul>
		<div ng-if="achievements.length == 0">
			There are no achievements to show
		</div>
	</div>
	<?php $this->load->view('dashboard_footer.php', array('page'=>'p_book')); ?>
</div>