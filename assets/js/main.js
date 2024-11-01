jQuery(document).ready(function($) {
    if (wopoSolitaire.is_shortcode != 0){        
        $('#wopo_sound_recorder').attr('src',wopoSolitaire.app_url);
        $('#wopo_sound_recorder_window').show('slow');
    }
    $('#wopo_sound_recorder_window .btn-close').click(function(){        
        $('#wopo_sound_recorder_window').hide('slow');
    });    
    $('#wopo_sound_recorder_window .btn-minimize').click(function(){        
        $('#wopo_sound_recorder_window').removeClass('maximize').toggleClass('minimize');
    });
    $('#wopo_sound_recorder_window .btn-maximize').click(function(){
        $('#wopo_sound_recorder_window').removeClass('minimize').toggleClass('maximize');
    });
});