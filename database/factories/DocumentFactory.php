<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\Document;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Document>
 */
class DocumentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(),
        ];
    }

    /**
     * Indicate that the document has a file.
     *
     * @return \Database\Factories\DocumentFactory
     */
    public function configure()
    {
        return $this->afterCreating(function (Document $document) {
            $file = database_path('factories/files/test.pdf');
            $document->addMedia($file)->preservingOriginal()->toMediaCollection('file');
        });
    }
}
