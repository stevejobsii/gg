<?php
/**
 * Helper for a message system using SweetAlert
 *
 * @param null $title
 * @param null $message
 *
 * @return \Illuminate\Foundation\Application|mixed
 */
function flash($title = null, $message = null)
{
    $flash = app('App\Http\Flash'); // Holt das Objekt aus dem IOC.
    if (func_num_args() == 0) {
        return $flash;
    }
    return $flash->info($title, $message);
}