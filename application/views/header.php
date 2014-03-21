<!DOCTYPE html>
<html lang="en" ng-app="BCApp">
	<head>
		<title>Group Project</title>
		<!-- Meta Tags -->
		<meta charset="UTF-8">
		<meta name="application-name" content="group">
		<meta name="author" content="Kevin Kern, Patrick Schemm, Youssef Mahmoud">
		<meta name="description" content="">
		<meta name="keywords" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		
		<!-- Frameworks -->
		<script type="text/javascript" src="htdocs/js/frameworks/jquery.min.js"></script>
		<script type="text/javascript" src="htdocs/js/frameworks/jquery.mobile.min.js"></script>
		<script type="text/javascript" src="htdocs/js/frameworks/bootstrap.min.js"></script>
		<!--<script type="text/javascript" src="htdocs/js/frameworks/cordova.js"></script>-->
		<script type="text/javascript" src="htdocs/js/frameworks/angular.js"></script>
		
		<script type="text/javascript" src="htdocs/js/controllers.js"></script>
		<script type="text/javascript" src="htdocs/js/services.js"></script>
		<script type="text/javascript" src="htdocs/js/validation.js"></script>
		<script type="text/javascript" src="htdocs/js/user.js"></script>
		
		<!-- Framework Styles -->
		<link type="text/css" rel="stylesheet" href="htdocs/css/frameworks/jquery.mobile.min.css" />
		<link type="text/css" rel="stylesheet" href="htdocs/css/frameworks/jquery.mobile.icons.min.css" />
		<link type="text/css" rel="stylesheet" href="htdocs/css/frameworks/jquery.mobile.inline-png.min.css" />
		<link type="text/css" rel="stylesheet" href="htdocs/css/frameworks/jquery.mobile.structure.min.css" />
		<link type="text/css" rel="stylesheet" href="htdocs/css/frameworks/jquery.mobile.theme.min.css" />
		<link type="text/css" rel="stylesheet" href="htdocs/css/frameworks/bootstrap.min.css" />
		<link type="text/css" rel="stylesheet" href="htdocs/css/frameworks/bootstrap-theme.min.css" />
		
		<script type="text/javascript">
			window.fbAsyncInit = function() {
			FB.init({
			appId      : '261157010728348',
			status     : true, 
			cookie     : true, 
			xfbml      : true  
			});

			FB.Event.subscribe('auth.authResponseChange', function(response) {
				if (response.status !== 'connected')
					FB.login();
				});
			};

			// Load the SDK asynchronously
			(function(d){
			var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
			if (d.getElementById(id)) {return;}
			js = d.createElement('script'); js.id = id; js.async = true;
			js.src = "//connect.facebook.net/en_US/all.js";
			ref.parentNode.insertBefore(js, ref);
			}(document));
		</script>
	</head>
	<body>
		<div id="fb-root">
		<div id="container">
		