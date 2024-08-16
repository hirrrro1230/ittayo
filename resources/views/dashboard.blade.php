<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Ittayo') }}
        </h2>
    </x-slot>

    <div x-data="{ open: false, editOpen: false, editData: {} }" class="py-12">
        <!-- ハンバーガーメニューアイコン -->
            <button @click="open = !open" class="inline-flex h-12 items-center justify-center rounded-md bg-neutral-950 px-6 font-medium text-neutral-50 shadow-lg shadow-neutral-500/20 transition active:scale-95">
                スポットを追加
            </button>
        <!-- フォーム -->
        <div x-show="open" class="mt-4">
            <form method="POST" action="{{ route('spot') }}" class="w-80 bg-white shadow rounded">
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
                    <x-text-input id="zip_code" class="block mt-1 w-full" type="text" name="zip_code" :value="old('zip_code')" autofocus autocomplete="zip_code" />
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
                    <textarea id="memo" 
                        class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" 
                        name="memo" 
                        rows="4" 
                        autofocus 
                        autocomplete="memo"></textarea>
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
        <div x-show="editOpen" class="mt-4">
            <form method="POST" :action="`/spot/${editData.id}`" class="w-80 bg-white shadow rounded">
                @csrf
                @method('PUT')
                <!-- スポット名 -->
                <div>
                    <x-input-label for="edit_spot_name" :value="__('スポット名')" />
                    <x-text-input id="edit_spot_name" class="block mt-1 w-full" type="text" name="spot_name" x-model="editData.spot_name" required autofocus autocomplete="spot_name" />
                    <x-input-error :messages="$errors->get('spot_name')" class="mt-2" />
                </div>

                <!-- 郵便番号 -->
                <div class="mt-4">
                    <x-input-label for="edit_zip_code" :value="__('郵便番号')" />
                    <x-text-input id="edit_zip_code" class="block mt-1 w-full" type="text" name="zip_code" x-model="editData.zip_code" autofocus autocomplete="zip_code" />
                    <x-input-error :messages="$errors->get('zip_code')" class="mt-2" />
                </div>

                <!-- 住所 -->
                <div class="mt-4">
                    <x-input-label for="edit_address" :value="__('住所')" />
                    <x-text-input id="edit_address" class="block mt-1 w-full" type="text" name="address" x-model="editData.address" required autocomplete="address" />
                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                </div>

                <!-- メモ -->
                <div class="mt-4">
                    <x-input-label for="edit_memo" :value="__('メモ')" />
                    <textarea id="edit_memo" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500" name="memo" rows="4" x-model="editData.memo" autofocus autocomplete="memo"></textarea>
                    <x-input-error :messages="$errors->get('memo')" class="mt-2" />
                </div>
                
                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="ms-4">
                        {{ __('Update') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
        <div class="p-4 bg-gray-100 rounded-lg">
            @if($spots->isEmpty())
                <p class="text-center text-gray-600">まだスポット登録がありません</p>
            @else
                <ul class="space-y-4">
                    @foreach($spots as $spot)
                        <li class="bg-white p-4 rounded-lg shadow-md">
                            <h3 class="text-lg font-semibold text-gray-800">{{ $spot->spot_name }}</h3>
                            <p class="text-gray-600 mt-1"> {{ $spot->zip_code }}</p>
                            <p class="text-gray-600 mt-1"> {{ $spot->address }}</p>
                            <p class="text-gray-600 mt-1"> {{ $spot->memo }}</p>
                            <p class="text-gray-500 mt-1 text-sm">{{ $spot->created_at->format('Y/m/d H:i') }}</p>
                            <button @click="
                                if (editData.id === '{{ $spot->id }}') {
                                    editOpen = !editOpen
                                } else {
                                    editOpen = true;
                                    editData = { id: '{{ $spot->id }}', spot_name: '{{ $spot->spot_name }}', zip_code: '{{ $spot->zip_code }}', address: '{{ $spot->address }}', memo: '{{ $spot->memo }}' }
                                }
                            " class="mt-2 inline-flex h-10 items-center justify-center rounded-md bg-blue-500 px-4 font-medium text-white shadow-lg shadow-blue-500/20 transition active:scale-95">
                                編集
                            </button>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</x-app-layout>
