"use strict";

$("#ib_form").on('submit', function (event) {

    var order_track = $('#order_track').val();

    var trackingType = $('input:radio[name=trackingType]:checked').val();

    if (trackingType == 1) {

        window.location = 'track.php?order_track=' + order_track;
    } else {
        window.location = 'track_online_shopping.php?order_track=' + order_track;

    }

    event.preventDefault();



});