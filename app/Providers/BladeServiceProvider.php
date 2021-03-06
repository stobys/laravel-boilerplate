<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
// use Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('fa', function ($expression) {
            // $expression = $this->parseMultipleArgs($expression);

            // $class = $expression -> join(' ');

            return '<i class="fa fa-'. $expression .'"></i>';
        });
    }

    /**
     * Get argument array from argument string.
     *
     * @param string $argumentString
     *
     * @return array
     */
    private function getArguments($argumentString)
    {
        return explode(',', str_replace(['(', ')'], '', $argumentString));
    }

    /**
     * Parse expression.
     *
     * @param  string $expression
     * @return \Illuminate\Support\Collection
     */
    public static function parseMultipleArgs($expression)
    {
        return collect(explode(' ', $expression))->map(function ($item) {
            return trim($item);
        });
    }
    /**
     * Strip single quotes.
     *
     * @param  string $expression
     * @return string
     */
    public static function stripQuotes($expression)
    {
        return str_replace("'", '', $expression);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // dd('register in blade SP');

        /*
        // -- Markup Extensions
        Blade::extend(function ($view) {
            $html = "<div class=\"progress\"><span class=\"meter\" style=\"width: $1%\"></span></div>";
            return preg_replace("#\s*@progressbar\(\s*([0-9]*)\s*\)#", $html, $view);
        });

        // -- switch statement
        Blade::extend(function ($value) {
            $value = preg_replace('/(\s*)@switch\((.*)\)(?=\s)/', '$1<?php switch($2):', $value);
            $value = preg_replace('/(\s*)@endswitch(?=\s)/', '$1endswitch; ?>', $value);
            $value = preg_replace('/(\s*)@case\((.*)\)(?=\s)/', '$1case $2: ?>', $value);
            $value = preg_replace('/(?<=\s)@default(?=\s)/', 'default: ?>', $value);
            $value = preg_replace('/(?<=\s)@breakcase(?=\s)/', '<?php break;', $value);

            return $value;
        });
        */

        /*
                Blade::directive('debug', function () {
                    return "<?php if( config('app.debug') ): ?>";
                });

                Blade::directive('enddebug', function () {
                    return '<?php endif; ?>';
                });

                Blade::directive('haserror', function ($expression) {
                    return '<?php if (isset($errors) && $errors->has('.$expression.')): ?>';
                });

                Blade::directive('endhaserror', function () {
                    return '<?php endif; ?>';
                });
        */

        /*
         // -- Functional Extensions
         //Blade::extend( function($value, $compiler)
         //{
         //    return preg_replace("/@set\('(.*?)'\,(.*)\)/", '<?php $$1 = $2; ?>', $value);
         //});

         Blade::extend(function ($value) {
             return preg_replace('/(\s*)@break(\s*)/', '$1<?php break; ?>$2', $value);
         });
         // -- @style
         Blade::directive('style', function ($expression) {
             if (! empty($expression)) {
                 return '<link rel="stylesheet" href="'.$this->stripQuotes($expression).'">';
             }
             return '<style>';
         });

         Blade::directive('endstyle', function () {
             return '</style>';
         });

         // -- @mix
         Blade::directive('mix', function ($expression) {
             if (ends_with($expression, ".css'")) {
                 return '<link rel="stylesheet" href="<?php echo mix('.$expression.') ?>">';
             }
             if (ends_with($expression, ".js'")) {
                 return '<script src="<?php echo mix('.$expression.') ?>"></script>';
             }
             return "<?php echo mix({$expression}); ?>";
         });

         // -- @script
         Blade::directive('script', function ($expression) {
             if (! empty($expression)) {
                 return '<script src="'.DirectivesRepository::stripQuotes($expression).'"></script>';
             }
             return '<script>';
         });

         Blade::directive('endscript', function () {
             return '</script>';
         });
        */

/*
        // -- @routeis
        Blade::directive('routeis', function ($expression) {
            return "<?php if (fnmatch({$expression}, Route::currentRouteName())) : ?>";
        });

        Blade::directive('endrouteis', function ($expression) {
            return '<?php endif; ?>';
        });

        Blade::directive('routeisnot', function ($expression) {
            return "<?php if (! fnmatch({$expression}, Route::currentRouteName())) : ?>";
        });

        Blade::directive('endrouteisnot', function ($expression) {
            return '<?php endif; ?>';
        });
*/

        /*
         // -- dump methofs
         Blade::directive('dd', function ($expression) {
             return "<?php dd(with{$expression}); ?>";
         });

         Blade::directive('dump', function ($expression) {
             return "<?php dump({$expression}); ?>";
         });

         Blade::directive('var_dump', function ($expression) {
             return "<?php var_dump(with{$expression}); ?>";
         });

         Blade::directive('print_r', function ($expression) {
             return "<?php print_r({$expression}); ?>";
         });


         // -- @set
         Blade::directive('set', function ($argumentString) {
             list($name, $value) = $this->getArguments($argumentString);

             return "<?php {$name} = {$value}; ?>";
         });

         Blade::directive('set', function($expression) {
             list($variable, $value) = explode(',', $expression, 2);

             // Ensure variable has no spaces or apostrophes
             $variable = trim(str_replace('\'', '', $variable));

             // Make sure that the variable starts with $
             if (! starts_with($variable, '$')) {
                 $variable = '$' . $variable;
             }

             $value = trim($value);

             return "<?php {$variable} = {$value}; ?>";
         });

         Blade::directive('data', function ($expression) {
             $output = 'collect((array) '.$expression.')
                 ->map(function($value, $key) {
                     return "data-{$key}=\"{$value}\"";
                 })
                 ->implode(" ")';
             return "<?php echo $output; ?>";
         });

         // -- @fa, @fas, @far, @fal, @fab, @glyph
         Blade::directive('fa', function ($expression) {
             $expression = $this->parseMultipleArgs($expression);
             return sprintf(
             '<i class="fa fa-%s %s"></i>',
                     $this->stripQuotes($expression->get(0)),
                     $this->stripQuotes($expression->get(1))
                 );
         });

         Blade::directive('fas', function ($expression) {
             $expression = $this->parseMultipleArgs($expression);
             return sprintf(
             '<i class="fas fa-%s %s"></i>',
                     $this->stripQuotes($expression->get(0)),
                     $this->stripQuotes($expression->get(1))
                 );
         });

         Blade::directive('far', function ($expression) {
             $expression = $this->parseMultipleArgs($expression);
             return sprintf(
             '<i class="far fa-%s %s"></i>',
                     $this->stripQuotes($expression->get(0)),
                     $this->stripQuotes($expression->get(1))
                 );
         });

         Blade::directive('fal', function ($expression) {
             $expression = $this->parseMultipleArgs($expression);
             return sprintf(
             '<i class="fal fa-%s %s"></i>',
                     $this->stripQuotes($expression->get(0)),
                     $this->stripQuotes($expression->get(1))
                 );
         });

         Blade::directive('fab', function ($expression) {
             $expression = $this->parseMultipleArgs($expression);
             return sprintf(
             '<i class="fab fa-%s %s"></i>',
                     $this->stripQuotes($expression->get(0)),
                     $this->stripQuotes($expression->get(1))
                 );
         });

         Blade::directive('glyph', function ($expression) {
             return 'test';
             // $expression = $this->parseMultipleArgs($expression);
             // return sprintf(
             //     '<i class="glyphicons glyphicons-%s %s"></i>',
             //         $this->stripQuotes($expression->get(0)),
             //         $this->stripQuotes($expression->get(1))
             //     );
         });
         */
    }
}
