BCApp.service('selectedService', function($http) {
	return {
		id: null,
		props: {},
		get: function(callback) {
			$http({
				url: 'objects/view',
				method:	'GET',
				params:	{id:this.id}
			}).
			success(function(response) {
				if(response.status == "success") {
					this.props = response.data;
					callback(response.data);
				} else
					callback(false);
			});
		}
	};
});

BCApp.service('userService', function($http) {
	return {
		id: null,
		email: null,
		store: function(data) {
			if(data.hasOwnProperty('id'))
				this.id = data.id;
			if(data.hasOwnProperty('email'))
				this.email = data.email;
		}
	};
});

/**
 * Service for refreshing views
 * Each method name is the name of a view
 */
BCApp.service('refreshService', function($http) {
	return {
		p_book: function($scope) {
			$scope.$emit('p_book.populate', "");
		},
		p_object_view: function($scope) {
			$scope.$emit('p_object_view.populate', "");
		}
	};
});