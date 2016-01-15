<!-- jquery -->	

<!-- easing plugin ( optional ) -->
<script src="/js/easing.js" type="text/javascript"></script>
<!-- UItoTop plugin -->
<script src="/js/jquery.ui.totop.js" type="text/javascript"></script>
<!-- Starting the plugin -->
<script type="text/javascript">

	
	$j(document).ready(function() {
		/*
		var defaults = {
  			containerID: 'toTop', // fading element id
			containerHoverID: 'toTopHover', // fading element hover id
			scrollSpeed: 1200,
			easingType: 'linear' 
 		};
		*/
		$j().UItoTop({ easingType: 'easeOutQuart' });
	});
</script>
