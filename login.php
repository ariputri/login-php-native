<!-- FORM LOGIN -->
<!DOCTYPE html>
<html>
  
<head>
	<title>Your Web Title</title>
	<link rel="stylesheet" type="text/css" href="asset/css/style.css">
	<link rel="stylesheet" type="text/css" href="asset/css/slider.css">
	<script>
            src="https://code.jquery.com/jquery-2.2.4.min.js"
            integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
            crossorigin="anonymous">
  </script>
</head>
  
<body>
<?php //include 'component/header.php'; ?>
<style type="text/css">
	#register-page{
		width: 100%;
		font-family: arial;
	}
	
	.main-register { 
		float: left; 
		margin-left: 12%; 
	}
  
	.main-register-sidebar {
		float: right;
		margin-right: 12%;
	}
	
	input[type=text] {
		margin: 10px 0 10px 0; 
		padding: 10px ; 
		width: 400px; 
		color: #000000;
	}
  
	input[type=password] {
		margin: 10px 0 10px 0; 
		padding: 10px ; 
		width: 380px; 
		color: #000000;
	}
  
	input[type=submit] {
		margin: 10px 0 10px 0; 
		padding: 10px; 
		background: orange; 
		color: #fff; 
		border: 0; 
		outline: 0; 
		width: 200px; 
		border: 1px solid orange; 
		cursor: pointer; 
	}
	
  .has-error {
        color: #ff0000
  }
</style>

<div id="register-page" style="margin-top: 50px;">
		<div class="main-register">
			<h3>Log In With Your Account</h3>
				<form id="save-form" action="handler.php?aksi=login" method="post">
					<div>
						<input type="text" id="username" name="username" placeholder="Your Username" required="required" style="width:380px;">
						<p class="help-block help-block-error "></p>
					</div>	
 
					<div>
						<input type="password" id="password" name="password" placeholder="Your Password" required="required">
						<p class="help-block help-block-error "></p>
					</div>

					<div>
						<input type="submit" class="btn" value="Log In">
					</div>
				</form>
		</div>

<!-- JAVASCRIPT -->    
<div style="clear: both;"></div>
<?php include 'component/fotter.php'; ?>
 <script>
        function savingFormData(form, valueForm, successUrl) {
            jQuery("form#save-form .has-error, form#save-form .has-success").removeClass("has-error has-success").addClass("has-success");
            jQuery("form#save-form .help-block").empty();

            jQuery.ajax({
                dataType: 'json',
                url: form.attr("action"),
                type: "POST",
                data: valueForm,
                processData: false,
                contentType: false,
                beforeSend: function () {
                    //showSpinner();
                    jQuery(this).prop("disabled", true);
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert("Status: " + textStatus);
                    //alert("Error: " + errorThrown);
                    //console.log(errorThrown, jqXHR.responseText, jqXHR.status)
                },
                success: function (data) {
                    /*
                     * How to set delay
                     * https://stackoverflow.com/questions/33395048/set-a-delay-in-ajax-call
                     */
                    if (data.error == false) {
                    	alert(data.msg)
                        window.location.href = successUrl;
                    } else {
                        jQuery.each(data.errors, function (key, val) {
                            console.log(key);
                            parent = jQuery("#" + key).parent();
                            parent.addClass("has-error");
                            parent.find(".help-block").html(val.toString().replace(/adopter_/gi,''));
                            //console.log(yiiform.yiiActiveForm("updateAttribute", key, [val]));
                        });
                    }
                },
                complete: function (data) {
                    jQuery("form#save-form button.btn").prop("disabled", false);
                    //hideSpinner();
                }
            });
        }

        jQuery("body").on("click", "form#save-form input.btn", function (e) {
            e.preventDefault();
            //var r = confirm("You sure to save this file");
            var r = true;
            if (r == true) {
                var myForm = jQuery("#save-form");
                var savingForm = new FormData(myForm[0]);

                savingFormData(myForm, savingForm, "index.php");
            } else {
                return false;
            }
        });
    </script>
</div>
</body>
</html>
