(function( $ ) { 
    'use strict'; 
    if (typeof show_snow !== 'undefined') 
    {

        jQuery('body').flurry({
            character: flake_type,
            height: 1000,
            color: flake_color,
            frequency: 60,
            speed: max_speed,
            small: mini_size,
            large: max_size,
            wind: 40,
            windVariance: 20,
            rotation: 40,
            rotationVariance: 180,
            startOpacity: 1,
            endOpacity: 0,
            opacityEasing: "cubic-bezier(1,.3,.6,.74)",
            blur: true,
            overflow: "hidden",
            zIndex: z_index,
        });
    }

})( jQuery );