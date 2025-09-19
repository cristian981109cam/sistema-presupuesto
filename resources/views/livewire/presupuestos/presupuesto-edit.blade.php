<div>
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('Editar Presupuesto') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Formulario para editar presupuesto') }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>  {{-- Because she competes with no one, no one can compete with her. --}}

    <div>
        <a href="{{ route("presupuestos.index") }}" class="cursor-pointer px-3 py-2 text-xs font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Back
        </a>

        <div class="w-150">
            <form wire:submit="submit" class="mt-6 space-y-6">
                <flux:select wire:model="id_categoria">
                    <flux:select.option value="">Seleccione Categoria</flux:select.option>
                    @foreach ($allCategorias as $categoria)
                        <flux:select.option value="{{ $categoria->id }}">{{ $categoria->nombre }}</flux:select.option>
                    @endforeach
                </flux:select>
                <flux:select wire:model="id_mes">
                    <flux:select.option value="">Seleccione Mes</flux:select.option>
                    @foreach ($allMeses as $mes)
                        <flux:select.option value="{{ $mes->id }}">{{ $mes->nombre }}</flux:select.option>
                    @endforeach
                </flux:select>
                <flux:input wire:model.live="montoFormat" label="Monto" placeholder="Monto" />
                <flux:button type="submit" variant="primary">Submit</flux:button>
            </form>
        </div>
    </div>
</div>
