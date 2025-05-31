<section class="w-full">
    @include('partials.settings-heading')

    <x-settings.layout heading="Perfil" subheading="Actualiza tu nombre y dirección de correo">
        <form wire:submit="updateProfileInformation" class="my-6 w-full space-y-6 bg-white dark:bg-zinc-900 p-6 rounded-2xl shadow">
            <!-- Nombre -->
            <div>
                <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Nombre</label>
                <flux:input 
                    wire:model="name" 
                    type="text" 
                    required 
                    autofocus 
                    autocomplete="name" 
                    placeholder="Tu nombre completo"
                />
            </div>

            <!-- Correo electrónico -->
            <div>
                <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Correo electrónico</label>
                <flux:input 
                    wire:model="email" 
                    type="email" 
                    required 
                    autocomplete="email" 
                    placeholder="correo@ejemplo.com"
                />

                @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! auth()->user()->hasVerifiedEmail())
                    <div class="mt-4 text-sm text-zinc-600 dark:text-zinc-400">
                        Tu dirección de correo no está verificada.

                        <flux:link class="text-blue-600 hover:underline cursor-pointer ml-1" wire:click.prevent="resendVerificationNotification">
                            Haz clic aquí para reenviar el correo de verificación.
                        </flux:link>

                        @if (session('status') === 'verification-link-sent')
                            <flux:text class="mt-2 font-medium text-green-600 dark:text-green-400">
                                Se ha enviado un nuevo enlace de verificación a tu correo electrónico.
                            </flux:text>
                        @endif
                    </div>
                @endif
            </div>

            <!-- Botón guardar y mensaje -->
            <div class="flex items-center gap-4">
                <div class="flex-1">
                    <flux:button variant="primary" type="submit" class="w-full py-2 rounded-xl text-white bg-blue-600 hover:bg-blue-700 transition">
                        Guardar
                    </flux:button>
                </div>

                <x-action-message class="me-3 text-green-600 dark:text-green-400" on="profile-updated">
                    Guardado.
                </x-action-message>
            </div>
        </form>

        <livewire:settings.delete-user-form />
    </x-settings.layout>
</section>
