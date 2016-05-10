		$(document).ready(function(){
			jQuery("#page").click(function(event) {
				event.preventDefault(); //to stop the default loading
				var a_href = $('#page').attr('href'); // getting the a href link
				jQuery("#overlay").css('display','block'); // displaying the overlay
				jQuery("#popup").css('display','block'); // displaying the popup
				jQuery("#popup").fadeIn(500); // Displaying popup with fade in animation
				setTimeout(function() {
					jQuery("#popup").fadeIn(4000); //function to redirect the page after few seconds
						//window.location.replace("http://"+a_href); // the link
						//window.location.replace("staffSearchResult.php");
					}, 3000);
			}); 
		});