let mix = require('laravel-mix');

// -- Mix Asset Management
mix.copyDirectory('node_modules/font-awesome/fonts', 'public/assets/fonts');
mix.copyDirectory('node_modules/adminlte/dist/img', 'public/img');

//mix
	// .js('resources/assets/js/app.js', 'public/assets/js')
	// .sass('resources/assets/sass/app.scss', 'public/assets/css');

// -- admin-lte
mix.styles([
		'node_modules/bootstrap/dist/css/bootstrap.min.css',
		'node_modules/jasny-bootstrap/dist/css/jasny-bootstrap.min.css',
		'node_modules/font-awesome/css/font-awesome.min.css',
		// 'node_modules/adminlte/dist/css/skins/_all-skins.min.css',
		'node_modules/adminlte/dist/css/skins/skin-black.min.css',
		// 'node_modules/adminlte/dist/css/skins/skin-black-light.min.css',
		// 'node_modules/adminlte/dist/css/skins/skin-blue.min.css',
		'node_modules/adminlte/dist/css/skins/skin-blue-light.min.css',
		// 'node_modules/adminlte/dist/css/skins/skin-green.min.css',
		// 'node_modules/adminlte/dist/css/skins/skin-green-light.min.css',
		// 'node_modules/adminlte/dist/css/skins/skin-purple.min.css',
		// 'node_modules/adminlte/dist/css/skins/skin-purple-light.min.css',
		'node_modules/adminlte/dist/css/skins/skin-red.min.css',
		// 'node_modules/adminlte/dist/css/skins/skin-red-light.min.css',
		'node_modules/adminlte/dist/css/skins/skin-yellow.min.css',
		// 'node_modules/adminlte/dist/css/skins/skin-yellow-light.min.css',

		'node_modules/bootstrap-toggle/css/bootstrap-toggle.min.css',
		'node_modules/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css',

		'node_modules/select2/dist/css/select2.min.css',
		'node_modules/adminlte/dist/css/AdminLTE.min.css',

		'resources/assets/css/styles.css'
	], 'public/assets/css/combined.css'
);

mix.scripts([
		'node_modules/jquery/dist/jquery.min.js',
		'node_modules/bootstrap/dist/js/bootstrap.min.js',
		'node_modules/jasny-bootstrap/dist/js/jasny-bootstrap.min.js',
		'node_modules/admin-lte/dist/js/adminlte.min.js',

		// -- Bootstrap Date Picker
		'node_modules/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js',
		'node_modules/bootstrap-datepicker/dist/js/locales/bootstrap-datepicker.pl.min.js',
		'node_modules/bootstrap-datepicker/dist/js/locales/bootstrap-datepicker.en.min.js',

		// -- Bootstrap Switch / Toggle
		'node_modules/bootstrap-toggle/js/bootstrap-toggle.min.js',
		'node_modules/bootstrap-switch/dist/js/bootstrap-switch.min.js',

		// -- Select2
		'node_modules/select2/dist/js/select2.min.js',
		'node_modules/select2/dist/js/i18n/en.js',
		'node_modules/select2/dist/js/i18n/pl.js',

		'resources/assets/js/prototypes.js',
		'resources/assets/js/callback.js',
		'resources/assets/js/scripts.js',
		'resources/assets/js/onload.js',

		'resources/assets/js/myapp.js'
	], 'public/assets/js/combined.js')

mix.scripts([
		'node_modules/jquery/dist/jquery.min.js',
		'node_modules/bootstrap/dist/js/bootstrap.min.js',
		'node_modules/jasny-bootstrap/dist/js/jasny-bootstrap.min.js',

		'resources/assets/js/prototypes.js',
		'resources/assets/js/callback.js',
		'resources/assets/js/scripts.js',
		'resources/assets/js/onload.js',
	], 'public/assets/js/login.js')


mix.scripts([
		'node_modules/html5shiv/dist/html5shiv.min.js'
	], 'public/assets/js/combined-IE9.js')

// -- fullcalendar
//
