let mix = require('laravel-mix');

mix.copyDirectory('node_modules/materialize-css/dist','resources/assets/materialize/');
mix.copyDirectory('resources/assets/materialize/fonts', 'public/fonts');
mix.js('resources/assets/js/app.js', 'public/js/app.js');
mix.scripts([
	'resources/assets/js/vendor/jquery-3.2.1.js',
	'resources/assets/materialize/js/materialize.min.js',
	'resources/assets/js/init.js',
	], 'public/js/vendor.js');
mix.styles([
	'resources/assets/materialize/css/materialize.min.css'
	], 'public/css/vendor.css');
mix.styles([
	'resources/assets/css/app.css'
	], 'public/css/styles.css');
mix.js('resources/assets/js/templates/home.js', 'public/js/home.js');
mix.js('resources/assets/js/duvier.js', 'public/js');

