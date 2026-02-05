<?php

namespace App\Livewire;

use App\Models\Subscriber;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class LandingPage extends Component
{
    public $email;

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
            $subscriber->notify($notification);
        }, $deadlockRetries = 5);

        $this->reset('email');
    }

    public function render()
    {
        return view('livewire.landing-page');
    }
}
