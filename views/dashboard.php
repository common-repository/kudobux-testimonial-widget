
<body class="kudobuzz-body">
<div class="kudobuzz">
    <div class="wraper-header">
        <div class="group-heder">
            <img class="logo" src="<?php echo plugins_url('../assets/images/kudobuzz-logo-2.svg', __FILE__) ?>">
        </div>
    </div>
    <div class="main-app-content" style="min-height: 440px; margin-bottom: 10px; text-align: center">
        <div id="err" class="errors" style="display: none">
            <p style="color: crimson;">
                Your account wasn't created. Kindly reach out to
                <a href="mailto:help@kudobuzz.com"> Support here</a>
            </p>
        </div>
        <div id="email_err" class="kudobuzz errors" style="display: none">
        </div>
        <div style="margin: 0px auto 10px auto; width: 820px; overflow: hidden;">
            <div id="wlc" style="padding: 0px 20px; margin: 30px auto">
                <h3>
                    <p class="main-title" style="font-size: 30px; color: #585858">Welcome to Kudobuzz</p>
                    <p class="done">Click the button below to publish testimonials</p>
                    <br />
                    <p style="color: #585858;" class="busy">Please Wait .......</p>
                </h3>
            </div>
            <div class="done">
                <a id="login-btn" class="btn btn-info btn-lg" target="_blank">Start Publishing Your Testimonials Now</a>
            </div>
        </div>
    </div>
    <div id="copyright-div">
        &copy <?php echo date(  'Y')?> Kudobuzz
    </div>
</div>
<script src="<?php echo plugins_url('../assets/js/app.js', __FILE__) ?>" type="text/javascript"></script>
<script src="<?php echo plugins_url('../assets/js/signup.js', __FILE__) ?>" type="text/javascript"></script>
</body>
