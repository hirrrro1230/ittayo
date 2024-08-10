<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Ittayo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <form method="POST" action="{{ route('spot') }}">
            @csrf

            <!-- スポット名 -->
            <div>
                <x-input-label for="spot_name" :value="__('スポット名')" />
                <x-text-input id="spot_name" class="block mt-1 w-full" type="text" name="spot_name" :value="old('spot_name')" required autofocus autocomplete="spot_name" />
                <x-input-error :messages="$errors->get('spot_name')" class="mt-2" />
            </div>

            <!-- 郵便番号 -->
            <div class="mt-4">
                <x-input-label for="zip_code" :value="__('郵便番号')" />
                <x-text-input id="zip_code" class="block mt-1 w-full" type="zip_code" name="zip_code" :value="old('zip_code')" autocomplete="zip_code" />
                <x-input-error :messages="$errors->get('zip_code')" class="mt-2" />
            </div>

            <!-- 住所 -->
            <div class="mt-4">
                <x-input-label for="address" :value="__('住所')" />

                <x-text-input id="address" class="block mt-1 w-full"
                                type="text"
                                name="address"
                                required autocomplete="address" />

                <x-input-error :messages="$errors->get('address')" class="mt-2" />
            </div>

            <!-- メモ -->
            <div class="mt-4">
                <x-input-label for="memo" :value="__('メモ')" />

                <x-text-input id="memo" class="block mt-1 w-full"
                                type="textarea"
                                name="memo" required autocomplete="new-memo" />

                <x-input-error :messages="$errors->get('memo')" class="mt-2" />
            </div>
            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="ms-4">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-app-layout>
