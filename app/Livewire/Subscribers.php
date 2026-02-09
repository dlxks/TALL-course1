<?php

namespace App\Livewire;

use App\Models\Subscriber;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url; //import for URL history in LW3

class Subscribers extends Component
{
    use WithPagination;

    // URL history
    #[Url(history: true)]
    public $search = '';

    // Reset search on refresh
    public function updatingSearch()
    {
        $this->resetPage();
    }

    // Delete subscriber
    public function delete(int $id)
    {
        Subscriber::findOrFail($id)->delete();
        session()->flash('message', 'Subscriber deleted successfully.');
    }

    public function render()
    {
        return view('livewire.subscribers', [
            'subscribers' => Subscriber::query()
                ->when($this->search, fn($q) => $q->where('email', 'like', "%{$this->search}%"))
                ->orderBy('created_at', 'desc')
                ->paginate(10)
        ]);
    }
}
