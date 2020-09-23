<?php
namespace Deployer;

require 'recipe/laravel.php';

// Project name
// set('application', 'my_project');
set('application', 'l8.be');

// Project repository
// set('repository', 'git@domain.com:username/repository.git');
set('repository', 'git@github.com:mariodeckers/l8.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true);

// Shared files/dirs between deploys
add('shared_files', [
    '.env'
]);
add('shared_dirs', [
    'storage'
]);

// Writable dirs by web server
add('writable_dirs', [
    'storage',
    'storage/logs'
]);


// Hosts

host('raspberrypi')
    ->user('pi')
    ->port(22)
    ->configFile('~/.ssh/config')
    ->identityFile('~/.ssh/id_rsa')
    ->set('ssh_multiplexing', false)
    // ->user('pi')
    // ->configFile('~/.ssh/config')
    // ->set('deploy_path', '~/{{application}}');
    ->set('deploy_path', '/var/html/l8.be/html');

// Tasks

task('build', function () {
    run('cd {{release_path}} && build');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

before('deploy:symlink', 'artisan:migrate');

