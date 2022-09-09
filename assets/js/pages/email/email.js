// jQuery

$(function() {
    "use strict";


        $(function() {
            "use strict";
            $("#main-wrapper").AdminSettings({
                Theme: false, // this can be true or false ( true means dark and false means light ),
                Layout: 'vertical',
                LogoBg: 'skin6', // You can change the Value to be skin1/skin2/skin3/skin4/skin5/skin6 
                NavbarBg: 'skin1', // You can change the Value to be skin1/skin2/skin3/skin4/skin5/skin6
                SidebarType: 'mini-sidebar', // You can change it full / mini-sidebar / iconbar / overlay
                SidebarColor: 'skin6', // You can change the Value to be skin1/skin2/skin3/skin4/skin5/skin6
                SidebarPosition: true, // it can be true / false ( true means Fixed and false means absolute )
                HeaderPosition: true, // it can be true / false ( true means Fixed and false means absolute )
                BoxedLayout: false, // it can be true / false ( true means Boxed and false means Fluid ) 
            });
        });
   

    var mail = $('.email-table .max-texts a');

    // Highlight row when checkbox is checked
    $('.email-table').find('tr > td:first-child').find('input[type=checkbox]').on('change', function() {
        if ($(this).is(':checked')) {
            $(this).parents('tr').addClass('selected');
        } else {
            $(this).parents('tr').removeClass('selected');
        }
    });

    $(".sl-all").on('click', function() {
        $('.email-table input:checkbox').not(this).prop('checked', this.checked);
        if ($('.email-table input:checkbox').is(':checked')) {
            $('.email-table input:checkbox').parents('tr').addClass('selected');
        } else {
            $('.email-table input:checkbox').parents('tr').removeClass('selected');
        }
    });

    
    $("#compose_mail").on("click", function() {
        $('.right-part.mail-list').fadeOut("fast");
        $('.right-part.mail-details').fadeOut("fast");
        $('.right-part.mail-compose').fadeIn("fast");
    });

    $("#cancel_compose").on("click", function() {
        $('.right-part.mail-compose').fadeOut("fast");
        $('.right-part.mail-list').fadeIn("fast");
    });

    $(mail).on("click", function() {
        $('.right-part.mail-list').fadeOut("fast");
        $('.right-part.mail-details').fadeIn("fast");
    });

    $("#back_to_inbox").on("click", function() {
        $('.right-part.mail-details').fadeOut("fast");
        $('.right-part.mail-list').fadeIn("fast");
    });

});