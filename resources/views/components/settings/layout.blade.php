<div class="flex items-start max-md:flex-col">
    <!-- Menú lateral -->
    <div class="me-10 w-full pb-4 md:w-[220px]">
        <flux:navlist>
            <flux:navlist.item :href="route('settings.profile')" wire:navigate>
                Perfil
            </flux:navlist.item>
            <flux:navlist.item :href="route('settings.password')" wire:navigate>
                Contraseña
            </flux:navlist.item>
            <flux:navlist.item :href="route('settings.appearance')" wire:navigate>
                Apariencia
            </flux:navlist.item>
        </flux:navlist>
    </div>

    <!-- Separador solo para móviles -->
    <flux:separator class="md:hidden" />

    <!-- Contenido principal -->
    <div class="flex-1 self-stretch max-md:pt-6">
        <flux:heading>{{ $heading ?? '' }}</flux:heading>
        <flux:subheading class="text-zinc-600 dark:text-zinc-400">{{ $subheading ?? '' }}</flux:subheading>

        <div class="mt-5 w-full max-w-lg bg-white dark:bg-zinc-900 rounded-2xl shadow p-6">
            {{ $slot }}
        </div>
    </div>
</div>

