<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class CreateDriver extends Component
{
    public $confirmingDriverCreation = false;

    public $name = '';
    public $email = '';

    public function confirmDriverCreation()
    {
        $this->resetErrorBag();

        $this->name = '';
        $this->email = '';

        $this->dispatchBrowserEvent('confirming-create-user');

        $this->confirmingDriverCreation = true;
    }

    public function createDriver()
    {
        $this->resetErrorBag();

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
        ]);

        $user->driver()->create(['balance' => 211]);

        $this->confirmingDriverCreation = false;

        $this->emitUp('foo');
        // $this->emit('driverCreated');
        // $this->emitUp('driverCreated');
        // $this->emitSelf('driverCreated');
        // $this->emitTo('driver', 'driverCreated');

    }

    public function render()
    {
        return view('livewire.create-driver');
    }
}
