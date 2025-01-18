<?php

use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

Route::get('send-mail', [MailController::class, 'index']);

require __DIR__.'/auth.php';
