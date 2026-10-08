<?php

use Illuminate\Support\Facades\Route;

test('requests forwarded as https by the proxy are treated as secure', function () {
    Route::get('/_scheme', fn () => request()->getScheme());

    $this->get('http://localhost/_scheme')->assertContent('http');
    $this->get('http://localhost/_scheme', ['X-Forwarded-Proto' => 'https'])->assertContent('https');
});
