jQuery(document).ready(function() {
    jQuery(".site-title a").attr("href", "http://www.providentmetals.com");
    jQuery("body").addClass("menu-closed");
    jQuery(window).on("resize", updateWidth);
    jQuery(document.body).on("click touchend", ".sidebar .widget.widget_categories .widget-title", toggleCategories);
    jQuery(document.body).on("click touchend", ".sidebar .widget.widget_provident_news_widget .widget-title", toggleNews);
    jQuery(document.body).on("click touchend", ".sidebar .widget.widget_adobe_rec_widget .widget-title", toggleAdobe);
    jQuery(document.body).on("click touchend", ".menu-button, .overlay, .close-button", showMenu);
    jQuery(document).on("touchstart", handleTouchStart);
    jQuery(document).on("touchmove", handleTouchMove);
});
var isMobileSized = false,
canShowHover = true,
updateWidth = function() {
    if(document.body.offsetWidth >= 768) {
        isMobileSized = false;
    } else {
        isMobileSized = true;
    }
},
toggleCategories = function(e) {
    if(isMobileSized){
        prevStop(e);
        jQuery(".sidebar .widget.widget_categories .widget-title").toggleClass("open");
        jQuery(".sidebar .widget.widget_categories ul").slideToggle();
    }
},
toggleNews = function(e) {
    if(isMobileSized){
        prevStop(e);
        jQuery(".sidebar .widget.widget_provident_news_widget .widget-title").toggleClass("open");
        jQuery(".sidebar .widget.widget_provident_news_widget ul, .sidebar .widget.widget_provident_news_widget .more-news").slideToggle();
    }
},
toggleAdobe = function(e) {
    if(isMobileSized){
        prevStop(e);
        jQuery(".sidebar .widget.widget_adobe_rec_widget .widget-title").toggleClass("open");
        jQuery(".sidebar .widget.widget_adobe_rec_widget ul").slideToggle();
    }
},
showMenu = function(e) {
    if(canShowHover){
        prevStop(e);
        jQuery(".overlay").toggleClass("show");
        jQuery("body").toggleClass("menu-open menu-closed");
    }
},
handleTouchStart = function(e) {
    canShowHover = true;
},
handleTouchMove = function(e) {
    canShowHover = false;
},
prevStop = function(e) {
    e.preventDefault();
    e.stopPropagation();
};
updateWidth();