<script type="text/javascript">
	function p_object_create($scope) {
		$scope.name = "";
		$scope.tags = "";
		$scope.cost = "";
		$scope.ingredients = [];
		$scope.directions = [];
		$scope.currentStep = 1;
		$scope.maxStep = 4;
		
		$scope.create	=	function() {
			var compiled_input = {};
			compiled_input['object_create_tags'] = $scope.tags;
			compiled_input['object_create_name'] = $scope.name;
			compiled_input['object_create_cost'] = $scope.cost;
			compiled_input['object_create_index'] = [];
			jQuery.map(jQuery('#object_create_ingredients .object_create_index'), function(ele, i) {
				compiled_input['object_create_index'][i] = i;
				compiled_input['object_create_quantity_'+i] = $('#object_create_quantity_'+i).val();
				compiled_input['object_create_unit_'+i] = $('#object_create_unit_'+i).val();
				compiled_input['object_create_ingredient_'+i] = $('#object_create_ingredient_'+i).val();
			});
			compiled_input['object_create_order'] = [];
			jQuery.map(jQuery('#object_create_direction .object_create_order'), function(ele, i) {
				compiled_input['object_create_order'][i] = i;
				compiled_input['object_create_direction_'+i] = $('#object_create_direction_'+i).val();
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
		
		$scope.add_direction = function() {
			$scope.directions.push( {index: $scope.directions.length, text: ""} );
			setTimeout(function() {
				$("#object_create_direction input").not('[type="hidden"]').parent('div').addClass('ui-input-text ui-body-inherit ui-corner-all ui-shadow-inset');
			}, 10);
		};
		
		$scope.next_step = function() {
			if($scope.currentStep < $scope.maxStep) {
				$('.step-'+$scope.currentStep).removeClass('step-active');
				$scope.currentStep++;
				$('.step-'+$scope.currentStep).addClass('step-active');
			}
		}
		$scope.prev_step = function() {
			if($scope.currentStep > 0) {
				$('.step-'+$scope.currentStep).removeClass('step-active');
				$scope.currentStep--;
				$('.step-'+$scope.currentStep).addClass('step-active');
			}
		}
		
		$scope.add_ingredient();
		$scope.add_direction();
	}
</script>
<style>
	.step {display:none; }
	.step.step-active { display:block; }
</style>
<div data-role="page" id="p_object_create" ng-controller="p_object_create">
	<?php $this->load->view('dashboard_header'); ?>
	<div data-role="content">
		<div class="heading_block">
			<span>Create Recipe</span>
		</div>
		<div class="step step-1 step-active">
		<div class="basic_form_block">
		<p>Take Picture</p>
		<label for="object_create_image">Add Picture</label>
		<input type="file" id="object_create_image" name="object_create_image" />
		<label for="object_create_tags">Name</label>
		<input type="text" id="object_create_name" name="object_create_name" ng-model="name" />
		<label for="object_create_tags">Tags</label>
		<input type="text" id="object_create_tags" name="object_create_tags" ng-model="tags" />
		<label for="object_create_tags">Cost</label>
		<input type="text" id="object_create_cost" name="object_create_cost" ng-model="cost" />
		<div class="step_button">
			<a data-role="button" class="green_button" ng-click="next_step()">Next</a>
		</div>
		</div>
		</div>
		<div class="step step-2">
		<div class="basic_form_block">
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
		<div class="step_button">
			<a data-role="button" class="green_button" ng-click="next_step()">Next</a>
		</div>
		<div class="step_button">
			<a data-role="button" class="green_button" ng-click="prev_step()">Back</a>
		</div>
		</div>
		</div>
		<div class="step step-3">
		<div class="basic_form_block">
		<div id="object_create_direction" ng-repeat="direction in directions">
			<input type="hidden" class="object_create_order" value="{{direction.index}}"/>
			<span>{{direction.index+1}}</span>
			<div>
				<input type="text" id="object_create_direction_{{direction.index}}" class="object_create_direction" ng-model="direction.text" />
			</div>
		</div>
		
		<a data-role="button" class="add_button" ng-click="add_direction()" >Add</a>
		<div class="step_button">
			<a data-role="button" class="green_button" ng-click="prev_step()">Back</a>
		</div>
		</div>
		</div>
		<a id="object_create" ng-click="create()" data-role="button">Create</a>
	</div>
	<?php $this->load->view('dashboard_footer.php', array('page'=>'p_object_create')); ?>
</div>