<?php

use Illuminate\Support\Collection;

if (! Collection::hasMacro('range')) {
    /*
     * Create a new collection instance with a range of numbers. `range`
     * accepts the same parameters as PHP's standard `range` function.
     *
     * @see range
     *
     * @param mixed $start
     * @param mixed $end
     * @param int|float $step
     *
     * @return \Illuminate\Support\Collection
     */
    Collection::macro('range', function ($start, $end, $step = 1): Collection {
        return new Collection(range($start, $end, $step));
    });
}

// -- return sizes readable by humans
function human_filesize($size, $decimals = 2)
{
    $unit = ['B', 'kB', 'MB', 'GB', 'TB', 'PB'];

    return @round($size/pow(1024, ($i=floor(log($size, 1024)))), $decimals) . $unit[$i];
    return sprintf("%.{$decimals}f", $size / pow(1024, $i = floor((strlen($size) - 1) / 3))) . @$unit[$i];
}


// flash notifications
if (! function_exists('flash')) {
    /**
     * Arrange for a flash message.
     *
     * @param  string|null $message
     * @param  string      $level
     * @return \Laracasts\Flash\FlashNotifier
     */
    function flash($message = null, $level = 'info', $title = null)
    {
        switch ($level) {
            default:
            case 'info':
                is_null($title)
                    ? Flash::info($message)
                    : Flash::info($title, $message);
            break;

            case 'success':
                is_null($title)
                    ? Flash::success($message)
                    : Flash::success($title, $message);
            break;

            case 'warning':
                is_null($title)
                    ? Flash::warning($message)
                    : Flash::warning($title, $message);
            break;

            case 'error':
                is_null($title)
                    ? Flash::error($message)
                    : Flash::error($title, $message);
            break;
        }
    }
}

// user
if (! function_exists('user')) {
    function user()
    {
        if (auth()->check()) {
            return auth()->user();
        }

        return new \App\Models\NullModel;
    }
}

if (! function_exists('yesno')) {
    /**
     *  Show translated yes/no based on expression
     *
     * @param  mix  $expression
     * @param  null|boolean  $which
     *
     * @return string
     */
    function yesno($expression = null, $which = null)
    {
        return empty($expression)
            ? (($which !== true) ? trans('app.no') : '')
            : (($which !== false) ? trans('app.yes') : '');
    }
}

// -- is the mime type an image
function is_image($mimeType)
{
    return starts_with($mimeType, 'image/');
}

function index_page_size($value = null)
{
    if (is_null($value)) {
        return session()->get('itemsPerIndexPage');
    }

    return session()->get('itemsPerIndexPage') == $value;
}
