<?php

namespace App\Console\Commands;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Console\Command;

class initPermission extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:initPermission';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $user = User::find(1);
        if (!$user) {
            $this->error('user is empty');
            return;
        }

        $owner = new Role();
        $owner->name = 'owner';
        $owner->display_name = 'Blog Owner'; // optional
        $owner->description = 'User is the owner of a given project'; // optional
        $owner->save();

        $managerTopic = new Permission();
        $managerTopic->name = 'manage_topics';
        $managerTopic->display_name = 'Manage Topics'; // optional
        $managerTopic->save();

        $owner->attachPermission($managerTopic);

        $user->attachRole($owner);
    }
}
