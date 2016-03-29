		$(document).ready(function(){			   
			
			var frm_Name	= $("#inputName");
			var frm_Phone	= $("#inputPhone");
			var frm_Email	= $("#inputEmail");
			var frm_Password	= $("#inputPassword");
			var frm_Password2	= $("#inputPassword2");
			var frm_Captcha		= $("#inputCaptcha");
			
			//On blur
			frm_Name.blur(validateName);
			frm_Phone.blur(validatePhone);
			frm_Email.blur(validateEmail);
			frm_Password.blur(validatePassword);
			frm_Password2.blur(validatePassword2);
			frm_Captcha.blur(validateCaptcha);
			//On key press
			frm_Name.keyup(validateName);
			frm_Phone.keyup(validatePhone);
			frm_Email.keyup(validateEmail);
			frm_Password.keyup(validatePassword);
			frm_Password2.keyup(validatePassword2);
			frm_Captcha.keyup(validateCaptcha);
			
			$("#frm_register").submit(function(){
				if(validateName() & validatePhone() & validateEmail() & validateCaptcha() & validatePassword() & validatePassword2()  & validatePasswords() )
					return true
				else
					return false;
			});
			
			function validateName(){
				if (frm_Name.val() == "") {
					frm_Name.closest("div.form-group").addClass("has-error");
					return false;
				}
				else {
					frm_Name.closest("div.form-group").removeClass("has-error");
					return true;
				}
			}
					
			function validatePhone(){
				if (frm_Phone.val() == "") {
					frm_Phone.closest("div.form-group").addClass("has-error");
					return false;
				}
				else {
					frm_Phone.closest("div.form-group").removeClass("has-error");
					return true;
				}
			}
			
			function validateEmail(){
				var filter = /^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$/;
				if (!filter.test(frm_Email.val())){
					frm_Email.closest("div.form-group").addClass("has-error");
					return false;
				}
				else	{
					frm_Email.closest("div.form-group").removeClass("has-error");
					return true;
				}
			}
			
			function validatePassword(){
				if (frm_Password.val() == "") {
					frm_Password.closest("div.form-group").addClass("has-error");
					return false;
				}
				else {
					frm_Password.closest("div.form-group").removeClass("has-error");
					return true;
				}
			}
			
			function validatePassword2(){
				if (frm_Password2.val() == "") {
					frm_Password2.closest("div.form-group").addClass("has-error");
					return false;
				}
				else {
					frm_Password2.closest("div.form-group").removeClass("has-error");
					return true;
				}
			}
			
			function validatePasswords(){
				if (frm_Password.val() != frm_Password2.val()) {
					frm_Password.closest("div.form-group").addClass("has-error");
					frm_Password2.closest("div.form-group").addClass("has-error");
					return false;
				}
				else {
					frm_Password.closest("div.form-group").removeClass("has-error");
					frm_Password2.closest("div.form-group").removeClass("has-error");
					return true;
				}
			}
			
			function validateCaptcha(){
				if (frm_Captcha.val() == "") {
					frm_Captcha.closest("div.form-group").addClass("has-error");
					return false;
				}
				else {
					frm_Captcha.closest("div.form-group").removeClass("has-error");
					return true;
				}
			}
		});
		
$(document).ready(function(){
			  $.doTimeout(2500, function(){
				$('.repeat.go').removeClass('go');

				return true;
			  });
			  $.doTimeout(2520, function(){
				$('.repeat').addClass('go');
				return true;
			  });
		
			function CART_view()
			{  
					$.ajax({
						type: "POST",
						url: "/shopping_cart_view.php",
						cache: false,

						success: function(html) {
							$("#modal-body").html(html);
						},
					});
			}  
				
			$("#modal-shopping-cart").on("click", function() {
				CART_view();
				$('#ModalShoppingCart').modal("show");
			});

			$(".CART-good-add").on("click", function() {			
					var add_id = $(this).data("add-id");				
					var dataString = 'add='+ add_id;
					
					$.ajax({
						type: "POST",
						url: "/shopping_cart_check.php",
						data: dataString,
						cache: false,

						beforeSend: function() {
							$("#ajaxLoading").show();  
						}, 
						success: function() {
							CART_view();
						},
						complete: function() {
							$("#ajaxLoading").hide();
							$('#ModalShoppingCart').modal("show");
						}
					});
					return false;
			});
			
			$(".CART-clean").on("click", function() {
				if (confirm('Ви дійсно бажаєте очистити кошик?')) {
					var dataString	= 'clean=true';
					
					$.ajax({
						type: "POST",
						url: "/shopping_cart_check.php",
						data: dataString,
						cache: false,

						success: function() {
							CART_view();
							$(".sp-total-items").html("0");
							$(".CART-order").addClass("disabled");
						},
					});
					CART_view();
					return false;
				}
			});
			
			$("select[name='sort']").on("change", function() {
				$("#frm-filtr-srt").submit();
			});
			$("select[name='show_kilk']").on("change", function() {
				$("#frm-filtr-srt").submit();
			});
		
			$(".CART-order").on("click", function() {
				if (confirm('Ви дійсно бажаєте оформити замовлення?')) {
					return true;
				}
				else 
					return false;
			});

		});

/* Go to top */
$(function() {
	$(window).scroll(function() {
		if($(this).scrollTop() > 700) {
			$('#toTop').fadeIn();	
		} else {
			$('#toTop').fadeOut();
		}
	});
 
	$('#toTop').click(function() {
		$('body,html').animate({scrollTop:0},800);
	});	
});

$(document).ready(function() {

// Initiate WOW animate
	new WOW().init();

	
	$("#reload-captcha").click(function() {
		//вывести новый код капча
		$('#img-captcha').attr('src','/modules/captcha/captcha.php?id='+Math.random()+'');
	}); 
	
	
/* google maps */
google.maps.visualRefresh = true;

var map;
function initialize() {
	var geocoder = new google.maps.Geocoder();
	var address = $('#map-input').text(); /* change the map-input to your address */
	var mapOptions = {
    	zoom: 15,
    	mapTypeId: google.maps.MapTypeId.ROADMAP,
     	scrollwheel: false
	};
	map = new google.maps.Map(document.getElementById('map-canvas'),mapOptions);
	
  	if (geocoder) {
      geocoder.geocode( { 'address': address}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
          if (status != google.maps.GeocoderStatus.ZERO_RESULTS) {
          map.setCenter(results[0].geometry.location);

            var infowindow = new google.maps.InfoWindow(
                {
                  content: address,
                  map: map,
                  position: results[0].geometry.location,
                });

            var marker = new google.maps.Marker({
                position: results[0].geometry.location,
                map: map, 
                title:address
            }); 

          } else {
          	alert("No results found");
          }
        }
      });
	}
}
google.maps.event.addDomListener(window, 'load', initialize);

/* end google maps */

});