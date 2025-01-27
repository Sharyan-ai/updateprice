<?php

if (!defined("WHMCS")) {
    die("This file cannot be accessed directly.");
}

// اطلاعات اولیه ماژول
function updateprice_config() {
    return [
        'name' => 'ماژول بروزرسانی قیمت محصولات',
        'description' => 'این ماژول قیمت محصولات خاص را بر اساس نرخ دلار (تتر از نوبیتکس) بروزرسانی می‌کند.',
        'version' => '1.0',
        'author' => 'Your Name',
        'fields' => [
            'products' => [
                'FriendlyName' => 'محصولات برای بروزرسانی',
                'Type' => 'text',
                'Size' => '100',
                'Description' => 'شناسه محصولات (Product IDs) را با کاما جدا کنید. مثال: 1,2,3',
            ],
            'margin' => [
                'FriendlyName' => 'حاشیه سود (%)',
                'Type' => 'text',
                'Size' => '10',
                'Description' => 'مقدار درصدی که به نرخ دلار اضافه می‌شود. مثال: 5 برای 5%.',
                'Default' => '0',
            ],
        ],
    ];
}

// فعال‌سازی ماژول
function updateprice_activate() {
    return [
        'status' => 'success',
        'description' => 'ماژول بروزرسانی قیمت با موفقیت فعال شد.',
    ];
}

// غیرفعال‌سازی ماژول
function updateprice_deactivate() {
    return [
        'status' => 'success',
        'description' => 'ماژول بروزرسانی قیمت با موفقیت غیرفعال شد.',
    ];
}
