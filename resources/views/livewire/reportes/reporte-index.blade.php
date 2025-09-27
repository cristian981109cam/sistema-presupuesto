<div>
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('Reportes') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Gestiona todas tus reportes') }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div> {{-- Because she competes with no one, no one can compete with her. --}}

    <div>

        @session('success')
            <div class="flex items-center p-2 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-green-900 dark:text-green-300 dark:border-green-800"
                role="alert">
                <svg class="flex-shrink-0 w-8 h-8 mr-1 text-green-700 dark:text-green-300" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4" />
                </svg>
                <span class="font-medium">{{ $value }}</span>
            </div>
        @endsession

        @can('reporte.create')
            <a href="{{ route('reportes.create') }}"
                class="cursor-pointer px-3 py-2 text-xs font-medium text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                Crear Excel
            </a>
        @endcan

        <div class="overflow-x-auto mt-4">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        {{-- <th scope="col" class="px-6 py-3">ID</th> --}}
                        <th scope="col" class="px-6 py-3">Categoria</th>
                        <th scope="col" class="px-6 py-3">Mes</th>
                        <th scope="col" class="px-6 py-3">Monto</th>
                        <th scope="col" class="px-6 py-3">Ingresos</th>
                        <th scope="col" class="px-6 py-3">Gastos</th>
                        <th scope="col" class="px-6 py-3">Disponible</th>
                        <th scope="col" class="px-6 py-3">Aviso</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reportes as $reporte)
                        <tr
                            class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700 border-gray-200">
                            
                            <td class="px-6 py-2">{{ $reporte->categoria }}</td>
                            <td class="px-6 py-2">{{ $reporte->mes }}</td>
                            <td class="px-6 py-2">{{ number_format($reporte->monto_asignado, 2) }}</td>
                            <td class="px-6 py-2">{{ $reporte->total_ingresos > 0 ? number_format($reporte->total_ingresos, 2) : '—' }}</td>
                            <td class="px-6 py-2">{{ $reporte->total_gastos > 0 ? number_format($reporte->total_gastos, 2) : '—' }}</td>
                            <td class="px-6 py-2">{{ number_format($reporte->saldo_final, 2) }}</td>
                            <td class="px-6 py-2">
                                <span class="{{ $reporte->saldo_final > 0 ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $reporte->saldo_final > 0 ? '✅ Hay dinero disponible' : '❌ No hay dinero disponible' }}
                                </span>
                            </td>

                            {{-- <td class="px-6 py-2">
                                <div class="flex flex-wrap gap-2">
                                    @can('reporte.view')
                                        <a href="{{ route('reportes.show', $reporte->id) }}"
                                            class="cursor-pointer px-3 py-2 text-xs font-medium text-white bg-gray-700 rounded-lg hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                                            Show
                                        </a>
                                    @endcan
                                    @can('reporte.edit')
                                        <a href="{{ route('reportes.edit', $reporte->id) }}"
                                            class="cursor-pointer px-3 py-2 text-xs font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                            Edit
                                        </a>
                                    @endcan
                                    @can('reporte.delete')
                                        <button wire:click="delete({{ $reportes->id }})" wire:confirm="¿Estás seguro que deseas eliminar este reporte?"
                                            class="cursor-pointer px-3 py-2 text-xs font-medium text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                            Delete
                                        </button>
                                    @endcan
                                </div>
                            </td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
