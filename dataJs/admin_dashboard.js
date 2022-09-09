"use strict";
/*
Template Name: Admin Template
Author: Wrappixel

File: js
*/
$(function () {


    // ============================================================== 
    // income
    // ============================================================== 
    var data = {

        labels: ['10 jan', '15 jan', '20 jan', '25 jan', '30 jan', '05 Feb', '10 Feb'],
        series: [
            [5, 4, 3, 7, 5, 10, 3]
        ]
    };

    var options = {
        axisX: {
            showGrid: false
        },
        seriesBarDistance: 1,
        chartPadding: {
            top: 15,
            right: 15,
            bottom: 5,
            left: 0
        },
        plugins: [
            Chartist.plugins.tooltip()
        ],
        width: '100%'
    };

    var responsiveOptions = [
        ['screen and (max-width: 640px)', {
            seriesBarDistance: 5,
            axisX: {
                labelInterpolationFnc: function (value) {
                    return value[0];
                }
            }
        }]
    ];
    new Chartist.Bar('.net-income', data, options, responsiveOptions);

});
