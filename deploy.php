<?php
namespace Deployer;
require 'recipe/laravel.php';

// Configuration

set('ssh_type', 'native');
set('ssh_multiplexing', false);
set('http_user', 'admin');
set('http_group', 'admin');
set('writable_mode', 'chown');
set('writable_chmod_recursive', true);
set('writable_use_sudo', true);

set('repository', 'https://github.com/Mohammad-Alavi/Samandoon-v2');

add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);

set('branch', 'develop');

// Servers

host('server-samandoon.ir')
    ->user('admin')
    ->port(22)
//    ->password('ASDaSAD@@#1sad')
//    ->password('oQg70v8F5i')
    ->configFile('~/.ssh/config')
    ->identityFile('~/.ssh/1990')
    ->forwardAgent(true)
    ->multiplexing(true)
    ->set('deploy_path', '/home/admin/domains/server-samandoon.ir');
//    ->become('admin');
//    ->pty(true);

// Tasks

desc('Restart PHP-FPM service');
task('php-fpm:restart', function () {
    // The user must have rights for restart service
    // /etc/sudoers: username ALL=NOPASSWD:/bin/systemctl restart php-fpm.service
    run('sudo systemctl restart php-fpm72');
});
after('deploy:symlink', 'php-fpm:restart');

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

before('deploy:symlink', 'artisan:migrate');
//before('artisan:migrate', 'artisan:db:seed');
