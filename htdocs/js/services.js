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