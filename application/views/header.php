<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		
		<title><?=$title?></title>

		<script type="text/javascript">
			// Проверяю адрес в адресной строке. 
			// Если домен apps.facebook.com, то перекидываю на tab
			/*function NotInFacebookFrame() {
				return top === self;
			}
			function ReferrerIsFacebookApp() {
				if(document.referrer) {
					return document.referrer.indexOf("apps.facebook.com") != -1;
				}
				return false;
			}
			if (NotInFacebookFrame() || ReferrerIsFacebookApp()) {
				top.location.replace("");
			}*/
		</script>
		
		<script type="text/javascript" charset="utf-8">			
			/* Load the SDK Asynchronously
			(function(d){
				var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
				if (d.getElementById(id)) {return;}
				js = d.createElement('script'); js.id = id; js.async = true;
				js.src = "//connect.facebook.net/ru_RU/all.js";
				ref.parentNode.insertBefore(js, ref);
			}(document));			
			
			//JS инициализация приложения
			window.fbAsyncInit = function() {
				FB.init({ appId: '', 
					status: true, 
					cookie: true,
					xfbml: true,
					oauth: true,
					//frictionlessRequests: true
				});

				FB.Canvas.setAutoResize();
				FB.Canvas.setAutoGrow();				
				//FB.Canvas.setSize({ width: 810, height: 1250 });
			}*/
		</script>
		
		<? //inc_css('main_style'); ?>
		<? //inc_js('libs/jquery-1.7.2.min'); ?>
		<? //inc_js('libs/jquery-ui-1.8.21.custom.min'); ?>
		<? //inc_js('script'); ?>
		
		<base href=""> 

		<script type="text/javascript">
			var HOST = '<?//=HOST?>';
			var CL = '<?//=cl()?>';
			var SKIN = '<?//=SKIN_URL?>';
			var FILE = '<?//=UPLOAD_FILE_URL?>';
		</script>
		
	</head>
	<body>
		<div id="fb-root"></div>
		<div id="header"></div>