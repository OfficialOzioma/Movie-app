<?php

namespace App\Traits;

/*
|--------------------------------------------------------------------------
| Api Responser Trait
|--------------------------------------------------------------------------
|
| This trait will be used for any response we sent to clients.
|
*/

trait RequestResponse
{
    protected function success(string $message = null, $data = null, $url = null)
    {
        if ($url) {
            return redirect($url)->with([
                'status' => 'success',
                'message' => $message,
                'data' => $data
            ]);
        }
        return redirect()->back()->with([
            'status' => 'success',
            'message' => $message,
            'data' => $data
        ]);
    }

    protected function error(string $message = null, $data = null, $url = null)
    {
        if ($url) {
            return redirect($url)->with([
                'status' => 'error',
                'message' => $message,
                'data' => $data
            ]);
        }
        return redirect()->back()->with([
            'status' => 'error',
            'message' => $message,
            'data' => $data
        ]);
    }
}