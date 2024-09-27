const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js') 
   .js('resources/js/components/toastMessage.js', 'public/js') 
   .css('resources/css/app.css', 'public/css')
   .css('resources/css/custom.css', 'public/css') 
   .sourceMaps(false)
   .version(); // Para adicionar hash para cache busting
