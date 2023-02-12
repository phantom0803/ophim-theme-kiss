$(document).ready(function () {
    $(".shme").click(function () {
        $(".mm").toggleClass("shwx");
    });
    $(".expand").click(function () {
        $(".megavid").toggleClass("xp");
        $(".pd-expand").toggleClass("sxp");
    });
    $('.expand').click(function () {
        if ($('.expand').hasClass('slamdown')) {
            $('.expand').removeClass('slamdown');
            jQuery(".mvelement").prependTo(jQuery(".megavid"));
        } else {
            $('.expand').addClass('slamdown');
            jQuery(".mvelement").appendTo(jQuery(".pd-expand"));
        }
    });
    $(".gnr").click(function () {
        $(".gnrx").toggleClass("shwgx");
    });
    $(".light").click(function () {
        $(".lowvid").toggleClass("highvid");
    });
    $(".colap").click(function () {
        $(".mindes").toggleClass("alldes");
    });
    $(".topmobile").click(function () {
        $(".topmobcon").toggleClass("topmobshow");
    });
});

var defaultTheme = "darkmode";
if (localStorage.getItem("thememode") == null) {
    if (defaultTheme == "lightmode") {
        jQuery("body").addClass("lightmode");
        jQuery("body").removeClass("darkmode");
    } else {
        jQuery("body").addClass("darkmode");
        jQuery("body").removeClass("lightmode");
    }
} else if (localStorage.getItem("thememode") == "lightmode") {
    jQuery("body").addClass("lightmode");
    jQuery("body").removeClass("darkmode");
} else {
    jQuery("body").addClass("darkmode");
    jQuery("body").removeClass("lightmode");
}
if (localStorage.getItem("thememode") == null) {
    if (defaultTheme == "lightmode") {
        jQuery("#thememode input[type='checkbox']").prop('checked', false);
    } else {
        jQuery("#thememode input[type='checkbox']").prop('checked', true);
    }
} else if (localStorage.getItem("thememode") == "lightmode") {
    jQuery("#thememode input[type='checkbox']").prop('checked', false);
} else {
    jQuery("#thememode input[type='checkbox']").prop('checked', true);
}

$(".section .quickfilter").parent().remove();
if (jQuery('.epcheck li').length < 1) jQuery('.epcheck').hide();


jQuery("#thememode input[type='checkbox']").on('change', function () {
    var is_on = jQuery("#thememode input[type='checkbox']").prop("checked");
    if (is_on == false) {
        localStorage.setItem("thememode", "lightmode");
        jQuery("body").addClass("lightmode");
        jQuery("body").removeClass("darkmode");

    } else {
        localStorage.setItem("thememode", "darkmode");
        jQuery("body").removeClass("lightmode");
        jQuery("body").addClass("darkmode");
    }
});
