<!DOCTYPE html> 
<html>

<head>
	<title>VoteCasterFail</title> 
	<meta charset="utf-8">
	<meta name="apple-mobile-web-app-capable" content="yes">
 	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 

	<link rel="stylesheet" href="jquery.mobile-1.2.0.css" />

	<link rel="stylesheet" href="style.css" />
	
	<link rel="apple-touch-icon" href="appicon.png" />
	<link rel="apple-touch-startup-image" href="startup.png">
	
	<script src="jquery-1.8.2.min.js"></script>
	<script src="jquery.mobile-1.2.0.js"></script>

</head> 

	
<body> 

<!-- Start of first page: #one -->
<div data-role="page" id="one">

	<div data-role="header">
		<h1>Maps</h1>
	</div><!-- /header -->

	<div data-role="content">	
		<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
		<article>
		  <p><span id="status">Please wait whilst we try to locate you...</span></p>
		</article>
			<script type="text/javascript">
			function success(position) {
			  var s = $('#status');
			  
			  if (s.className == 'success') {
			    return;
			  }
			  
			  s.html("found you!");
			  s.addClass("success");
			  
			  var mapcanvas = document.createElement('div');
			  mapcanvas.id = 'mapcanvas';
			  mapcanvas.style.height = '400px';
			  mapcanvas.style.width = '560px';
			    
			  $('article').append(mapcanvas);
			  
			  var latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
			  var myOptions = {
			    zoom: 15,
			    center: latlng,
			    mapTypeControl: false,
			    navigationControlOptions: {style: google.maps.NavigationControlStyle.SMALL},
			    mapTypeId: google.maps.MapTypeId.ROADMAP
			  };
			  var map = new google.maps.Map(document.getElementById("mapcanvas"), myOptions);
			  
			  var marker = new google.maps.Marker({
			      position: latlng, 
			      map: map, 
			      title:"You are here!"
			  });
			}
			
			function error(msg) {
			  var s = document.querySelector('#status');
			  s.innerHTML = typeof msg == 'string' ? msg : "failed";
			  s.className = 'fail';
			}
			
			if (navigator.geolocation) {
			  navigator.geolocation.getCurrentPosition(success, error);
			} else {
			  error('not supported');
			}
		
		</script> 
	</div><!-- /content -->
	
	<div data-role="footer" data-id="samebar" class="nav-glyphish-example" data-position="fixed" data-tap-toggle="false">
		<div data-role="navbar" class="nav-glyphish-example" data-grid="b">
			<ul>
				<li><a href="index.php" id="home" data-icon="custom" class="ui-btn-active">Home</a></li>
				<li><a href="login.php" id="key" data-icon="custom">Login</a></li>
				<li><a href="map.php" id="pin" data-icon="custom">Map</a></li>
			</ul>
		</div>
	</div>
</div>
	
</div><!-- /page one -->


<script type="text/javascript">
// This handles all the swiping between each page. You really
// needn't understand it all.
$(document).on('pageshow', 'div:jqmData(role="page")', function(){

     var page = $(this), nextpage, prevpage;
     // check if the page being shown already has a binding
      if ( page.jqmData('bound') != true ){
            // if not, set blocker
            page.jqmData('bound', true)
            // bind
                .on('swipeleft.paginate', function() {
                    console.log("binding to swipe-left on "+page.attr('id'));
                    nextpage = page.next('div[data-role="page"]');
                    if (nextpage.length > 0) {
                       $.mobile.changePage(nextpage,{transition: "slide"}, false, true);
                        }
                    })
                .on('swiperight.paginate', function(){
                    console.log("binding to swipe-right "+page.attr('id'));
                    prevpage = page.prev('div[data-role="page"]');
                    if (prevpage.length > 0) {
                        $.mobile.changePage(prevpage, {transition: "slide",
	reverse: true}, true, true);
                        };
                     });
            }
        });

</script>

</body>
</html>