<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use Livewire\WithFileUploads;
use illuminate\Support\Str;

class UploadPhoto extends Component
{
    use WithFileUploads;

    public $photo;

    public function render()
    {
        return view('livewire.user.upload-photo');
    }

    public function storagePhoto()
    {
        $this->validate([
            'photo' => 'required|image|max:1024'
        ]);

        $user = auth()->user();

        //definir o nome do arquivo
        $nameUser = Str::slug($user->name);
        $ext = $this->photo->getClientOriginalExtension();
        $filename = $nameUser . '.' . $ext;

        //store é um helper storeAs altera o nome do arquivo
        if ($path = $this->photo->storeAs('users', $filename)) {
            $user->update([
                'profile_photo_path' => $path,
            ]);
        }

        return redirect()->route('tweets.index');
    }
}
