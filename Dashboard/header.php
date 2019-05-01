<!DOCTYPE html>
<html lang="en">
	<head>
	
		
		<title>PHP Chart Samples using CanvasJS</title>
		
		<!-- stylesheets -->
		<link href="/assets/bootstrap.min.css" rel="stylesheet">
		<link href="/assets/style.css" rel="stylesheet">
		<link href="/assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">
		<!-- scripts -->
		
		<!--[if lt IE 9 ]> 
		<script src="/assets/js/html5shiv.min.js"></script>
		<script src="/assets/js/respond.min.js"></script>
		<![endif]-->
		
		<!--script src="/assets/js/	"></script-->
		<script src="/assets/js/jquery-1.12.4.min.js"></script>
		<script src="/assets/js/bootstrap.min.js"></script>
		
		
		<script>
			$(function () {
				// #sidebar-toggle-button
				$('#sidebar-toggle-button').on('click', function () {
						$('#sidebar').toggleClass('sidebar-toggle');
						$('#page-content-wrapper').toggleClass('page-content-toggle');	
						fireResize();					
				});
				
				// sidebar collapse behavior
				$('#sidebar').on('show.bs.collapse', function () {
					$('#sidebar').find('.collapse.in').collapse('hide');
				});
				
				// To make current link active
				var pageURL = $(location).attr('href');
				var URLSplits = pageURL.split('/');

				//console.log(pageURL + "; " + URLSplits.length);
				//$(".sub-menu .collapse .in").removeClass("in");

				if (URLSplits.length === 5) {
					var routeURL = '/' + URLSplits[URLSplits.length - 2] + '/' + URLSplits[URLSplits.length - 1];
					var activeNestedList = $('.sub-menu > li > a[href="' + routeURL + '"]').parent();

					if (activeNestedList.length !== 0 && !activeNestedList.hasClass('active')) {
						$('.sub-menu > li').removeClass('active');
						activeNestedList.addClass('active');
						activeNestedList.parent().addClass("in");
					}
				}

				function fireResize() {
					if (document.createEvent) { // W3C
						var ev = document.createEvent('Event');
						ev.initEvent('resize', true, true);
						window.dispatchEvent(ev);
					}
					else { // IE
						element = document.documentElement;
						var event = document.createEventObject();
						element.fireEvent("onresize", event);
					}
            	}
			})
		</script>
		<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
		
	</head>
	
	<body>
		</body>