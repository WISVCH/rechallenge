var Gallery;

(function ($) {

    Gallery = {

        init: function () {
            Gallery.initInlineGallery();
            Gallery.initImageGallery();
        },

        initInlineGallery: function () {
            $('.inline-gallery').each(function () {
                $(this).magnificPopup({
                    delegate: 'a.gallery-image',
                    type: 'image',
                    gallery: {
                        enabled: true
                    },
                    image: {
                        titleSrc: Gallery.customTitleSrc__inline
                    },
                    callbacks: {
                        beforeOpen: Gallery.beforeOpenCallback,
                        change: Gallery.changeCallback
                    }
                });
            });
        },

        initImageGallery: function () {
            $('.post-content').find('a[href$=".png"], a[href$=".jpg"], a[href$=".jpeg"], a[href$=".gif"]').each(function () {

                $(this).magnificPopup({
                    type: 'image',
                    image: {
                        titleSrc: Gallery.customTitleSrc__image
                    },
                    callbacks: {
                        beforeOpen: Gallery.beforeOpenCallback,
                        change: Gallery.changeCallback
                    }
                });
            });
        },

        customTitleSrc__inline: function (item) {
            var p = item.el.parent();
            if (p.is('figure')) {
                var cap = p.find('figcaption').text();
            } else {
                var cap = item.el.find('img').attr('alt');
            }
            return cap ? cap : '';
        },

        customTitleSrc__image: function (item) {
            var p = item.el.parent();
            return p.is('figure') ? p.find('figcaption').text() : item.el.find('img').attr('alt');
        },

        beforeOpenCallback: function () {
            this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
            this.st.mainClass = 'mfp-zoom-in';
        },

        changeCallback: function () {
            var t = this.content.find('.mfp-title');
            if (t) {
                if (t.text() == "") {
                    t.addClass('nobg');
                } else {
                    t.removeClass('nobg');
                }
            }
        }

    }

})(jQuery);
