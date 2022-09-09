"use strict";
$(function () {
    $('a.delete').on('click', function () {
        var parent = $(this).closest('div');
        var id = parent.attr('id').replace('item_', '')
        var title = $(this).attr('data-rel');
        var text = "<div><i class=\"icon-warning-sign icon-2x pull-left\"></i>Are you sure you want to delete this record?<br /><strong>This action cannot be undone!!!</strong></div>";
        new Messi(text, {
            title: "Delete Database Backup",
            modal: true,
            closeButton: true,
            buttons: [{
                id: 0,
                label: "Delete",
                val: 'Y'
            }],
            callback: function (val) {
                if (val === "Y") {
                    $.ajax({
                        type: 'post',
                        url: "./ajax/tools/backup/backup_delete_ajax.php",
                        data: 'deleteBackup=' + id,
                        beforeSend: function () {
                            parent.animate({
                                'backgroundColor': '#FFBFBF'
                            }, 400);
                        },
                        success: function (msg) {
                            parent.fadeOut(400, function () {
                                parent.remove();
                            });
                            $("html, body").animate({
                                scrollTop: 0
                            }, 600);
                            $("#resultados_ajax").html(msg);
                        }
                    });
                }
            }
        })
    });

    $('a.restore').on('click', function () {
        var parent = $(this).closest('div');
        var id = parent.attr('id').replace('item_', '')
        var title = $(this).attr('data-rel');
        var text = "<div><i class=\"icon-warning-sign icon-2x pull-left\"></i>Are you sure you want to restore databse?<br /><strong>This action cannot be undone!!!</strong></div>";
        new Messi(text, {
            title: "Restore Database",
            modal: true,
            closeButton: true,
            buttons: [{
                id: 0,
                label: "Restore Database",
                val: 'Y'
            }],
            callback: function (val) {
                if (val === "Y") {
                    $.ajax({
                        type: 'post',
                        url: "./ajax/tools/backup/backup_restore_ajax.php",
                        data: 'restoreBackup=' + id,

                        beforeSend: function () {
                            $("#resultados_ajax").html("<div class='alert alert-warning' id='success-alert'>" +
                                "<p>" +
                                "processing database restore, please wait ..." +
                                "</p>" +
                                "</div>");
                        },
                        success: function (msg) {
                            parent.effect('highlight', 1500);
                            $("html, body").animate({
                                scrollTop: 0
                            }, 600);
                            $("#resultados_ajax").html(msg);
                        }
                    });
                }
            }
        })
    });
});