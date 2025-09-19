<div>
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('Mostrar Categoria') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Esta página es para mostrar Categoria.') }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>  {{-- Because she competes with no one, no one can compete with her. --}}

    <div>
        <a href="{{ route("categorias.index") }}" class="cursor-pointer px-3 py-2 text-xs font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Back
        </a>

        <div class="w-150">
            <p class="mt-2">
                <strong>Nombre: </strong> {{ $categoria->nombre }}
            </p>
            <p class="mt-2">
                <strong>Descripcion: </strong> {{ $categoria->descripcion }}
            </p>
        </div>
    </div>
</div>
