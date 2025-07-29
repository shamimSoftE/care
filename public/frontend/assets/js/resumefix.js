    // blog side menu fix 
    var resumeoffset = $('.resume_body_left').offset().top;

    $(window).on('scroll', function () {
        var resume_right = $(this).scrollTop();
        if (resume_right > resumeoffset) {
            $('.resume_body_left').addClass('resume_body_left_fix');
        } else {
            $('.resume_body_left').removeClass('resume_body_left_fix');
        }
    });