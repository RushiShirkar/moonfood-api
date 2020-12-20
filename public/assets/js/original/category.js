/*
    function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}
*/
function myFunctioncity() {
    document.getElementById("myDropdowncity").classList.toggle("show");
}
$(document).ready(function () {
    "use strict";
    $(document).on('click', function (e) {
        if($(e.target).closest("#product_search_txt").length !== 0 || $(e.target).closest("#mob_product_search_txt").length !== 0){
            $('#shop_suggestion').hide();
            $('#city_suggestion').hide();
            var selector = 'product_suggestion_div';
            $('#' + selector).show();
            return true;
        }
        else if($(e.target).closest(".suggestion_btn1").length !== 0){
            $('#city_search_txt').val('');
            $('#mob_city_search_txt').val('');
            var view = '<li><a href="/product/satara?shop=All Shop">satara</a></li>\n' +
                '       <li><a href="/product/karad?shop=All Shop">karad</a></li>\n' +
                '       <li><a href="/product/sangli?shop=All Shop">sangli</a></li>\n' +
                '       <li><a href="/product/islampur?shop=All Shop">islampur</a></li>\n' +
                '       <li><a href="/product/kolhapur?shop=All Shop">kolhapur</a></li>';
            $('.city_suggestion_box').html(view);
            $('#shop_suggestion').hide();
            $('#product_suggestion_div').hide();
            var selector = 'city_suggestion';
            if($('#' + selector).is(':visible')){
                $('#' + selector).hide();
                return true;
            }
            $('#' + selector).show();
            return true;
        }
        else if($(e.target).closest(".suggestion_btn2").length !== 0){
            $('#shop_search_txt').val('');
            var url = window.location.href;
            url = url.substring(url.indexOf('?')+1);
            url =  JSON.parse('{"' + decodeURI(url.replace(/&/g, "\",\"").replace(/=/g,"\":\"")) + '"}');
            var city = ['All Shop','Lavanya NX','Tarangan Collection','Shree Dhuleshwar Collection','Exceptional Mens Wear','Dress Code','Mix And Match'];

            var path = window.location.pathname;
            var view = '';
            for(var i=0;i < city.length;i++)
            {
                url.shop = city[i];
                var new_url = path + '?';
                for(var key in url)
                {
                    new_url = new_url + key + '=' + url[key] + '&';
                }
                new_url = new_url.substring(0,new_url.length - 1);
                if(i == 0)
                {
                    view = view + '<li><a href="' + new_url + '" style="border-bottom:1px solid #424242"><center>All Shop</center></a></li>';
                }
                else
                {
                    view = view + '<li><a href="' + new_url + '">' + city[i] + '</a></li>';
                }
            }

            $('.shop_suggestion_box').html(view);
            $('#city_suggestion').hide();
            $('#product_suggestion_div').hide();
            var selector = 'shop_suggestion';
            if($('#' + selector).is(':visible')){
                $('#' + selector).hide();
                return true;
            }
            $('#' + selector).show();
            return true;
        }

        if ($(e.target).closest(".suggestion_div").length === 0) {
            $(".suggestion_div").hide();
        }
    });


    $('.menu > ul > li:has( > ul)').addClass('menu-dropdown-icon');
    $(".menu > ul > li").hover(function (e) {
        if ($(window)) {
            $(this).children("ul").stop(true, false).fadeToggle(150);
            e.preventDefault();
        }
    });

    $('.menu1 > ul > li:has( > ul)').addClass('menu-dropdown-icon1');

    $(".menu1 > ul").before("<a href=\"javascript:void(0)\" class=\"menu-mobile1\">Men</a>");
 
    $(".menu1 > ul > li").click(function (){
            $(this).children("ul").fadeToggle(150);
    });
   
    $('.menu-mobile1').click(function(){
        if ($(this).hasClass('menu-mobile_min1')) {
            $(this).removeClass('menu-mobile_min1');
        }
        else
        {
            $(this).addClass('menu-mobile_min1');
        }
    
    });
    $('.menu-dropdown-icon1').click(function(){
        if ($(this).hasClass('menu-dropdown-icon_min1')) {
            $(this).removeClass('menu-dropdown-icon_min1');
        }
        else
        {
            $(this).addClass('menu-dropdown-icon_min1');
        }
    
    });    

    $(".menu-mobile1").click(function (e) {
        $(".menu1 > ul").toggleClass('show-on-mobile1');
        e.preventDefault();
    });

    //women Js

    $('.menu2 > ul > li:has( > ul)').addClass('menu-dropdown-icon2');

    $(".menu2 > ul").before("<a href=\"javascript:void(0)\" class=\"menu-mobile2\">Women</a>");

 
    $(".menu2 > ul > li").click(function () {
            $(this).children("ul").fadeToggle(150);
    });

    $('.menu-mobile2').click(function(){
        if ($(this).hasClass('menu-mobile_min2')) {
            $(this).removeClass('menu-mobile_min2');
        }
        else
        {
            $(this).addClass('menu-mobile_min2');
        }
    
    });
    $('.menu-dropdown-icon2').click(function(){
        if ($(this).hasClass('menu-dropdown-icon_min2')) {
            $(this).removeClass('menu-dropdown-icon_min2');
        }
        else
        {
            $(this).addClass('menu-dropdown-icon_min2');
        }
    
    });

    $(".menu-mobile2").click(function (e) {
        $(".menu2 > ul").toggleClass('show-on-mobile2');
        e.preventDefault();
    });


    //baby kids Js

    $('.menu3 > ul > li:has( > ul)').addClass('menu-dropdown-icon3');



    $(".menu3 > ul").before("<a href=\"javascript:void(0)\" class=\"menu-mobile3\">Baby & kids</a>");



 
    $(".menu3 > ul > li").click(function () {
            $(this).children("ul").fadeToggle(150);
    });





    $('.menu-mobile3').click(function(){
        if ($(this).hasClass('menu-mobile_min3')) {
            $(this).removeClass('menu-mobile_min3');
        }
        else
        {
            $(this).addClass('menu-mobile_min3');
        }
    
    });




    $('.menu-dropdown-icon3').click(function(){
        if ($(this).hasClass('menu-dropdown-icon_min3')) {
            $(this).removeClass('menu-dropdown-icon_min3');
        }
        else
        {
            $(this).addClass('menu-dropdown-icon_min3');
        }
    
    });




    $(".menu-mobile3").click(function (e) {
        $(".menu3 > ul").toggleClass('show-on-mobile3');
        e.preventDefault();
    });

// merge file
    $("#filter").click(function(){
        $("#showfilter").show();
        $("#main").hide();
        $("#product_list").hide();
    });
   
    $("#location").click(function(){
        $("#searchlocation").show();
        $("#main").hide();
        $("#product_list").hide();
        var view = '<li><a href="/product/islampur?shop=All Shop">islampur</a></li>\n' +
            '       <li><a href="/product/karad?shop=All Shop">karad</a></li>\n' +
            '       <li><a href="/product/sangli?shop=All Shop">sangli</a></li>\n' +
            '       <li><a href="/product/satara?shop=All Shop">satara</a></li>\n' +
            '       <li><a href="/product/kolhapur?shop=All Shop">kolhapur</a></li>';
        $('#static_city_suggestion').show();
        $('#static_city_suggestion ul div').html(view);
    });
    $("#shop").click(function(){

        var url = window.location.href;
        url = url.substring(url.indexOf('?')+1);
        url =  JSON.parse('{"' + decodeURI(url.replace(/&/g, "\",\"").replace(/=/g,"\":\"")) + '"}');
        var city = ['All Shop','Lavanya NX','Tarangan Collection','Shree Dhuleshwar Collection','Exceptional Mens Wear','Dress Code','Mix And Match'];

        var path = window.location.pathname;
        var view = '';
        for(var i=0;i < city.length;i++)
        {
            url.shop = city[i];
            var new_url = path + '?';
            for(var key in url)
            {
                new_url = new_url + key + '=' + url[key] + '&';
            }
            new_url = new_url.substring(0,new_url.length - 1);
            if(i == 0)
            {
                view = view + '<li><a href="' + new_url + '" style="border-bottom:1px solid #424242"><center>All Shop</center></a></li>';
            }
            else
            {
                view = view + '<li><a href="' + new_url + '">' + city[i] + '</a></li>';
            }
        }
        $('#static_shop_suggestion').show();
        $('#static_shop_suggestion ul div').html(view);
        $("#selectshop").show();
        $("#main").hide();
        $("#product_list").hide();
    });
    $("#category").click(function(){
        $("#select_category").show();
        $("#main").hide();
        $("#product_list").hide();
    });
    $('.fil-back_btn').click(function(){
        $("#showfilter").hide();
        $("#main").show();
        $("#product_list").show();
    });
    $('#loc-back_btn').click(function(){
        $("#searchlocation").hide();
        $("#main").show();
        $("#product_list").show();
        $('#mob_city_search_txt').val('');
    });
    $('#sh-back_btn').click(function(){
        $("#selectshop").hide();
        $("#main").show();
        $("#product_list").show();
        $('#mob_shop_search_txt').val('');
    });
    $('#cat-back_btn').click(function(){
        $("#select_category").hide();
        $("#main").show();
        $("#product_list").show();
        $('.js_gender_category').show();
        $('.js_clear_btn').hide();
        $('#mob_product_search_txt').val('');
    });
    
});
