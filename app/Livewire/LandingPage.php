<?php

namespace App\Livewire;

use App\Models\Subscriber;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Livewire\Component;

class LandingPage extends Component
{
    public $email;
    public $showSubscribe = false;
    public $showSuccess = false;

    // Validation
    protected $rules = [
        'email' => 'required|email:filter|unique:subscribers,email',
    ];

    public function subscribe()
    {
        // Validation
        $this->validate();

        DB::transaction(function () {
            // Create data
            $subscriber = Subscriber::create([
                'email' => $this->email,
            ]);

            // Send notification
            $notification = new VerifyEmail;

            // Send to different email then create web route
            $notification->createUrlUsing(function ($notifiable) {
                return URL::temporarySignedRoute(
                    'subscribers.verify',
                    now()->addMinutes(30),
                    [
                        'subscriber' => $notifiable->getKey()
                    ],
                );
            });

            $subscriber->notify($notification);
        }, $deadlockRetries = 5);

        $this->reset('email');
        $this->showSubscribe = 'false';
        $this->showSuccess = 'true';
    }

    public function mount(Request $request)
    {
        if ($request->has('verified') && $request->verified == 1) {
            $this->showSuccess = 'true';
        }
    }

    public function render()
    {
        return view('livewire.landing-page');
    }
}
