define([
    'jquery',
    'mage/translate',
    'jquery/ui',
    'mage/mage'
], function ($) {
    'use strict';
    return function button(config, element){
        // alert('Hello')

    $(".btn-ajax").click(function () {
        var thisButton = this;
        var customData = "This is custom data";

        $.ajax({
            success: function (response) {
                alert(customData);
                $(thisButton).html(config.message);
            },
            error: function(response) {
                alert('Failed !');
                $(thisButton).html("Custom Data Show Failed");
            }
        })
        // .success(function () {
        //     $(thisButton).html(config.message);
        //     // alert(config.message)
        // }).error(function(){
        //     $(thisButton).html("Data Show Failed");
        // })
    })
    }
});


