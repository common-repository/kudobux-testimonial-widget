<br>
<body class="kudobuzz-body">
<div class="kudobuzz page_wrap" style="height: 100%">
    <div class="kudobuzz left-side" id="display-img" style="background-color: #ee8e39">
        <div  style="background-color: #ee8e39" >
            <div style="margin: auto; text-align: center; color: #fff; margin-top: 80px !important;">
                <h2 class="kudobuzz onboarding-header-text"><?php echo _("Just for us to serve you better") ?></h2>
                <img src="https://dashboard.kudobuzz.com/public/main/img/assets/kudobuzz-survey.png" style="margin-top: 70px">
            </div>
            <br><br><br><br><br>
        </div>
    </div>
    <div class="kudobuzz right-side" style="background-color: #f9f9f9;">
        <div class="wraper-header">
            <div class="wraper-header">
                <div class="group-heder" >
                    <img class="logo" src=<?php echo plugins_url('../assets/images/kudobuzz_logo.svg', __FILE__)?> />
                </div>
                <div class="content-title" style="margin-top: -20px; color:#333333; font-size:24">
                    <h3><?php echo _("Tell us about your business") ?></h3>
                    <form class="ui form" style="width: 317px; margin:auto; padding-top:10px" id="new_business_form">
                        <div class="field">
                            <input class="field-custom form-input" placeholder="<?php echo _("Business Email")?>" id="email"
                                   name="email" autocomplete="off" value="<?php echo $email ?>" type="hidden">
                        </div>
                        <div class="field">
                            <select name="platform" id="platform"  class="kudobuzz form-control">
                                <option value="wordpress">Wordpress</option>
                            </select>
                            <label for="platform" class="survey-label">
                                <?php echo _("What is your website platform?"); ?>
                            </label>
                        </div>
                        
                        <div class="field">
                            <input type="text" placeholder="Website URL" value="<?php echo get_site_url() ?>" id="url" name="url" autocomplete="off">
                            <input type="hidden" value="<?php echo get_option('kudobuzz_id')?>" id="user_id" name="user_id">
                            <input type="hidden" value="<?php echo get_option('kudobuzz_business_id')?>" id="business_id" name="business_id">
                            <label for="url" class="survey-label">
                                <?php echo _("What is your website's domain?"); ?>
                            </label>
                        </div>
                        <div class="field">
                            <input type="text" name="brand" placeholder="<?php echo _("Brand Name")?>" id="brand" name="brand">
                            <label class="survey-label">Brand Name</label>
                        </div>
                        <div class="field" style="width: 317px; padding-top: -5px">
                            <p style="color:#333333; font-size: 16px;   line-height: 1.69; text-align: left;">
                                <?php echo _("How many years have you been selling online?"); ?>
                            </p>
                            <div style="float: left; ">
                                <button id="less_than_1" style="float: left;"
                                        class="btn-radio number_of_years active" type="button" data-value="< 1">
                                    < 1 year
                                </button>
                                <button class="btn-radio number_of_years" id="one_and_two" type="button" data-value="1-2">
                                    1 - 2 years
                                </button>
                                <button class="btn-radio number_of_years" id="more_than_two" type="button" data-value="2-5">
                                    2 - 5 years
                                </button>
                                <button  style="float: left; margin-top: 5px;" id="more_than_five" class="btn-radio number_of_years"
                                         type="button" data-value="5+">
                                    5+ years
                                </button>

                            </div>
                        </div>
                        <div class="field" style="padding-top:10px">
                            <p style="color:#333333; font-size: 16px; line-height: 1.69;  text-align: left;">
                                <?php echo "How do you run this website?" ; ?>
                            </p>
                            <div class="float: left">
                                <button style="float: left;" id="part_time" class="btn-radio site_is_run active" data-value="full time" type="button">
                                    Full Time
                                </button>
                                <button id="full_time" class="btn-radio site_is_run" type="button" data-value="part time">
                                    Part Time
                                </button>
                            </div>
                        </div>
                       <div class="field">
                           <button  type="button" id="new_bz_btn"
                                    class="button btn-primary"
                                    style="background: #4a8cf2;color: #fff;border-radius: 20px;width: 317px;margin-top: 21px; height: 40px">
                                    <?php echo _("NEXT"); ?>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            &nbsp;
        </div>
    </div>
</div>
<script>
    dataLayer = [{
        'user_id': '',
        'page_name': 'create-business'
    }];
</script>
<script>
    (function(a,s,y,n,c,h,i,d,e){s.className+=' '+y;h.start=1*new Date;h.end=i=function(){s.className=s.className.replace(RegExp(' ?'+y),'')};
        (a[n]=a[n]||[]).hide=h;setTimeout(function(){i();h.end=null},c);h.timeout=c;})(window,document.documentElement,'async-hide','dataLayer',4000,
        {'GTM-PN6NFL7':true});

    (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start': new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0], j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src= 'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f); })(window,document,'script','dataLayer','GTM-K868DL2');

</script>
    </div>
    <script src="<?php echo plugins_url('../assets/js/jquery.validate-1.17.0.min.js', __FILE__) ?>" type="text/javascript"></script>   
    <script src="<?php echo plugins_url('../assets/js/app.js', __FILE__) ?>" type="text/javascript"></script>
    <script src="<?php echo plugins_url('../assets/js/create_business.js', __FILE__) ?>" type="text/javascript"></script>  
</body>