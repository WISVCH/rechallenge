<!-- Photo Album -->
<section class="section-odd gallery">
    <div class="row">
        <div class="small-8 column">
            <h1 class="small gallery-title">Photo galleries</h1>
        </div>
        <div class="small-4 column text-right">
            <a class="button alt" href="https://flitcie.ch.tudelft.nl/" target="new">More <i class="fa ch-arrow-right"></i></a>
        </div>
    </div>

    <div class="row small-up-1 medium-up-2 large-up-3 loading" data-wisvch-gallery>

        <div class="column loading">Loading...</div>

    </div>

    <script type="text/javascript">
        jQuery(function ($) {
            $.getJSON("<?php echo admin_url("admin-ajax.php"); ?>?action=photo_album").done(function (data) {
                var el = $("[data-wisvch-gallery]");
                el.removeClass("loading").find(".loading").remove();
                $.each(data, function (k, v) {
                    el.append('<article class="column"><a target="new" class="gallery-item-wrapper" href="' + v.url + '"><img src="' + v.cover + '"><div class="caption"><div class="align-middle"><h1 class="small">' + v.title + '</h1></div></div></a></article>');
                });
            });
        });
    </script>

</section>
