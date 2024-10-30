<body class="kudobuzz-body">
    <div class="wraper kudobuzz">
        <div class="wraper-header">
            <div class="group-heder">
                <img class="logo" src="<?php echo plugins_url('../assets/images/kudobuzz_logo.svg', __FILE__) ?>">
            </div>	
        </div>
        <div class="wraper-content">
            <div class="group-content">
                <div class="content">
                    <div class="content-title">
                        <h3>Login to existing account.</h3>
                    </div>
                    <div class="content-desc">
                        <h4>Join the 1000s of SMBs using Kudobuzz to curate a 1,000,000+ social verifiable reviews to increase their sales</h4>
                    </div>
                </div>
                <div class="border-center">

                </div>
                <div class="content">
                    <div class="row text-center validation_status_result hide"></div>

                    <div class="pull-left" style="width: 410px; padding: 40px 20px;">

                        <form role="form" id="login-form">
                            
                            <div class="row">
                                <div class="col-md-10">
                                    <div id="show-error" style="color: crimson;font-weight: bold; font-size: 14px; margin-bottom: 2%">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <input type="hidden" name="platform" value="wordpress">
                                        <input type="hidden" name="action" value="login">
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Email -->
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label for="email">Email address</label>
                                        <input type="text" name="email" class="form-control input-sm" id="email" placeholder="Email" maxlength="50">
                                        <span class="feedback"></span>
                                    </div>
                                </div>
                            </div> 

                            <!-- Password -->
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" class="form-control input-sm" id="password" placeholder="Password">
                                        <ul>
                                            <li class="mini-links left">
                                                <a href="admin.php?page=recover-password">Forgot password</a>
                                            </li>
                                            <li class="mini-links right">
                                                <a href="admin.php?page=sign-up">New User?</a>
                                            </li>
                                        </ul>

                                        <br><span class="feedback"></span>
                                    </div>
                                </div>
                                <div id="error"></div>
                            </div>

                            <div>
                                <span id="request-feedback" class="hide" style="margin-left: 10px;color:red;"></span>
                            </div>
                            <div class="row">
                                <div class="col-md-10">
                                    <button class="button btn-orange" type="submit" id="login-btn"
                                    style="background: #D8A239;color: #fff;">Login</button>
                                </div>
                            </div>
                            <div id="error"></div>
					    </form>

				    </div>

                </div>
            </div>	
        </div>
    </div> 
    <script src="<?php echo plugins_url('../assets/js/jquery.validate-1.17.0.min.js', __FILE__) ?>" type="text/javascript"></script>   
    <script src="<?php echo plugins_url('../assets/js/app.js', __FILE__) ?>" type="text/javascript"></script>
    <script src="<?php echo plugins_url('../assets/js/login.js', __FILE__) ?>" type="text/javascript"></script>   
</body>