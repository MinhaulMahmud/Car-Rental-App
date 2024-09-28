<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Rental;
use App\Models\Car;
use App\Models\User;

class CarRentalConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $rental;
    public $car;
    public $user;

    public function __construct(Rental $rental, Car $car, User $user)
    {
        $this->rental = $rental;
        $this->car = $car;
        $this->user = $user;
    }

    public function build()
    {
        return $this->view('email.Car-rental-Confirmation')
                    ->subject('Rental Confirmation')
                    ->with([
                        'rental' => $this->rental,
                        'car' => $this->car,
                        'user' => $this->user,
                    ]);
    }
}

