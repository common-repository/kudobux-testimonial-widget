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
                    <div id="send-email-div">
                        <div class="content-title">
                            <h3>Recover Password</h3>
                        </div>
                        <div class="content-desc">
                            <h4>Please provide your email for verification.</h4>
                        </div>
                    </div>

                    <div id="verify-token-div">
                        <div class="content-title">
                            <h3>Verify your email</h3>
                        </div>
                        <div class="content-desc">
                            <h4>A confirmation token has been sent into your inbox.</h4>
                        </div>
                    </div>
                </div>
                <div class="border-center">

                </div>
                <div class="content">
                    <div class="row text-center validation_status_result hide"></div>

                    <div class="pull-left" style="width: 410px; padding: 40px 20px;">

                        <form role="form" id="recover-password-form">
                            
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="show-error" style="color: crimson;font-weight: bold; font-size: 14px; margin-bottom: 2%">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <input type="hidden" name="platform" value="wordpress">
                                        <input type="hidden" name="action" value="recover_password">
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

                            <div>
                                <span id="request-feedback" class="hide" style="margin-left: 10px;color:red;"></span>
                            </div>
                            <div class="row">
                                <div class="col-md-10">
                                <ul>
                                            <li class="mini-links left">
                                                <a href="admin.php?page=login">Activate existing account</a>
                                            </li>
                                            <li class="mini-links right">
                                                <a href="admin.php?page=sign-up">New User?</a>
                                            </li>
                                        </ul>
                                    <button class="button btn-orange" type="submit" id="recover-password-btn"
                                    style="background: #D8A239;color: #fff;">Recover Password</button>
                                </div>
                            </div>
                            <div id="error"></div>
					    </form>

                        <form role="form" id="new-password-form">
                            
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="show-error" style="color: crimson;font-weight: bold; font-size: 14px; margin-bottom: 2%">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <input type="hidden" name="platform" value="wordpress">
                                        <input type="hidden" name="action" value="set_new_password">
                                    </div>
                                </div>
                            </div>

                             <!-- Token -->
                             <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label for="token">Token</label>
                                        <input type="text" name="token" class="form-control input-sm" id="token" placeholder="Paste token here">
                                        <br><span class="feedback"></span>
                                    </div>
                                </div>
                            </div> 

                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label for="password">New Password</label>
                                        <input type="password" name="newPassword" class="form-control input-sm" id="password" placeholder="Password">
                                        <span class="feedback"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group">
                                        <label for="password">Retype New Password</label>
                                        <input type="password" name="retypePassword" class="form-control input-sm" id="retype-password" placeholder="Retype Password">
                                        <span class="feedback"></span>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <span id="request-feedback" class="hide" style="margin-left: 10px;color:red;"></span>
                            </div>
                            <div class="row">
                                <div class="col-md-10">
                                    <button class="button btn-orange" type="submit" id="save-password-btn"
                                    style="background: #D8A239;color: #fff;">Save</button>
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
    <script src="<?php echo plugins_url('../assets/js/recover-password.js', __FILE__) ?>" type="text/javascript"></script>   
</body>