<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800">
        <flux:sidebar sticky stashable class="border-r border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
            <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

            <a href="{{ route('dashboard') }}" class="mr-5 flex items-center space-x-2" wire:navigate>
                <x-app-logo class="size-8" href="#"></x-app-logo>
            </a>

            <flux:navlist variant="outline">
                <flux:navlist.group heading="Platform" class="grid">
                    <flux:navlist.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>{{ __('messages.Dashboard') }}</flux:navlist.item>
                    
                    @if(auth()->user()->can('user.view') || auth()->user()->can('user.create') || auth()->user()->can('user.edit') || auth()->user()->can('user.delete'))
                        <flux:navlist.item icon="users" :href="route('users.index')" :current="request()->routeIs('users.index')" wire:navigate>{{ __('Users') }}</flux:navlist.item>
                    @endif

                    @if(auth()->user()->can('role.view') || auth()->user()->can('role.create') || auth()->user()->can('role.edit') || auth()->user()->can('role.delete'))
                        <flux:navlist.item icon="link-slash" :href="route('roles.index')" :current="request()->routeIs('roles.index')" wire:navigate>{{ __('Roles') }}</flux:navlist.item>
                    @endif

                    @if(auth()->user()->can('product.view') || auth()->user()->can('product.create') || auth()->user()->can('product.edit') || auth()->user()->can('product.delete'))
                        <flux:navlist.item icon="list-bullet" :href="route('products.index')" :current="request()->routeIs('products.index')" wire:navigate>{{ __('Products') }}</flux:navlist.item>
                    @endif

                    @if(auth()->user()->can('categoria.view') || auth()->user()->can('categoria.create') || auth()->user()->can('categoria.edit') || auth()->user()->can('categoria.delete'))
                        <flux:navlist.item icon="rectangle-stack" :href="route('categorias.index')" :current="request()->routeIs('categorias.index')" wire:navigate>{{ __('categorias') }}</flux:navlist.item>
                    @endif

                    @if(auth()->user()->can('presupuesto.view') || auth()->user()->can('presupuesto.create') || auth()->user()->can('presupuesto.edit') || auth()->user()->can('presupuesto.delete'))
                        <flux:navlist.item icon="wallet" :href="route('presupuestos.index')" :current="request()->routeIs('presupuestos.index')" wire:navigate>{{ __('presupuestos') }}</flux:navlist.item>
                    @endif

                    @if(auth()->user()->can('transaccion.view') || auth()->user()->can('transaccion.create') || auth()->user()->can('transaccion.edit') || auth()->user()->can('transaccion.delete'))
                        <flux:navlist.item icon="banknotes" :href="route('transacciones.index')" :current="request()->routeIs('transacciones.index')" wire:navigate>{{ __('transacciones') }}</flux:navlist.item>
                    @endif
                    
                    @if(auth()->user()->can('reporte.view') || auth()->user()->can('reporte.create') || auth()->user()->can('reporte.edit') || auth()->user()->can('reporte.delete'))
                        <flux:navlist.item icon="chart-bar" :href="route('reportes.index')" :current="request()->routeIs('reportes.index')" wire:navigate>{{ __('reportes') }}</flux:navlist.item>
                    @endif

                </flux:navlist.group>
            </flux:navlist>

            <flux:spacer />

            <flux:navlist variant="outline">
                <flux:navlist.item icon="folder-git-2" href="https://github.com/laravel/livewire-starter-kit" target="_blank">
                {{ __('messages.Language') }}: {{ session()->get('locale', 'en') }}
                </flux:navlist.item>

                <flux:navlist.item icon="folder-git-2" href="https://github.com/laravel/livewire-starter-kit" target="_blank">
                {{ __('messages.Repository') }}
                </flux:navlist.item>

                <flux:navlist.item icon="book-open-text" href="https://laravel.com/docs/starter-kits" target="_blank">
                {{ __('messages.Documentation') }}
                </flux:navlist.item>
            </flux:navlist>

            <!-- Desktop User Menu -->
            <flux:dropdown position="bottom" align="start">
                <flux:profile
                    :name="auth()->user()->name"
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevrons-up-down"
                />

                <flux:menu class="w-[220px]">
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-left text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                    >
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>

                                <div class="grid flex-1 text-left text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item href="/settings/profile" icon="cog" wire:navigate>{{ __('messages.Settings') }}</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                            {{ __('messages.Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:sidebar>

        <!-- Mobile User Menu -->
        <flux:header class="lg:hidden">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

            <flux:spacer />

            <flux:dropdown position="top" align="end">
                <flux:profile
                    :initials="auth()->user()->initials()"
                    icon-trailing="chevron-down"
                />

                <flux:menu>
                    <flux:menu.radio.group>
                        <div class="p-0 text-sm font-normal">
                            <div class="flex items-center gap-2 px-1 py-1.5 text-left text-sm">
                                <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                    <span
                                        class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white"
                                    >
                                        {{ auth()->user()->initials() }}
                                    </span>
                                </span>

                                <div class="grid flex-1 text-left text-sm leading-tight">
                                    <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                    <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                                </div>
                            </div>
                        </div>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.radio.group>
                        <flux:menu.item href="/settings/profile" icon="cog" wire:navigate>Settings</flux:menu.item>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                            {{ __('messages.Log Out') }}
                        </flux:menu.item>
                    </form>
                </flux:menu>
            </flux:dropdown>
        </flux:header>

        {{ $slot }}

        @fluxScripts
    </body>
</html>
