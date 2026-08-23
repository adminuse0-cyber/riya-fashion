<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CreateAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create
                            {--name= : Name of the administrator}
                            {--email= : Email address of the administrator}
                            {--password= : Password for the administrator}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Securely create or update an administrator account without exposing passwords in source code';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('==========================================');
        $this->info('  Riya Fashion - Secure Admin Account Setup');
        $this->info('==========================================');

        // Retrieve or prompt for Name
        $name = $this->option('name') ?: env('ADMIN_NAME');
        if (empty($name)) {
            $name = $this->ask('Enter Administrator Name', 'Pintu Kukadiya');
        }

        // Retrieve or prompt for Email
        $email = $this->option('email') ?: env('ADMIN_EMAIL');
        if (empty($email)) {
            $email = $this->ask('Enter Administrator Email Address', 'admin@riyafashion.com');
        }

        $emailValidator = Validator::make(['email' => $email], [
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);

        if ($emailValidator->fails()) {
            $this->error('Invalid email address provided: ' . $emailValidator->errors()->first('email'));
            return Command::FAILURE;
        }

        // Retrieve or prompt for Password
        $password = $this->option('password') ?: env('ADMIN_PASSWORD');
        if (empty($password)) {
            $password = $this->secret('Enter Secure Administrator Password (min 8 characters)');
            $confirmPassword = $this->secret('Confirm Administrator Password');

            if ($password !== $confirmPassword) {
                $this->error('Passwords do not match. Admin creation aborted.');
                return Command::FAILURE;
            }
        }

        $passwordValidator = Validator::make(['password' => $password], [
            'password' => ['required', 'string', 'min:8'],
        ]);

        if ($passwordValidator->fails()) {
            $this->error('Password validation failed: ' . $passwordValidator->errors()->first('password'));
            return Command::FAILURE;
        }

        // Create or update user
        $user = User::where('email', $email)->first();

        if ($user) {
            $this->warn("User with email [{$email}] already exists.");
            if ($this->confirm('Do you want to update this administrator password and details?', true)) {
                $user->name = $name;
                $user->password = Hash::make($password);
                $user->is_admin = true;
                $user->save();
                $this->info("✓ Administrator account [{$email}] successfully updated with new secure hashed password.");
                return Command::SUCCESS;
            }
            return Command::SUCCESS;
        }

        User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'is_admin' => true,
        ]);

        $this->info("✓ Administrator account [{$email}] successfully created!");
        $this->info('Note: Passwords are encrypted using Bcrypt and never stored in plain text.');

        return Command::SUCCESS;
    }
}
