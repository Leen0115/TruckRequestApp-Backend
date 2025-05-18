<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('orders', function ($user) {
    return true; 
});
Broadcast::channel('new-order', function () {
    return true;
});