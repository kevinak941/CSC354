/**
 * Function for interactions with the user
 */
 
/**
 * User class
 * For interactions for "user"
 */
function User() {
	this.id 	= 0;
	this.email 	= null;
};

var user = new User();

/**
 * Checks if user is logged in
 */
User.prototype.check = function() {
	jQuery.post('users/check/'+user.id, {}, function(result) {
		if(result.status == "success")
			return true;
		else
			return false;
	}, "json");
};
