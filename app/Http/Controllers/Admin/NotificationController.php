<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\NotificationMinimumMailable;
use Illuminate\Support\Facades\Mail;

class NotificationController extends Controller
{
    public function NotificationMinimum()
    {
        $sendmail = $this->NotificationMinimumMail();
        return view('backend.notification.notification_email');
    }

    public function NotificationMinimumMail()
    {
        try {
            $allData = Product::latest()->get();

            foreach ($allData as $item) {
                if ($item->to_reorder > $item->quantity) {
                    Mail::to("franciscoterence98@gmail.com")->send(new NotificationMinimumMailable($allData));
                }
            }
        } catch (\Exception $e) {
            
        }
    }
}
