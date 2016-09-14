var demo_blog = demo_blog || {};

demo_blog.article_opt = (function( $, window, document, undefined) {

    var defaults = {
        container: $('table'),
        opt_class: 'article-opt',
        check_class: 'fa-check',
        uncheck_class: 'fa-times',
        spinner_class: 'fa-spinner fa-spin'
    };


    return {
        init: function (config) {
            var self = this;

            self.config = $.extend( {}, defaults, config );

            self.bindEvents();
        },

        bindEvents: function() {
            var self = this,
                container = self.config.container,
                opt_class = self.config.opt_class;

            container.on( 'click', 'a.' + opt_class, self.article_process);
        },

        article_process: function ( e ) {
            var self = demo_blog.article_opt,
                i = $(this).children('i'),
                url = $(this).attr('href'),
                check = self.config.check_class,
                uncheck = self.config.uncheck_class,
                spinner = self.config.spinner_class,
                value;

            e.preventDefault();


            if(i.hasClass(uncheck)) {
                i.removeClass(uncheck).addClass(spinner);
                value = 1;
            } else {
                i.removeClass(check).addClass(spinner);
                value = 0;
            }

            self.fetchJSON( url, { value: value }, 'get' )
                .done( function( data ) {
                    i.removeClass(spinner);
                    if( data == 200){
                        if(value){
                            i.addClass(check);
                        } else {
                            i.addClass(uncheck);
                        }
                    }else{
                        if(value){
                            i.addClass(check);
                        } else {
                            i.addClass(uncheck);
                        }
                    }
                });
        },

        fetchJSON: function( url, data, type) {

            return $.ajax({
                type: type,
                url: url,
                data: data,
                dataType: 'json'
            })
        }

    }

})( jQuery, window, document );


demo_blog.comment = (function( $, window, document, undefined) {

    var defaults = {
        comment_form: $('#comment_form'),
        comment_list: $('.comment_list'),
        el_meta_count: $('.article-meta-comments')
    };


    return {
        init: function (config) {
            var self = this;

            self.config = $.extend( {}, defaults, config );

            self.bindEvents();

        },

        bindEvents: function() {
            var self = this,
                comment_form = self.config.comment_form;

            comment_form.on('submit', self.sentComment );
        },

        sentComment: function (e) {
            var comment = $(this),
                button = comment.find('input[type="submit"]'),
                self = demo_blog.comment,
                el_meta_count = self.config.el_meta_count.find('span'),
                count,
                data = comment.serialize(),
                url = comment.attr('action');

            button.attr('disabled', true).fadeTo('slow', 0.5);

            if( self.validateComment()) {
                self.errorValidation();
            } else {
                self.fetchJSON( url, data, 'post')
                    .done(function(data) {
                        count = parseInt( el_meta_count.find('span').html() );
                        el_meta_count.html(count+1);
                        self.renderCommentList(data);
                        button.attr('disabled', false).fadeTo('slow', 1);
                    }).fail(function() {
                        self.whenFail()
                    });
            }

            e.preventDefault();
        },

        fetchJSON: function( url , data, type) {
            return $.ajax({
                type: type,
                url: url,
                data: data,
                dataType: 'json'
            })
        },

        whenFail: function() {
            var self = this,
                comment = self.config.comment_form;

            comment.find('p').remove();
            comment.prepend('<p class="text-danger">Sorry, there was a problem!</p>');
            setTimeout(function(){
                comment.find('p').slideUp();
            },2000);
        },

        validateComment: function () {
            var self = this,
                comment_text = self.config.comment_form.find('textarea[name="body"]').val();

            return comment_text === '';

        },

        errorValidation: function() {
            var self = this,
                comment = self.config.comment_form,
                button = comment.find('input[type="submit"]');

            comment.find('p').remove();
            comment.prepend('<p class="text-danger">Please enter your comment.</p>');
            setTimeout(function(){
                comment.find('p').slideUp();
                button.attr('disabled', false).fadeTo('slow', 1);
            },2000);
        },

        renderCommentList: function (data) {
            var self = demo_blog.comment,
                comment_list = self.config.comment_list;

            comment_list.prepend(data);
            $('html,body').animate( {
                scrollTop: comment_list.offset().top - 10
            }, 1200);
        }


    }

})( jQuery, window, document );


demo_blog.like = (function($, window, document, undefinded) {

    var defaults = {
        container_article: $('.article_action'),
        container_comment: $('.comment_list')
    };

    return {
        init: function (config) {
            var self = this;

            self.config = $.extend( {}, defaults, config );

            self.bindEvents();
        },

        bindEvents: function () {
            var self = this,
                article = self.config.container_article,
                comment = self.config.container_comment;

            article.on('click','a.like', self.articleLike );
            article.on('click','a.dislike', self.articleDislike );
            comment.on('click','a.like', self.commentLike );
            comment.on('click','a.dislike', self.commentDislike );
        },

        articleLike: function (e) {
            var self = demo_blog.like,
                el = $(this);

            self.upOrDown( el,'fa-thumbs-up', 'fa-thumbs-o-up', function( count ){
                $( '.article-meta-like').find( 'span' ).html( count );
            });
            e.preventDefault();
        },

        articleDislike: function (e) {
            var self = demo_blog.like,
                el = $(this);

            self.upOrDown( el,'fa-thumbs-down', 'fa-thumbs-o-down', function( count ){
                $( '.article-meta-dislike').find( 'span' ).html( count );
            });
            e.preventDefault();
        },

        commentLike: function (e) {
            var self = demo_blog.like,
                el = $(this);

            self.upOrDown( el , 'fa-thumbs-up', 'fa-thumbs-o-up' );
            e.preventDefault();
        },

        commentDislike: function (e) {
            var self = demo_blog.like,
                el = $(this);

            self.upOrDown( el, 'fa-thumbs-down', 'fa-thumbs-o-down' );
            e.preventDefault();
        },

        upOrDown: function (el, icon, icon_o, f) {
            var self = this,
                url = el.attr( 'href' ),
                el_icon = el.find( 'i' ),
                el_count = el.find( 'span' ),
                div = el.closest( "div" );

            el.attr('disabled',true);
            el_icon.removeClass( icon + ' ' + icon_o ).addClass('fa-spinner fa-spin');

            self.fetchJSON( url,{}, 'get')
                .done(function(data) {
                    var count = parseInt( el_count.html() );
                    if( data.action == 'up' ){
                        count += 1;
                        el_icon.removeClass( 'fa-spinner fa-spin' ).addClass( icon );
                        el_count.html( count );
                        if( f !== undefined ) f( count );
                    }else{
                        count -= 1;
                        el_icon.removeClass( 'fa-spinner fa-spin' ).addClass( icon_o );
                        el_count.html( count );
                        if( f !== undefined ) f( count );
                    }
                    el.attr( 'disabled', false );

                })
                .fail(function(data) {
                    div.find( 'p' ).remove();
                    if( data.status === 401 ){
                        div.prepend( '<p class="text-danger">Sorry, You have to be login!</p>' );
                        setTimeout( function(){
                            div.find( 'p' ).slideUp();
                        }, 2000 );
                    }
                    el_icon.removeClass( 'fa-spinner fa-spin' ).addClass( icon_o );
                })

        },

        fetchJSON: function( url , data, type) {
            return $.ajax({
                type: type,
                url: url,
                data: data,
                dataType: 'json'
            })
        }

    }

})(jQuery, window, document)