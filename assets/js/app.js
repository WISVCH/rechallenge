jQuery(document).ready(function ($) {

    FoundationOverrides.init();
    Gallery.init();
    Portal.init();

    // Initialize CHoice
    if (typeof CHoice !== 'undefined')
        CHoice.init();

    // Initialize Calendar
    if (typeof Events !== 'undefined')
        Events.init();

});
