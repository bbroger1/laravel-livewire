<?php

namespace App\Http\Livewire;

use App\Models\Tweet;
use Livewire\Component;

class ShowTweets extends Component
{
    public $message = 'Apenas um teste';

    public function render()
    {
        //recuperar todos os tweets
        $tweets = Tweet::with('user')->get();

        //tem essa forma para passar dados para a view
        return view('livewire.show-tweets', compact('tweets'));

        //ou por meio de array
        /*return view('livewire.show-tweets', [
            'tweets' => $tweets
        ]);*/
    }
}
