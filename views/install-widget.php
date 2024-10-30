
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
                        <p class="main-title" style="font-size: 30px; color: #585858">Welcome to Kudobuzz</p>
                        
                        <p>Click the button to install kudobuzz review widget on your site</p>
                    </h3>
                </div>
            </div>
            <form id="install-widget-form">
                <div>
                    <a class="btn btn-success" id="install-widget-btn">Install Review Widget</a>
                </div>
                <div id="error"></div>
                
                <input type="hidden" name="platform" value="wordpress" />
                <input type="hidden" name="action" value="install_widget" />
            </form>
        </div>
        <div id="copyright-div">
            &copy; <?php echo date('Y') ?> Kudobuzz
        </div>
    </div>  
    <script src="<?php echo plugins_url('../assets/js/jquery.validate-1.17.0.min.js', __FILE__) ?>" type="text/javascript"></script>   
    <script src="<?php echo plugins_url('../assets/js/app.js', __FILE__) ?>" type="text/javascript"></script>   
    <script src="<?php echo plugins_url('../assets/js/install-widget.js', __FILE__) ?>" type="text/javascript"></script>   
</body>