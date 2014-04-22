<!DOCTYPE html>
<html lang="en" ng-app="BCApp">
	<head>
		<title>Group Project</title>
		<!-- Meta Tags -->
		<meta charset="UTF-8">
		<meta name="application-name" content="group">
		<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
        <meta http-equiv="Pragma" content="no-cache" />
		<meta http-equiv="Expires" content="-1" />
		<meta name="viewport" content="initial-scale=1, maximum-scale=1" />
		<meta name="author" content="Kevin Kern, Patrick Schemm, Youssef Mahmoud">
		<meta name="description" content="">
		<meta name="keywords" content="">
		
		<!-- Frameworks -->
		<script type="text/javascript" src="htdocs/js/frameworks/jquery.min.js"></script>
		<script type="text/javascript">
		$(document).bind("mobileinit", function() {
			$.mobile.defaultPageTransition = "none";
			$.mobile.touchOverflowEnabled = true;
		});
		</script>
		<script type="text/javascript" src="htdocs/js/frameworks/jquery.mobile.min.js"></script>
		<script type="text/javascript" src="htdocs/js/frameworks/bootstrap.min.js"></script>
		<script type="text/javascript" src="htdocs/js/frameworks/cordova-2.0.0.js"></script>
		<script type="text/javascript" src="htdocs/js/frameworks/angular.js"></script>

		
		<script type="text/javascript" src="htdocs/js/controllers.js"></script>
		<script type="text/javascript" src="htdocs/js/services.js"></script>
		<script type="text/javascript" src="htdocs/js/navigation.js"></script>
		<script type="text/javascript" src="htdocs/js/validation.js"></script>
		<script type="text/javascript" src="htdocs/js/user.js"></script>
		<script type="text/javascript" src="htdocs/js/notification.js"></script>
		<script type="text/javascript" src="htdocs/js/menu.js"></script>
		
		
		<!-- Framework Styles -->
		<link type="text/css" rel="stylesheet" href="htdocs/css/frameworks/jquery.mobile.min.css" />
		<link type="text/css" rel="stylesheet" href="htdocs/css/frameworks/jquery.mobile.icons.min.css" />
		<link type="text/css" rel="stylesheet" href="htdocs/css/frameworks/jquery.mobile.inline-png.min.css" />
		<link type="text/css" rel="stylesheet" href="htdocs/css/frameworks/jquery.mobile.structure.min.css" />
		<link type="text/css" rel="stylesheet" href="htdocs/css/frameworks/jquery.mobile.theme.min.css" />
		<link type="text/css" rel="stylesheet" href="htdocs/css/frameworks/bootstrap.min.css" />
		<link type="text/css" rel="stylesheet" href="htdocs/css/frameworks/bootstrap-theme.min.css" />
		
		<link type="text/css" rel="stylesheet" href="htdocs/css/fonts.css" />
		<link type="text/css" rel="stylesheet" href="htdocs/css/notification.css" />
		<link type="text/css" rel="stylesheet" href="htdocs/css/forms.css" />
		<link type="text/css" rel="stylesheet" href="htdocs/css/general.css" />
		<link type="text/css" rel="stylesheet" href="htdocs/css/recipes.css" />
		<link type="text/css" rel="stylesheet" href="htdocs/css/validation.css" />
		<link type="text/css" rel="stylesheet" href="htdocs/css/structure.css" />
		<link type="text/css" rel="stylesheet" href="htdocs/css/tooltip.css" />
		<link type="text/css" rel="stylesheet" href="htdocs/css/small_devices.css" />
		
		<!--Sign in Style -->
			<link type="text/css" rel="stylesheet" href="htdocs/css/signinStyle.css" /> 
		
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
			
			$(document).ready(function() {
				$('div[data-role="page"] div[data-role="header"]').each(function(i, item) {
					$(this).append($('<div class="notification"></div>'));
				});
				$('#achievement_pop').enhanceWithin().popup();
				$('input[type="text"]').textinput();
				$('input[type="password"]').textinput();
				$('#dropdown_menu').find('ul').listview();
				init_menu();
			});
		</script>
	</head>
	<body>
		<div id="fb-root">
		<div id="container">
			<div id="dropdown_menu">
				<ul data-role="listview">
					<li><a href="#p_object_search">Search</a></li>
					<li><a href="#p_book">CookBook</a></li>
					<li><a href="#">Home</a></li>
					<li><a href="#p_dashboard">Profile</a></li>
					<li><a href="#p_achievements">Achievements</a></li>
				<ul>
			</div>