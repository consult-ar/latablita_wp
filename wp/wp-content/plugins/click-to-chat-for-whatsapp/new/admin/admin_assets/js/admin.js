// Click to Chat
document.addEventListener('DOMContentLoaded', function() {

    // M.AutoInit();

    var elems = document.querySelectorAll('select');
    M.FormSelect.init(elems, {});

    var elems = document.querySelectorAll('.collapsible');
    M.Collapsible.init(elems, {});

    var elems = document.querySelectorAll('.modal');
    M.Modal.init(elems, {});

    var elems = document.querySelectorAll('.tooltipped');
    M.Tooltip.init(elems, {});

    // var elems = document.querySelectorAll('.tabs');
    // M.Tabs.getInstance(elems, {});

});


jQuery(document).ready(function ($) {

    $('select').formSelect();
    $('.collapsible').collapsible();
    $('.modal').modal();
    $('.tooltipped').tooltip();
    
    $('.ht-ctc-color').wpColorPicker();

    // show/hide settings
    function ht_ctc_show_hide_options () {

        // default display
        var val = $('.select_show_or_hide').find(":selected").val();
        if (val == 'show') {
            $(".showbased").show();
        } else if (val == 'hide') {
            $(".hidebased").show();
        }

        // on change
        $(".select_show_or_hide").on("change", function (e) {
            
            var change_val = e.target.value;
            $(".showbased").hide();
            $(".hidebased").hide();

            if (change_val == 'show') {
                $(".showbased").show(500);
            } else if (change_val == 'hide') {
                $(".hidebased").show(500);
            }
        });

    }
    ht_ctc_show_hide_options();

    // style-3 type
    function ht_ctc_customize_s3() {

        var s3_type_val = $('.select_style_3_type').find(":selected").val();
        if (s3_type_val == 'extend') {
            $(".s3_type_extend").show();
        } else {
            $(".s3_type_extend").hide();
        }

        // on change
        $(".select_style_3_type").on("change", function (e) {
            var s3_type_change_val = e.target.value;
            if (s3_type_change_val == 'extend') {
                $(".s3_type_extend").show(500);
            } else {
                $(".s3_type_extend").hide();
            }
        });
    }
    ht_ctc_customize_s3();


    // on change - styles
    $(".chat_select_style").on("change", function (e) {
        $(".customize_styles_link").animate({ fontSize: '1.2em' }, "slow");
    });

    // Deskop, Mobile
    if ($('#hideon_desktop').is(':checked')) {
        $(".ht_ctc_admin_desktop").hide();
    }

    if ($('#hideon_mobile').is(':checked')) {
        $(".ht_ctc_admin_mobile").hide();
    }

    $(".hidebasedondevice").on("change", function (e) {
        if ($('#hideon_desktop').is(':checked')) {
            $(".ht_ctc_admin_desktop").hide();
        } else {
            $(".ht_ctc_admin_desktop").show();
        }

        if ($('#hideon_mobile').is(':checked')) {
            $(".ht_ctc_admin_mobile").hide();
        } else {
            $(".ht_ctc_admin_mobile").show();
        }
    });

    // hide nothing or hide only on one device.
    $(document).on('click', '.hidebasedondevice', function () {
        $('.hidebasedondevice').not(this).prop('checked', false);
    });

});