<script type="text/javascript">
	function p_object_create($scope) {
		$scope.name = "";
		$scope.tags = "";
		$scope.ingredients = [];
		
		$scope.create	=	function() {
			var compiled_input = {};
			compiled_input['object_create_tags'] = $scope.tags;
			compiled_input['object_create_name'] = $scope.name;
			compiled_input['object_create_index'] = [];
			jQuery.map(jQuery('#object_create_ingredients .object_create_index'), function(ele, i) {
				compiled_input['object_create_index'][i] = i;
				compiled_input['object_create_quantity_'+i] = $('#object_create_quantity_'+i).val();
				compiled_input['object_create_unit_'+i] = $('#object_create_unit_'+i).val();
				compiled_input['object_create_ingredient_'+i] = $('#object_create_ingredient_'+i).val();
			});
			
			jQuery.post("<?php echo base_url('objects/create');?>", compiled_input, function(data) {
				if(catch_validation(data) == true)
					redirect('#p_book');
			}, "json");
		};
		
		$scope.add_ingredient = function() {
			$scope.ingredients.push( {index: $scope.ingredients.length, name: "", quantity: "", unit: ""} );
			setTimeout(function() {
				$("#object_create_ingredients input").not('[type="hidden"]').textinput();//.parent('div').addClass('ingre-field');
			}, 10);
		};
		
		$scope.add_ingredient();
	}
</script>
<div data-role="page" id="p_object_create" ng-controller="p_object_create">
	<?php $this->load->view('dashboard_header'); ?>
	<div data-role="content">
		<div class="heading_block">
			<span>Create Recipe</span>
		</div>
		<div class="basic_form_block">
		<p>Take Picture</p>
		<label for="object_create_image">Add Picture</label>
		<input type="file" id="object_create_image" name="object_create_image" />
		<label for="object_create_tags">Name</label>
		<input type="text" id="object_create_name" name="object_create_name" ng-model="name" />
		<label for="object_create_tags">Tags</label>
		<input type="text" id="object_create_tags" name="object_create_tags" ng-model="tags" />
		<div id="object_create_ingredients" ng-repeat="ingredient in ingredients">
			<input type="hidden" class="object_create_index" value="{{ingredient.index}}"/>
			<label>Quantity</label>
			<input type="text" id="object_create_quantity_{{ingredient.index}}" class="object_create_quantity" ng-model="ingredient.quantity"/>
			
			<label>Measurement</label>
			<input type="text" id="object_create_unit_{{ingredient.index}}" class="object_create_unit" ng-model="ingredient.unit" />
			
			<label>Name</label>
			<input type="text" id="object_create_ingredient_{{ingredient.index}}" class="object_create_ingredient" ng-model="ingredient.name" />
			
		</div>
		<a data-role="button" class="add_button" ng-click="add_ingredient()" >Add</a>
		<a id="object_create" ng-click="create()" data-role="button">Create</a>
		</div>
	</div>
	<?php $this->load->view('dashboard_footer.php', array('page'=>'p_object_create')); ?>
</div>