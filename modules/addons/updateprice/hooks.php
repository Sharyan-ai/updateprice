<?php

use WHMCS\Database\Capsule;

if (!defined("WHMCS")) {
    die("This file cannot be accessed directly.");
}

// تعریف هوک برای بروزرسانی قیمت
add_hook('DailyCronJob', 1, function () {
    $moduleConfig = Capsule::table('tbladdonmodules')
        ->where('module', 'updateprice')
        ->pluck('value', 'setting');

    $products = explode(',', $moduleConfig['products']);
    $margin = isset($moduleConfig['margin']) ? (float)$moduleConfig['margin'] : 0;

    // دریافت قیمت تتر از نوبیتکس
    $tetherPrice = getTetherPrice();
    if (!$tetherPrice) {
        logActivity("خطا در دریافت قیمت تتر از نوبیتکس");
        return;
    }

    // اضافه کردن حاشیه سود به نرخ دلار
    $usdPrice = $tetherPrice * (1 + $margin / 100);

    // بروزرسانی قیمت محصولات
    foreach ($products as $productId) {
        Capsule::table('tblpricing')
            ->where('relid', (int)$productId)
            ->where('type', 'product')
            ->update([
                'monthly' => $usdPrice, // تغییر قیمت ماهانه
                'quarterly' => $usdPrice * 3, // تغییر قیمت سه ماهه
                'semiannually' => $usdPrice * 6, // تغییر قیمت شش ماهه
                'annually' => $usdPrice * 12, // تغییر قیمت سالانه
            ]);
    }

    logActivity("قیمت محصولات مشخص شده با موفقیت بروزرسانی شد.");
});

// تابع برای دریافت قیمت تتر از نوبیتکس
function getTetherPrice() {
    $url = 'https://api.nobitex.ir/market/stats';
    $response = file_get_contents($url);
    $data = json_decode($response, true);

    if (isset($data['stats']['USDTIRT']['latest'])) {
        return (float)$data['stats']['USDTIRT']['latest'];
    }

    return null;
}
