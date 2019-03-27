<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Spatie\Html\Html;
use Spatie\Html\Elements\Select;

class FormMacrosServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // -- select z latami
        Html::macro('selectYear', function($name = null, $start = 1970, $stop = NULL, $value = null) {
            $start = is_numeric($start) ? (int)$start : 1970;
            $stop = is_numeric($stop) ? (int)$stop : (int)date('Y');
            $value = is_numeric($value) ? (int)$value : null;

            $options = collect()->range($start, $stop);
            $options = $options -> combine($options);

            return Select::create()
                -> attributeIf($name, 'name', $this->fieldName($name))
                -> attributeIf($name, 'id', $this->fieldName($name))
                -> options($options)
                -> value($name ? $this->old($name, $value) : $value);
        });


        // -- select z miesiacami roku
        Html::macro('selectMonth', function($name = null, $value = null) {

            $options = [
                1   => trans('app.months.january'),
                2   => trans('app.months.february'),
                3   => trans('app.months.march'),
                4   => trans('app.months.april'),
                5   => trans('app.months.may'),
                6   => trans('app.months.june'),
                7   => trans('app.months.july'),
                8   => trans('app.months.august'),
                9   => trans('app.months.september'),
                10  => trans('app.months.october'),
                11  => trans('app.months.november'),
                12  => trans('app.months.december'),
            ];

            return Select::create()
                            -> attributeIf($name, 'name', $this->fieldName($name))
                            -> attributeIf($name, 'id', $this->fieldName($name))
                            -> options($options)
                            -> value($name ? $this->old($name, $value) : $value);
        });


        // -- select z dniami tygodnia
        Html::macro('selectDay', function($name = null, $value = null){
            $options = [
                1   => trans('app.days.monday'),
                2   => trans('app.days.tuesday'),
                3   => trans('app.days.wednesday'),
                4   => trans('app.days.thursday'),
                5   => trans('app.days.friday'),
                6   => trans('app.days.saturday'),
                7   => trans('app.days.sunday'),
            ];

            return Select::create()
                        -> attributeIf($name, 'name', $this->fieldName($name))
                        -> attributeIf($name, 'id', $this->fieldName($name))
                        -> options($options)
                        -> value($name ? $this->old($name, $value) : $value);
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}