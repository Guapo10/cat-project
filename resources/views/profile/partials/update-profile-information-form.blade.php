<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <!-- Name input -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Name') }}</label>
            <input id="name" name="name" type="text" class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
            @error('name')
                <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <!-- Email input -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Email') }}</label>
            <input id="email" name="email" type="email" class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="{{ old('email', $user->email) }}" required autocomplete="username">
            @error('email')
                <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror

            <!-- Email verification info -->
            <!-- ... -->
        </div>

        <!-- Bio input -->
        <div>
            <label for="bio" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ __('Bio') }}</label>
            <textarea id="bio" name="bio" rows="4" class="mt-1 block w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" placeholder="{{ __('Tell something about yourself...') }}">{{ old('bio', $user->bio) }}</textarea>
            @error('bio')
                <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <!-- Profile photo input -->
        <div class="row mb-3">
            <label for="profile_photo_path" class="col-md-4 col-form-label text-md-end">{{ __('Profile Photo') }}</label>
            <div class="col-md-6">
                <input id="profile_photo_path" type="file" class="form-control @error('profile_photo_path') is-invalid @enderror" name="profile_photo_path" required>
                @error('profile_photo_path')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <!-- Save button -->
        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            <!-- Profile update success message -->
            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
