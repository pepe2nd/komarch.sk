<?php
declare(strict_types=1);

use ElasticAdapter\Indices\Mapping;
use ElasticAdapter\Indices\Settings;
use ElasticMigrations\Facades\Index;
use ElasticMigrations\MigrationInterface;

final class AddArchitectsToPostsIndex implements MigrationInterface
{
    /**
     * Run the migration.
     */
    public function up(): void
    {
        Index::putMapping('works', function (Mapping $mapping) {
            $mapping->text('architects', ['analyzer' => 'standard_asciifolded']);
        });
    }

    /**
     * Reverse the migration.
     */
    public function down(): void
    {
        //
    }
}
