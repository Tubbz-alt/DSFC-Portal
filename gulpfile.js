var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
	mix
		.copy('resources/assets/jquery/dist/jquery.min.js', 'resources/assets/js/jquery.min.js')
		.copy('resources/assets/bootstrap/dist/css/bootstrap.min.css', 'resources/assets/css/bootstrap.min.css')
		.copy('resources/assets/bootstrap/dist/js/bootstrap.min.js', 'resources/assets/js/bootstrap.min.js')
		.copy('resources/assets/bootstrap/dist/fonts', 'public/fonts')
		.copy('resources/assets/font-awesome/dist/fonts', 'public/fonts')
		.copy('resources/assets/angular/angular.min.js', 'resources/assets/js/angular.min.js')
		.copy('resources/assets/d3/d3.min.js', 'resources/assets/js/d3.min.js')
		.copy('resources/assets/c3/c3.min.js', 'resources/assets/js/c3.min.js')
		.copy('resources/assets/c3/c3.min.css', 'resources/assets/css/c3.min.css')
		.styles([
			'bootstrap.min.css',
			'c3.min.css',
			'common.css'
		])
		// .scripts([
		// 	'jquery.min.js',
		// 	'bootstrap.min.js',
		// 	'angular.min.js',
		// 	'd3.min.js',
		// 	'c3.min.js',
		// 	'common.js'
		// ])
});
