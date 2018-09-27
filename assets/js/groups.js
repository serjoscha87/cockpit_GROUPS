(function($){

    /*
     * Hack: on clicking the "premission" tab within a collection configuration: add a class to all group-permission container-cards
     * in order of being able to shrink them to a reduced layout/size
     */
    if(window.location.href.match('collections/collection')) {
        $(document).on('click', 'a[data-tab="auth"]' , function(){
            $('.uk-tab').nextAll().eq(1).find('.uk-panel.uk-panel-card').each(function () {
                $(this).addClass('shrinkable-group');
            });
        });
    }

})(this.jQuery);