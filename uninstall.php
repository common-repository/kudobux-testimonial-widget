<?php

if (! defined('WP_UNINSTALL_PLUGIN')) die;


delete_option('kudobuzz_fullpage_widget');
delete_option('kudobuzz_slider_widget');
delete_option('kudobuzz_badge_widget');

update_option('kudobuzz_is_plugin_activated', false);