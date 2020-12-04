<?php

namespace App\Http\Livewire;

use App\Models\Tweet;
use Livewire\Component;
use Livewire\WithPagination;

class ShowTweets extends Component
{
    //traith para não ocorrer refresh quando percorrer a paginação
    use WithPagination;

    public $content = '';

    protected $rules = [
        'content' => 'required|min:3|max:255'
    ];

    public function render()
    {
        //recuperar todos os tweets
        $tweets = Tweet::with('user')->latest()->paginate(10);

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
        /*Tweet::create([
            'content' => $this->content,
            //forma convencional de buscar o id do usuário logado
            //'user_id' => auth()->user()->id,
            //outra forma é utilizando o relacionamento
        ]);*/

        //helper auth trás os dados do usuário autenticado
        auth()->user()->tweets()->create([
            'content' => $this->content,
        ]);

        $this->content = '';
    }

    public function like($idTweet)
    {
        $tweet = Tweet::find($idTweet);

        $tweet->likes()->create([
            'user_id' => auth()->user()->id
        ]);
    }

    public function unlike(Tweet $tweet)
    {
        $tweet->likes()->delete();
    }
}
