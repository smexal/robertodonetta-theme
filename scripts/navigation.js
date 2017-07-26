var navigation = {
    animationTimer : 400,
    animated : false,

    init : function() {
        this.triggers();
    },

    triggers : function() {

        // close on escape
        $(document).keyup(function(e) {
            if ($("body").hasClass('nav-open') 
                && ! $("body").hasClass('nav-animation-hide')
                && e.keyCode === 27) {

                navigation.toggle();
            }
        });

        $("#nav-overlay").on('click', navigation.toggle);
        $("a#menu-trigger").on('click', navigation.toggle);
    },

    toggle : function() {
        if(navigation.animated)
            return;
        navigation.animated = true;
        var boddy = $(document).find('body');
        if(boddy.hasClass('nav-open') || boddy.hasClass('nav-animation-hide')) {
            // remove
            boddy.addClass('nav-animation-hide');
            setTimeout(function() {
                boddy.removeClass('nav-open');
                boddy.removeClass('nav-animation-hide');
                navigation.animated = false;
            }, navigation.animationTimer);
        } else {
            boddy.addClass('nav-open');
            setTimeout(function() {
                navigation.animated = false;
            }, navigation.animationTimer)
        }
    }

};

$(document).ready(function() {
    navigation.init();
});
