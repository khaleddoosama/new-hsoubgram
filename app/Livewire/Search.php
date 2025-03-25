<?php
namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class Search extends Component
{
    public $searchInput = '';
    public $results     = [];

    public function clear()
    {
        $this->reset('results');
        $this->reset('searchInput');
    }

    public function goto ($username)
    {
        return redirect()->route('userprofile', ['user' => $username]);
    }

    public function render()
    {
        sleep(1);
        $this->results = [];
        $this->results = User::where('username', 'LIKE', '%' . $this->searchInput . '%')->get(['id', 'name', 'username', 'image']);
       
        return view('livewire.search', [
            'results' => $this->results,
        ]);
    }
}