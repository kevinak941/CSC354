<div id="achievement_pop" ng-controller="p_achievements">
	<a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Close</a>
	<div ng-repeat="item in new">
		<p>{{item.name}}</p>
		<p>{{item.image}}</p>
	</div>
</div>