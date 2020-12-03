<div>
    Show Tweets

    <p>{{ $content }}</p>


    <form method="post" wire:submit.prevent="create">
        <input type="text" name="content" id="content" wire:model="content">
        <button type="submit">Criar Tweet</button>
    </form>
    @error('content')
        <span style="color: red">{{ $message }}</span>
    @enderror
    <hr>

    @foreach ($tweets as $tweet)
        {{ $tweet->user->name}} - {{ $tweet->content }} <br>
    @endforeach

    <hr>
    <div>
        {{ $tweets->links() }}
    </div>

</div>
