<?php
namespace Deployer;

require 'recipe/laravel.php';

// Config

set('writable_mode', 'chmod');
set('writable_chmod_mode', '0775');

set('bin/php', 'php8.2');
set('bin/composer', '{{bin/php}} {{deploy_path}}/.dep/composer.phar');
set('bin/npm', 'n --offline exec 14 npm');

set('repository', 'git@github.com:SlovakNationalGallery/komarch.sk.git');

add('shared_files', ['auth.json']);
add('shared_dirs', ['public/wp-content']);

// Hosts

host('webumenia.sk')
    ->set('remote_user', 'lab_sng')
    ->set('deploy_path', '/var/www/komarch.sk');

// Tasks

task('build', function () {
    cd('{{release_path}}');
    run('npm ci && npm run prod');
});

// Hooks

before('artisan:migrate', 'artisan:cache:clear');
after('deploy:vendors', 'build');
after('deploy:symlink', 'artisan:queue:restart');
after('deploy:failed', 'deploy:unlock');
