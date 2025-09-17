<div>
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('Edit Role') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('form for edit role') }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>  {{-- Because she competes with no one, no one can compete with her. --}}

    <div>
        <a href="{{ route("roles.index") }}" class="cursor-pointer px-3 py-2 text-xs font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Back
        </a>

        <div class="w-150">
            <form wire:submit="submit" class="mt-6 space-y-6">
                <flux:input wire:model="name" label="Name" placeholder="Name" />
                <flux:checkbox.group wire:model="permissions" label="Permissions">
                    @foreach ($allPermissions as $permission)
                        <flux:checkbox label="{{ $permission->name }}" value="{{ $permission->name }}" />
                    @endforeach
                </flux:checkbox.group>
                <flux:button type="submit" variant="primary">Submit</flux:button>
            </form>
        </div>
    </div>
</div>
