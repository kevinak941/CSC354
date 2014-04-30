<script type="text/javascript">
	function p_object_create($scope) {
		$scope.name = "";
		$scope.tags = "";
		$scope.cost = "";
		$scope.ingredients = [];
		$scope.directions = [];
		$scope.currentStep = 1;
		$scope.maxStep = 5;
		
		$scope.create	=	function() {
			var compiled_input = new FormData();
			compiled_input.append('object_create_tags', $scope.tags);
			compiled_input.append('object_create_name', $scope.name);
			compiled_input.append('object_create_cost', $scope.cost);
			//compiled_input['object_create_index'] = [];
			jQuery.map(jQuery('#object_create_ingredients .object_create_index'), function(ele, i) {
				compiled_input.append('object_create_index['+i+']', i);
				compiled_input.append('object_create_quantity_'+i, $('#object_create_quantity_'+i).val());
				compiled_input.append('object_create_unit_'+i, $('#object_create_unit_'+i).val());
				compiled_input.append('object_create_ingredient_'+i, $('#object_create_ingredient_'+i).val());
			});
			//compiled_input['object_create_order'] = [];
			jQuery.map(jQuery('#object_create_direction .object_create_order'), function(ele, i) {
				compiled_input.append('object_create_order['+i+']', i);
				compiled_input.append('object_create_direction_'+i, $('#object_create_direction_'+i).val());
			});

			compiled_input.append('image', document.getElementById('object_create_image').files[0]);

			$.ajax({
				url: "<?php echo base_url('objects/create');?>",
				data: compiled_input,
				processData: false,
				contentType: false,
				type: 'POST',
				success: function(response) {
					response = JSON.parse(response);
					if(catch_validation(response) == true) {
						$scope.reset();
						redirect('#p_book');
					}
				}
			});
		};
		
		$scope.reset = function() {
			$scope.ingredients = [];
			$scope.directions = [];
			$scope.name = "";
			$scope.tags = "";
			$scope.cost = "";
			$('.step').removeClass('step-active');
			$scope.currentStep = 0;
			$scope.next_step();
			$scope.add_ingredient();
			$scope.add_direction();
			$('#object_create_image').val('');
			$scope.$apply();
		}
		
		$scope.add_ingredient = function() {
			$scope.ingredients.push( {index: $scope.ingredients.length, name: "", quantity: "", unit: ""} );
			setTimeout(function() {
				$("#object_create_ingredients input").not('[type="hidden"]').textinput();//.parent('div').addClass('ingre-field');
			}, 10);
		};
		
		$scope.add_direction = function() {
			$scope.directions.push( {index: $scope.directions.length, text: ""} );
			setTimeout(function() {
				$("#object_create_direction textarea").addClass('ng-pristine ng-valid ui-input-text ui-shadow-inset ui-body-inherit ui-corner-all ui-textinput-autogrow');
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
	.step_button .next { float:right; width:49%; max-width:200px; }
	.step_button .back { float:left; width:49%; max-width:200px; }
	.step.step-active { display:block; }
	.short_banner { margin:10px 0; font-size:20px; padding:5px; background:#faf041; }
	.quantity_container { width:22%; float:left; padding-right:1%; }
	.name_container { width:50%; float:left; }
	.unit_container { width:24%; float:left; padding-right:1%; }
	.number_container { width:1%; float:left; }
	#create_chef {
		width:100%;
		max-width:400px;
		max-height:300px;
		margin:0px auto;
	}
	#create_chef img { height:100%; width:100%; }
</style>
<div data-role="page" id="p_object_create" ng-controller="p_object_create">
	<?php $this->load->view('dashboard_header'); ?>
	<div data-role="content">
		<div class="heading_block">
			<span>Create Recipe</span>
		</div>
		<div class="step step-1 step-active">
			<div id="create_chef">
				<img src="<?php echo image_url(); ?>createchef.png"/>
			</div>
			<div class="basic_form_block">
				<label for="object_create_image">Select Photo:</label>
				<input type="file" id="object_create_image" name="object_create_image" />
				<div class="step_button">
					<a data-role="button" class="next green_button" ng-click="next_step()">Next</a>
				</div>
			</div>
		</div>
		<div class="step step-2">
			<div class="sub_heading_block"><span>Basic Information</span></div>
			<div class="basic_form_block">
				
				<label for="object_create_tags">Name</label>
				<input type="text" id="object_create_name" name="object_create_name" ng-model="name" />
				<label for="object_create_tags">Tags</label>
				<input type="text" id="object_create_tags" name="object_create_tags" ng-model="tags" />
				<label for="object_create_tags">Cost</label>
				<input type="text" id="object_create_cost" name="object_create_cost" ng-model="cost" />
				<div class="step_button">
					<a data-role="button" class="back green_button" ng-click="prev_step()">Back</a>
				</div>
				<div class="step_button">
					<a data-role="button" class="next green_button" ng-click="next_step()">Next</a>
				</div>
			</div>
		</div>
		<div class="step step-3">
		<div class="sub_heading_block"><span>Ingredients</span></div>
		<div class="basic_form_block">
		<div>
			<div class="quantity_container">
				<span>Quantity</span>
			</div>
			<div class="unit_container">
				<span>Measurement</span>
			</div>
			<div class="name_container">
				<span>Name</span>
			</div>
		</div>
		<div id="object_create_ingredients" ng-repeat="ingredient in ingredients">
			<input type="hidden" class="object_create_index" value="{{ingredient.index}}"/>
			<div class="quantity_container">
				<input type="text" id="object_create_quantity_{{ingredient.index}}" class="object_create_quantity" ng-model="ingredient.quantity"/>
			</div>
			<div class="unit_container">
				<input type="text" id="object_create_unit_{{ingredient.index}}" class="object_create_unit" ng-model="ingredient.unit" />
			</div>
			<div class="name_container">
				<input type="text" id="object_create_ingredient_{{ingredient.index}}" class="object_create_ingredient" ng-model="ingredient.name" />
			</div>
			<div class="clear"></div>
		</div>
		<a data-role="button" class="add_button" ng-click="add_ingredient()" >Add</a>
		<div class="step_button">
			<a data-role="button" class="next green_button" ng-click="next_step()">Next</a>
		</div>
		<div class="step_button">
			<a data-role="button" class="back green_button" ng-click="prev_step()">Back</a>
		</div>
		</div>
		</div>
		<div class="step step-4">
			<div class="sub_heading_block"><span>Directions</span></div>
			<div class="basic_form_block">
				<div id="object_create_direction" ng-repeat="direction in directions">
					<input type="hidden" class="object_create_order" value="{{direction.index}}"/>
					<span>Step {{direction.index+1}}</span>
					<div>
						<textarea id="object_create_direction_{{direction.index}}" class="object_create_direction" ng-model="direction.text"></textarea>
					</div>
				</div>
				
				<a data-role="button" class="add_button" ng-click="add_direction()" >Add</a>
				<div class="step_button">
					<a data-role="button" class="back green_button" ng-click="prev_step()">Back</a>
				</div>
				<div class="step_button">
					<a id="object_create" class="next green_button" ng-click="create()" data-role="button">Create</a>
				</div>
			</div>
		</div>
		
	</div>
	<?php $this->load->view('dashboard_footer.php', array('page'=>'p_object_create')); ?>
</div>