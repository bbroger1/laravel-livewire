<?php

namespace App\Http\Livewire;

use App\Models\Tweet;
use Livewire\Component;
use Livewire\WithPagination;

class ShowTweets extends Component
{
    //traith para não ocorrer refresh quando percorrer a paginação
    use WithPagination;

    public $content = 'Apenas um teste';

    protected $rules = [
        'content' => 'required|min:3|max:255'
    ];

    public function render()
    {
        //recuperar todos os tweets
        $tweets = Tweet::with('user')->paginate(3);

        //tem essa forma para passar dados para a view
        return view('livewire.show-tweets', compact('tweets'));

        //ou por meio de array
        /*return view('livewire.show-tweets', [
            'tweets' => $tweets
        ]);*/
    }

    public function create()
    {
        $this->validate();
        Tweet::create([
            'content' => $this->content,
            'user_id' => 1,
        ]);

        $this->content = '';
    }
}
