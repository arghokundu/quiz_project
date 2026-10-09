// ==========================================
    // PAGE LOAD
    // ==========================================

    window.addEventListener('load', function () {

        $('#loadingScreen').stop(true, true).hide();

    });


    // ==========================================
    // PAGE SHOW
    // ==========================================

    window.addEventListener('pageshow', function () {

        $('#loadingScreen').stop(true, true).hide();

    });


    // ==========================================
    // FORM SUBMISSION
    // ==========================================
    // IMPORTANT:
    // Do NOT show loader here.
    //
    // Why?
    // Your custom validation may call preventDefault().
    // If loader is shown here, it will remain visible.
    //
    // Instead, beforeunload below will show the loader
    // ONLY when the browser actually leaves the page.

    
    // ==========================================
    // ACTUAL PAGE NAVIGATION
    // ==========================================

    window.addEventListener('beforeunload', function () {

        $('#loadingScreen').stop(true, true).show();

    });


    // ==========================================
    // LINK CLICK
    // ==========================================

    $(document).on('click', 'a', function (e) {

        let href = $(this).attr('href');

        // Ignore empty links
        if (!href || href === '#' || href === 'javascript:void(0);') {
            return;
        }

        // Ignore new tab
        if ($(this).attr('target') === '_blank') {
            return;
        }

        /*
         * Do NOT show loader here.
         *
         * beforeunload will show it when the
         * browser actually navigates.
         */

    });


    // ==========================================
    // AJAX START
    // ==========================================

    $(document).ajaxStart(function () {

        $('#loadingScreen')
            .stop(true, true)
            .show();

    });


    // ==========================================
    // AJAX COMPLETE
    // ==========================================

    $(document).ajaxStop(function () {

        $('#loadingScreen')
            .stop(true, true)
            .fadeOut(300);

    });