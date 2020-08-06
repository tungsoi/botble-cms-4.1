<?php

namespace Botble\DevTool\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\ConfirmableTrait;
use Illuminate\Database\QueryException;

class InstallCommand extends Command
{

    use ConfirmableTrait;

    /**
     * The console command signature.
     *
     * @var string
     */
    protected $signature = 'cms:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install CMS';

    /**
     * @var UserCreateCommand
     */
    protected $userCreateCommand;

    /**
     * InstallCommand constructor.
     * @param UserCreateCommand $userCreateCommand
     */
    public function __construct(UserCreateCommand $userCreateCommand)
    {
        parent::__construct();
        $this->userCreateCommand = $userCreateCommand;
    }

    /**
     * Execute the console command.
     *
     * @return bool
     */
    public function handle()
    {
        $this->info('Starting installation...');
        try {
            $this->call('migrate:fresh');
        } catch (QueryException $exception) {
            $this->call('migrate:fresh');
        }

        if ($this->confirmToProceed('Do you want to add a new admin user?', true)) {
            $this->call($this->userCreateCommand->getName());
        }

        $this->info('Publish vendor assets');
        $this->call('vendor:publish', ['--tag' => 'cms-public']);

        $this->info('Creating a symbolic link from "public/storage" to "storage/app/public"');
        $this->call('storage:link');

        $this->info('Installed Botble CMS successfully!');

        return true;
    }
}
