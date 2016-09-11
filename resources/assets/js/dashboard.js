/* Dashboard dashboard.js
 * ================
 * Main JS application file for admin area. This file
 * should be included in all pages from admin area.
 *
 * @Author  Dejan
 * @version 0.1.0
 * @license MIT
 */

'use strict';

if (typeof jQuery === "undefined") {
    throw new Error("Dashboard requires jQuery");
}

if (typeof $.Dashboard !== "undefined") {
    throw new Error("Namespace 'Dashboard' has already been used");
}

/* Dashboard
 *
 * @type Object
 * @description $.Dashboard is the main object. Keeping everything wrapped in an object
 *              prevents conflict and is a better way to organize code.
 */
$.Dashboard = {};


/* --------------------
 * - Dashboard Options -
 * --------------------
 */
$.Dashboard.options = (function(){

    return {

        /*
         * Root element, It's element that is wrapped Dom elements in our app.
         */
        wrapper: '.wrapper',

        /*
         * This is the name of the class that has the root element when collapsed sidebar.
         */
        sidebarCollapse: 'sidebar-collapse',

        /*
         * This is the name of the class that has the root element when collapsed sidebar.
         */
        sidebarOpen: 'sidebar-open',

        /*
         * General animation speed for JS animated elements.
         * This options accepts an integer as milliseconds,'fast', 'normal', or 'slow'
         */
        animatedSpeed: 500,

        /*
         * Sidebar push menu toggle button selector.
         */
        sidebarToggleSelector: ".sidebar-toggle",

        /*
         * The standard screen sizes that bootstrap uses.
         */
        screenSizes: {
            xs: 480,
            sm: 768,
            md: 992,
            lg: 1200
        }
    };

}());


/*
 * Set up options.
 */
$.Dashboard.setup = (function($, app, undefined){

    return function(options){
        app.options = $.extend({}, app.options, options);
    };

}(jQuery, $.Dashboard));


/* PushMenu()
 * ==========
 * Adds the push menu functionality to the sidebar.
 *
 * @type Function
 * @usage: $.Dashboard.pushMenu(".sidebar-toggle")
 */
$.Dashboard.pushMenu = (function($, window, app, undefined){

    var screenSizes = app.options.screenSizes,
        body = $('body'),
        sidebarCollapse = app.options.sidebarCollapse,
        sidebarOpen = app.options.sidebarOpen;

    return function(sidebarToggle){
        $(sidebarToggle).on('click', function (e) {
            e.preventDefault();
            if ($(window).width() > (screenSizes.sm -1)) {
                body.toggleClass(sidebarCollapse);
            }
            else {
                if (body.hasClass(sidebarOpen)) {
                    body.removeClass(sidebarOpen);
                    body.removeClass(sidebarCollapse)
                } else {
                    body.addClass(sidebarOpen);
                }
            }
        });

    };

}(jQuery, window, $.Dashboard));


/* Tree()
 * ======
 * Converts the sidebar into a multilevel tree view menu.
 *
 * @type Function
 * @Usage: $.Dashboard.tree('.sidebar')
 */
$.Dashboard.tree = (function($, window, app, undefined){

    return function(menu){
        $("li a", menu).on('click', function (e) {
            //Get the clicked link and the next element
            var $this = $(this),
                checkElement = $this.next();

            //Check if the next element is a menu and is visible
            if ((checkElement.is('.treeview-menu')) && (checkElement.is(':visible'))) {
                //Close the menu
                checkElement.slideUp(app.animatedSpeed, function () {
                    checkElement.removeClass('menu-open');
                });
                checkElement.parent("li").removeClass("active");
            }
            //If the menu is not visible
            else if ((checkElement.is('.treeview-menu')) && (!checkElement.is(':visible'))) {
                //Get the parent menu
                var parent = $this.parents('ul').first();
                //Close all open menus within the parent
                var ul = parent.find('ul:visible').slideUp(app.animatedSpeed);
                //Remove the menu-open class from the parent
                ul.removeClass('menu-open');
                //Get the parent li
                var parent_li = $this.parent("li");

                //Open the target menu and add the menu-open class
                checkElement.slideDown(app.animatedSpeed, function () {
                    //Add the class active to the parent li
                    checkElement.addClass('menu-open');
                    parent.find('li.active').removeClass('active');
                    parent_li.addClass('active');
                });
            }
            //if this isn't a link, prevent the page from being redirected
            if (checkElement.is('.treeview-menu')) {
                e.preventDefault();
            }
        });
    };

}(jQuery, window, $.Dashboard));

(function( $, window, document, app, undefined ) {

    app.setup();
    app.pushMenu(app.options.sidebarToggleSelector);
    app.tree('.main-sidebar')

})( jQuery, window, document, $.Dashboard);



















