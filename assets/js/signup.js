(function($) {
  "use strict";
  $(document).ready(function() {
    $(".done").css("display", "none");
    kudobuzz
      .ajax(ajaxurl, "GET", { action: "create_account" })
      .success(function(data, textStatus, jqxhr) {
        $("#loading").css("display", "none");

        var response = JSON.parse(data);
        if (response.hasOwnProperty("data") && response.data.status) {
          if (
            response.data.status === "Success" &&
            response.data.msg === "new_business"
          ) {
            window.location.href = "admin.php?page=create-business";
          } else if (
            response.data.status == "Success" &&
            response.data.authUrl &&
            response.data.msg === "old_business"
          ) {
            $("#login-btn").attr("href", response.data.authUrl);
            $(".done").css("display", "inline-block");
            $(".busy").css("display", "none");
          }
        }
        if (response.errors && response.hasOwnProperty("errors")) {
          if (response.errors.title === "email_error") {
            $("#email_err").html(response.errors.msg);
            $("#email_err").css("display", "inline-block");
          } else {
            $("#err").css("display", "inline-block");
          }
          $("#login-btn").css("display", "none");
          $("#wlc").css("display", "none");
        }
      })
      .error(function(jqxhr, textStatus, error) {
        $("#err").css("display", "inline-block");
        $("#wlc").css("display", "none");
        $("#login-btn").css("display", "none");
      });
  });
})(jQuery);
