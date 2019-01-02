<?php
namespace Deployer;
require 'recipe/laravel.php';

// Configuration

set('ssh_type', 'native');
set('ssh_multiplexing', false);

set('repository', 'https://gitlab.com/denora/kabootar-api.git');

add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);

// Servers

host('denora.ir')
    ->user('root')
    ->port(22)
    //->password('oQg70v8F5i')
    ->configFile('~/.ssh/config')
    ->identityFile('~/.ssh/id_rsa')
    ->set('deploy_path', '/home/admin/domains/denora.ir')
    ->forwardAgent(true);
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
