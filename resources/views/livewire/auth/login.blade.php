<div class="max-w-md w-full mx-auto bg-white dark:bg-zinc-900 rounded-2xl shadow-lg p-8 space-y-6">
    <div class="text-center">
        <h2 class="text-2xl font-bold text-zinc-800 dark:text-white">Iniciar sesión en tu cuenta</h2>
        <p class="mt-1 text-sm text-zinc-600 dark:text-zinc-400">Ingresa tu correo y contraseña para acceder</p>
    </div>

    <!-- Estado de sesión -->
    <x-auth-session-status class="text-center text-sm text-green-600 dark:text-green-400" :status="session('status')" />

    <form wire:submit="login" class="space-y-5">
        <!-- Correo electrónico -->
        <div>
            <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Correo electrónico</label>
            <flux:input
                wire:model="email"
                type="email"
                required
                autofocus
                autocomplete="email"
                placeholder="correo@ejemplo.com"
            />
        </div>

        <!-- Contraseña -->
        <div class="relative">
            <label class="block text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-1">Contraseña</label>
            <flux:input
                wire:model="password"
                type="password"
                required
                autocomplete="current-password"
                placeholder="••••••••"
                viewable
            />
            @if (Route::has('password.request'))
                <flux:link class="absolute end-0 top-0 text-sm text-blue-600 hover:underline" :href="route('password.request')" wire:navigate>
                    ¿Olvidaste tu contraseña?
                </flux:link>
            @endif
        </div>

        <!-- Recordarme -->
        <div class="flex items-center">
            <flux:checkbox wire:model="remember" label="Recordarme" />
        </div>

        <!-- Botón -->
        <div>
            <flux:button variant="primary" type="submit" class="w-full py-2 rounded-xl text-white bg-blue-600 hover:bg-blue-700 transition">
                Iniciar sesión
            </flux:button>
        </div>
    </form>

    <!-- Enlace a registro -->
    @if (Route::has('register'))
        <div class="text-center text-sm text-zinc-600 dark:text-zinc-400">
            ¿No tienes una cuenta?
            <flux:link :href="route('register')" wire:navigate class="text-blue-600 hover:underline">Regístrate</flux:link>
        </div>
    @endif
</div>
