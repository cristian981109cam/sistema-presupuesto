<?php

use Livewire\Volt\Component;

new class extends Component {
    public $language = "en";

    public function mount()
    {
        $this->language = session()->get('locale', 'en');
    }
    
    public function submit()
    {
        session()->put('locale', $this->language);

        return redirect()->route("settings.language")->with('success', 'Language updated.');
    }
}; ?>

<div class="flex flex-col items-start">
    @include('partials.settings-heading')

    <x-settings.layout heading="{{ __('messages.Language') }}" subheading="{{ __('messages.Update the appearance settings for your account') }}">

        @session('success')
            <p class="text-sm text-green-600">{{ $value }}</p>
        @endsession

        <flux:radio.group wire:model="language" label="Select your language">
            <flux:radio value="en" label="English" checked />
            <flux:radio value="es" label="Spanish" />
        </flux:radio.group>

        <flux:button class="mt-3" wire:click="submit" variant="primary">Save</flux:button>
    </x-settings.layout>
</div>
