<?php
  require('../controllers/cart_controller.php');
  $amount= 


  ?>
<!DOCTYPE html>
<html>
<head>
<title>Register Customer</title>

<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta property="og:title" content="Vide" />
        <meta name="keywords" content="Loozeelee Initiative" />
        <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
        function hideURLbar(){ window.scrollTo(0,1); } </script>
        <!-- //for-mobile-apps -->
        <link href="../css/bootstrap.css" rel='stylesheet' type='text/css' />
        <!-- Custom Theme files -->
        <link href="../css/style.css" rel='stylesheet' type='text/css' />
        <!-- js -->
        <script src="../js/jquery-1.11.1.min.js"></script>
        <!-- //js -->
        <!-- start-smoth-scrolling -->
        <script type="text/javascript" src="../js/move-top.js"></script>
        <script type="text/javascript" src="../js/easing.js"></script>
        <script type="text/javascript">
            jQuery(document).ready(function($) {
                $(".scroll").click(function(event){		
                    event.preventDefault();
                    $('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
                });
            });
        </script>
        <!-- start-smoth-scrolling -->
        <link href="../css/font-awesome.css" rel="stylesheet"> 
        <link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
        <link href='//fonts.googleapis.com/css?family=Noto+Sans:400,700' rel='stylesheet' type='text/css'>
        <!--- start-rate---->
        <script src="../js/jstarbox.js"></script>
            <link rel="stylesheet" href="../css/jstarbox.css" type="text/css" media="screen" charset="utf-8" />
                <script type="text/javascript">
                    jQuery(function() {
                    jQuery('.starbox').each(function() {
                        var starbox = jQuery(this);
                            starbox.starbox({
                            average: starbox.attr('data-start-value'),
                            changeable: starbox.hasClass('unchangeable') ? false : starbox.hasClass('clickonce') ? 'once' : true,
                            ghosting: starbox.hasClass('ghosting'),
                            autoUpdateAverage: starbox.hasClass('autoupdate'),
                            buttons: starbox.hasClass('smooth') ? false : starbox.attr('data-button-count') || 5,
                            stars: starbox.attr('data-star-count') || 5
                            }).bind('starbox-value-changed', function(event, value) {
                            if(starbox.hasClass('random')) {
                            var val = Math.random();
                            starbox.next().text(' '+val);
                            return val;
                            } 
                        })
                    });
                });
                </script>
        <!---//End-rate---->

</head>
<body>
	<div class="header">
    <div class="container">
      <div class="card login-card">
        <div class="row no-gutters">
          <div class="col-md-5">
            <img src="assets/images/login.jpg" alt="login" class="login-card-img">
          </div>
          <div class="col-md-7">
            <div class="card-body">
              <div class="brand-wrapper">
                <img src="assets/images/logo.svg" alt="logo" class="logo">
              </div>
              <p class="login-card-description">Log In to your account</p>
              <form action="../actions/loginprocess.php" method="POST" id="paymentForm">
              <input type="hidden" name="customer_id" id="customer_id" class="form-control" placeholder="id">
                 
                  <div class="form-group">
                    <label for="email" class="sr-only">Email</label>
                    <input type="email" name="customer_email" id="email-address" class="form-control" placeholder="Email address" required>
                  </div>
                  <div class="form-group mb-4">
                    <label for="password" class="sr-only">Password</label>
                    <input type="password" name="customer_pass" id="customer_pass" class="form-control" placeholder="Your password" required>
                  
                  </div>

		            	


                  <input type="hidden" name="amount" id="amount" class="form-control" placeholder="amount" value="amount" >

                 

                  <button type="button" name="loginUser" class="btn btn-block login-btn mb-4" value="Login" onclick="payWithPaystack()"> Log In </button>
                </form>



               <!-- <a href="#!" class="forgot-password-link">Forgot password?</a>-->
                <p class="login-card-footer-text">Don't have an account ? <a href="register.php" class="text-reset">  Register here</a></p>
                <p class="login-card-footer-text" style="align:left"> <a href="../admin/adminLogin.php" class="text-reset">  Admin</a></p>
                
                
                <nav class="login-card-footer-nav">
                  <a href="#!">Terms of use.</a>
                  <a href="#!">Privacy policy</a>
                </nav>
            </div>
          </div>
        </div>
    </div>

</div>
<!--login-->

	<div class="login">
	
		<div class="main-agileits">
				<div class="form-w3agile">
					<h3>Login</h3>
					<form action="../actions/loginprocess.php" method="post">
						<div class="key">
							<i class="fa fa-envelope" aria-hidden="true"></i>
							<input  type="text" value="Email" name="email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email';}" required="">
							<div class="clearfix"></div>
						</div>
						<div class="key">
							<i class="fa fa-lock" aria-hidden="true"></i>
							<input  type="password" value="Password" name="pass_1" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}" required="">
							<div class="clearfix"></div>
						</div>

  <!-- PAYSTACK INLINE SCRIPT -->
<script src="https://js.paystack.co/v1/inline.js"></script> 

<script>
	const paymentForm = document.getElementById('paymentForm');
	paymentForm.addEventListener("submit", payWithPaystack, false);

	// PAYMENT FUNCTION
	function payWithPaystack() {

		let handler = PaystackPop.setup({
			key: 'pk_test_447617af2ba1a2c76893a8f69a99d542d68acf41', // Replace with your public key
			email: document.getElementById("email-address").value,
			amount: document.getElementById("amount").value * 100,
			currency:'GHS',
			onClose: function(){
			alert('Window closed.');
			},
			callback: function(response){
			
				// send email, amount and reference to our server using AJAX
				 $.ajax({
					url: "../actions/payment_action.php", 
					type:"get",
					data:{'email':document.getElementById("email-address").value, 'amount':document.getElementById("amount").value, 'reference':response.reference},
					success: function(response){
						alert(response)
					},
					error: function(error){
						alert(error)
					}
				});

			}
		});
		handler.openIframe();
	}

</script>



</body>
</html>

<?php

	include_once "../services/footer.html";

?>