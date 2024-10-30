<body class="kudobuzz-body">
    <div class="kudobuzz">
        <div class="wraper-header">
            <div class="group-heder">
                <img class="logo" src="<?php echo plugins_url('../assets/images/kudobuzz_logo.svg', __FILE__) ?>">
            </div>	
        </div>
        <div class="main-app-content" style="min-height: 440px; margin-bottom: 10px; text-align: center">
            <div style="margin: 0px auto 10px auto; width: 820px; overflow: hidden;">

                <div style="padding: 0px 20px; margin: 30px auto">
                    <h3>
                        <p class="main-title" style="font-size: 30px; color: #585858">Verify your account</p>
                        
                        <p>A confirmation mail has been sent into your inbox.</p>
                    </h3>
                </div>
                <form role="form" id="verify-code-form">
                    <div style="padding: 0px 20px; margin: 30px auto">
                        <div class="row">
                            <div class="col-md-10">
                                <div id="show-error" style="color: crimson;font-weight: bold; font-size: 14px; margin-bottom: 2%; margin-left:24%">
                                </div>
                            </div>
                            <div class="alert alert-info hide" id="sending_confirmation_mail"></div>
                        </div>

                        <div class="row">
                            <div class="col-md-4" style="margin-left:35%">
                                <div class="form-group">
                                    <input type="text" name="code" class="form-control input-sm" id="code" placeholder="Paste verification code here">
                                    <span class="feedback"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <input type="hidden" name="platform" value="wordpress">
                            <input type="hidden" name="action" value="verify_code">
                        </div>

                        <div class="row">
                            <div class="col-md-4" style="margin-left:35%">
                                <div>
                                    <a type="button" class="btn btn-info" id="verify-btn">Verify</a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <p style="margin-top: 20px; margin-bottom: 10px;">To resend a new confirmation email, 
                                <a href="javascript:void(0)" style="color: red;" id="resend_confirmation_link"><u>click here</u></a>.
                            </p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div id="copyright-div">
        &copy; <?php echo date('Y') ?> Kudobuzz
        </div>
    </div>
    <script src="<?php echo plugins_url('../assets/js/jquery.validate-1.17.0.min.js', __FILE__) ?>" type="text/javascript"></script>   
    <script src="<?php echo plugins_url('../assets/js/app.js', __FILE__) ?>" type="text/javascript"></script>
    <script src="<?php echo plugins_url('../assets/js/verify-email.js', __FILE__) ?>" type="text/javascript"></script>   
</body>
