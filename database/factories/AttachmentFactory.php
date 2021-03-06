<?php

namespace Database\Factories;

use App\Models\Attachment;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class AttachmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Attachment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $width = 500;
        $height = 400;

        $file = $this->faker->image(null, $width, $height);
        $path = Storage::putFile('items', $file);
        File::delete($file);


        return [
            'item_id' => \App\Models\Item::Factory()->create(),
            'org_name' => basename($file),
            'name' => basename($path),
        ];
    }
}
