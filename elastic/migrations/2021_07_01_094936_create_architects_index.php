<?php
declare(strict_types=1);

use ElasticAdapter\Indices\Mapping;
use ElasticAdapter\Indices\Settings;
use ElasticMigrations\Facades\Index;
use ElasticMigrations\MigrationInterface;

final class CreateArchitectsIndex implements MigrationInterface
{
    /**
     * Run the migration.
     */
    public function up(): void
    {
        Index::createIfNotExists('architects', function (Mapping $mapping, Settings $settings) {
            $mapping->text('first_name', ['analyzer' => 'standard_asciifolded']);
            $mapping->text('last_name', ['boost' => 2, 'analyzer' => 'standard_asciifolded']);

            $settings->analysis([
                'analyzer' => [
                    'standard_asciifolded' => [
                        'type' => 'custom',
                        'tokenizer' => 'standard',
                        'filter' => [
                            'lowercase',
                            'asciifolding',
                        ],
                    ]
                ],
            ]);
        });
    }

    /**
     * Reverse the migration.
     */
    public function down(): void
    {
        Index::drop('architects');
    }
}
