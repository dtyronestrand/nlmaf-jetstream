<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  array<string, mixed>  $input
     */
    public function update(User $user, array $input): void
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
            'bio' => ['nullable', 'string', 'max:500'],
        ])->validateWithBag('updateProfileInformation');

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {
            // Update User model for name and email
            $user->forceFill([
                'name' => $input['name'],
                'email' => $input['email'],
            ])->save();

            // Update Profile model for bio
            if ($user->profile) { // User model has $with = ['profile'], so it should be loaded
                $user->profile->forceFill([
                    'bio' => $input['bio'] ?? null,
                ])->save();
            }
            // Optionally, handle cases where a profile might not exist, though User::booted() should create one.
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  array<string, string>  $input
     */
    protected function updateVerifiedUser(User $user, array $input): void
    {
        // Update User model for name, email, and verification status
        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();

        // Update Profile model for bio
        if ($user->profile) {
            $user->profile->forceFill([
                'bio' => $input['bio'] ?? null,
            ])->save();
        }
        // Optionally, handle cases where a profile might not exist.

        $user->sendEmailVerificationNotification();
    }
}
