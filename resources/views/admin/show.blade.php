<x-guest-layout>
    <x-auth-card title="Show SIAPAE">
        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <!-- route('register')  -->
            <div class="grid gap-3">
                <!-- Name -->
                <div class="space-y-2">
                    <x-form.label for="name" :value="__('Name')" />

                    <div class="flex border border-gray-400 dark:border-gray-600 bg-white dark:bg-dark-eval-1 font-normal dark:text-gray-300 rounded-lg px-3 py-2">
                        <x-heroicon-o-user aria-hidden="true" class="w-5 h-5 text-gray-500 focus-within:text-gray-900 dark:focus-within:text-gray-40" style="margin-top:1px" />
                        <div class="pl-2">
                            {{$user->name}}
                        </div>
                    </div>
                </div>

                <!-- Email Address -->
                <div class="space-y-2">
                    <x-form.label for="email" :value="__('Email')" />

                    <div class="flex border border-gray-400 dark:border-gray-600 bg-white dark:bg-dark-eval-1 font-normal dark:text-gray-300 rounded-lg px-3 py-2">
                        <x-heroicon-o-mail aria-hidden="true" class="w-5 h-5 text-gray-500 focus-within:text-gray-900 dark:focus-within:text-gray-40" style="margin-top:2px" />
                        <div class="pl-2">
                            {{$user->email}}
                        </div>
                    </div>
                </div>

                <div class="space-y-1 mb-1">
                    <x-form.label for="position" :value="__('Profissão na Apae')" />

                    <div class="border border-gray-400 dark:border-gray-600 bg-white dark:bg-dark-eval-1 font-normal dark:text-gray-300 rounded-lg px-3 py-2">
                        <div class="pl-2">
                            {{$user->position}}
                        </div>
                    </div>
                </div>

                <div class="flex justify-between">
                    <div></div>

                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        <a href="{{ route('admin.index') }}" class="text-blue-500 hover:underline">
                            {{ __('Back') }}
                        </a>
                    </p>
                </div>
            </div>
    </x-auth-card>
</x-guest-layout>