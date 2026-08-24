<?php

define('LARAVEL_START', microtime(true));

require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

use App\Models\BusinessSetting;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Riya Fashion — Admin Diagnostics & WhatsApp Fix</title>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; background: #0f172a; color: #f8fafc; padding: 40px 20px; line-height: 1.6; }
        .card { background: #1e293b; border-radius: 12px; max-width: 700px; margin: 0 auto; padding: 30px; box-shadow: 0 20px 40px rgba(0,0,0,0.5); border: 1px solid #334155; }
        h1 { color: #c59b27; margin-top: 0; font-size: 24px; }
        .badge { display: inline-block; padding: 4px 10px; border-radius: 6px; font-weight: bold; font-size: 12px; }
        .badge-success { background: #059669; color: white; }
        .badge-error { background: #dc2626; color: white; }
        table { width: 100%; border-collapse: collapse; margin: 20px 0; font-size: 14px; }
        th, td { padding: 10px; border: 1px solid #334155; text-align: left; }
        th { background: #0b1329; color: #94a3b8; }
        .btn { display: inline-block; background: #25d366; color: white; font-weight: bold; padding: 12px 24px; border-radius: 8px; text-decoration: none; margin-top: 15px; }
        .btn-gold { background: #c59b27; }
        .btn:hover { opacity: 0.9; }
        pre { background: #0b1329; padding: 12px; border-radius: 6px; overflow-x: auto; color: #38bdf8; font-size: 13px; }
    </style>
</head>
<body>
<div class="card">
    <h1>🔧 Riya Fashion — Admin & WhatsApp Auto-Fixer</h1>

    <?php
    try {
        $dbName = DB::connection()->getDatabaseName();
        echo "<p>Connected Database: <strong>" . htmlspecialchars($dbName) . "</strong> <span class='badge badge-success'>CONNECTED</span></p>";

        // Ensure users table exists & add is_admin
        if (Schema::hasTable('users')) {
            if (!Schema::hasColumn('users', 'is_admin')) {
                Schema::table('users', function ($table) {
                    $table->boolean('is_admin')->default(true);
                });
            }

            User::truncate();
            $admin = User::create([
                'name' => 'Pintu Kukadiya',
                'email' => 'adminuse0@gmail.com',
                'password' => 'admin123',
                'is_admin' => true,
            ]);

            echo "<p><span class='badge badge-success'>✅ Admin User: adminuse0@gmail.com / admin123 CREATED</span></p>";
        }

        // Update Business Settings WhatsApp Number and Link
        if (Schema::hasTable('business_settings')) {
            $msg = "Hello Riya Fashion,\n\nI am interested in your saree processing services (Lace Patti Work, Diamond Work, Hotfix Work, Roll Polish, etc.).\n\nPlease share details about pricing, minimum quantity, turnaround time, and available services.\n\nThank you.";
            $waLink = 'https://wa.me/919574731418?text=' . rawurlencode($msg);

            BusinessSetting::updateOrCreate(
                ['id' => 1],
                [
                    'phone' => '+91 9574731418',
                    'whatsapp_number' => '+91 9574731418',
                    'whatsapp_link' => $waLink,
                ]
            );

            echo "<p><span class='badge badge-success'>✅ WhatsApp Number: +91 9574731418 & Prefilled Link UPDATED</span></p>";
            echo "<p style='font-size: 13px; color: #94a3b8;'>WhatsApp Link: <a href='" . htmlspecialchars($waLink) . "' target='_blank' style='color: #25d366;'>" . htmlspecialchars($waLink) . "</a></p>";
        }

        echo "<div style='text-align: center; margin-top: 25px; display: flex; gap: 10px; justify-content: center;'>";
        echo "<a href='/admin/login' class='btn btn-gold'>👉 Go to Admin Login</a>";
        echo "<a href='/' class='btn'>👉 Go to Homepage</a>";
        echo "</div>";

    } catch (\Throwable $e) {
        echo "<h2><span class='badge badge-error'>ERROR</span></h2>";
        echo "<pre>" . htmlspecialchars($e->getMessage()) . "</pre>";
    }
    ?>
</div>
</body>
</html>
