<?php
namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Laravel\Facades\Image;
use LivewireUI\Modal\ModalComponent;

class FiltersModal extends ModalComponent
{
    public $filters = ['Original', 'Clarendon', 'Gingham', 'Moon', 'Perpetua'];
    public $image;
    public $filtered_image;
    public $temp_images = [];
    public $description;
    protected $listeners = ['add_temp_image', 'modalClosed' => 'delete_temp_images'];

    public static function modalMaxWidth(): string
    {
        return '5xl';
    }

    public static function dispatchCloseEvent(): bool
    {
        return true;
    }

    public function mount($image)
    {
        $this->image          = $image;
        $this->filtered_image = $this->image;
        $this->add_temp_image($image);
    }

    public function apply_filter($filter)
    {
        $imagePath = storage_path('app/public') . '/' . $this->image;
        $newPath   = storage_path('app/public/temp') . '/' . Str::random(30) . '.jpeg';

// Read the image to get its original dimensions
        $image = Image::read($imagePath);

// Apply the filter logic based on the selected filter
        switch ($filter) {
            case 'original':
                $image->resize($image->width(), $image->height(), function ($constraint) {
                    $constraint->aspectRatio();
                })
                    ->save($newPath, 95);
                break;

            case 'clarendon':
                $image->brightness(20)
                    ->contrast(15)
                    ->resize($image->width(), $image->height(), function ($constraint) {
                        $constraint->aspectRatio();
                    })
                    ->save($newPath, 95);
                break;

            case 'gingham':
                $image->brightness(20)
                    ->contrast(20)
                    ->colorize(0, -10, -10)
                    ->resize($image->width(), $image->height(), function ($constraint) {
                        $constraint->aspectRatio();
                    })
                    ->save($newPath, 95);
                break;

            case 'moon':
                $image->brightness(10)
                    ->contrast(5)
                    ->greyscale()
                    ->resize($image->width(), $image->height(), function ($constraint) {
                        $constraint->aspectRatio();
                    })
                    ->save($newPath, 95);
                break;

            case 'perpetua':
                $image->contrast(-10)
                    ->colorize(-30, 10, 10)
                    ->resize($image->width(), $image->height(), function ($constraint) {
                        $constraint->aspectRatio();
                    })
                    ->save($newPath, 95);
                break;
        }

        $this->filtered_image = 'temp/' . basename($newPath);
        $this->dispatch('add_temp_image', $this->filtered_image);
    }

    public function publish()
    {
        $this->validate([
            'description' => 'required',
        ]);

        $sourcePath      = storage_path('app/public/' . $this->filtered_image);
        $destinationPath = storage_path('app/public/posts/' . Str::random(30) . '.jpeg');

        if (File::exists($sourcePath)) {
            File::move($sourcePath, $destinationPath);
        } else {
            session()->flash('error', 'The filtered image was not found.');
            return;
        }

        $post_image = str_replace(storage_path('app/public/'), '', $destinationPath);

        $post = auth()->user()->posts()->create([
            'description' => $this->description,
            'slug'        => Str::random(10),
            'image'       => $post_image,
        ]);
        $this->dispatch('postCreated', $post->id); 
        $this->forceClose()->closeModal();
    }

    public function add_temp_image($image)
    {
        array_push($this->temp_images, 'public/' . $image);
    }

    public function delete_temp_images()
    {
        if (! empty($this->temp_images)) {
            $files = array_map(fn($file) => str_replace('public/', '', $file), $this->temp_images);

            Storage::disk('public')->delete($files);
            $this->temp_images = [];
        }
    }

    public function render()
    {
        return view('livewire.filters-modal');
    }
}