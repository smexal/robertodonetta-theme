var rdon_overlay = {

    init : function() {
        rdon_overlay.closeButton();
        rdon_overlay.escKey();
    },

    closeButton : function() {
        $("body > .overlay .close").on('click', function() {
            rdon_overlay.close();
        });
    },

    escKey : function() {
        $(document).keyup(function(e){
            if(e.keyCode === 27) {
                rdon_overlay.close();
            }
        });
    },

    load: function( req ) {
        $.ajax({
            method: 'GET',
            url: req
        }).done(function(data) {
            console.log(data);
            $("body > .overlay .content").html(data.content);
            rdon_overlay.stopLoading();
        });
    },

    close : function() {
        $("body > .overlay").removeClass('visible');
        $("body > .overlay .content").html('');
    },

    stopLoading : function() {
        $("body > .overlay").removeClass('loading');
    },

    open : function() {
        $("body > .overlay").addClass('visible loading');
        $("body > .overlay .content").html('');
    }


};

$(document).ready(function() {
    rdon_overlay.init();
});
