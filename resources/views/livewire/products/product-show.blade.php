<div>
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">{{ __('Show Product') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('this page is for show Product') }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>  {{-- Because she competes with no one, no one can compete with her. --}}

    <div>
        <a href="{{ route("products.index") }}" class="cursor-pointer px-3 py-2 text-xs font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Back
        </a>

        <div class="w-150">
            <p class="mt-2">
                <strong>Name: </strong> {{ $product->name }}
            </p>
            <p class="mt-2">
                <strong>Detail: </strong> {{ $product->detail }}
            </p>
        </div>
    </div>
</div>
