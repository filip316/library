<x-layout>
    <h1 class="text-4xl text-center font-bold mb-5">Přidat knihu</h1>
    <div class="flex justify-center">
        <form method="POST" action="/kniha" class="w-full px-2 max-w-2xl 2xl:max-w-3xl">
            @csrf
            <div class="mb-3">
                <label for="create-book-title"
                    class="block mb-1 after:content-['*'] after:ml-0.5 after:text-red-500">Název knihy</label>
                <input type="text" class="p-2 w-full border border-slate-200 rounded-lg" name="title"
                    id="create-book-title" placeholder="Bible" value="{{ old('title') }}" autocomplete="off">
                @error('title')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="create-book-subtitle" class="block mb-1">Podnázev</label>
                <input type="text" class="p-2 w-full border border-slate-200 rounded-lg" name="subtitle"
                    id="create-book-subtitle" placeholder="Písmo svaté Starého a Nového zákona"
                    value="{{ old('subtitle') }}" autocomplete="off">
                @error('subtitle')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <x-Select type="work" :values=$works></x-Select>
                @error('work_id')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="create-book-description" class="block mb-1">Popis</label>
                <textarea name="description" class="p-2 w-full border border-slate-200 rounded-lg" id="create-book-description"
                    cols="30" rows="10" autocomplete="off">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>
            <div class="grid sm:grid-cols-2 sm:gap-x-4">
                <div class="mb-3">
                    <label for="create-work-language"
                        class="block mb-1 after:content-['*'] after:ml-0.5 after:text-red-500">Jazyk</label>
                    <input type="text" class="p-2 w-full border border-slate-200 rounded-lg" name="language"
                        id="create-work-language" placeholder="Čeština (Český ekumenický překlad)" value="{{ old('language') }}"
                        autocomplete="off">
                    @error('language')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="create-book-translator" class="block mb-1">Překladatel</label>
                    <input type="text" class="p-2 w-full border border-slate-200 rounded-lg" name="translator"
                        id="create-book-translator" placeholder="" value="{{ old('translator') }}" autocomplete="off">
                    @error('translator')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="create-book-illustrator" class="block mb-1">Ilustrátor</label>
                    <input type="text" class="p-2 w-full border border-slate-200 rounded-lg" name="illustrator"
                        id="create-book-illustrator" placeholder="" value="{{ old('illustrator') }}"
                        autocomplete="off">
                    @error('illustrator')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="create-book-length"
                        class="block mb-1 after:content-['*'] after:ml-0.5 after:text-red-500">Počet stran</label>
                    <input type="number" class="p-2 w-full border border-slate-200 rounded-lg" name="length"
                        id="create-book-length" placeholder="1387" min="1" value="{{ old('length') }}"
                        autocomplete="off">
                    @error('length')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="create-book-house"
                        class="block mb-1 after:content-['*'] after:ml-0.5 after:text-red-500">Nakladatelství</label>
                    <input type="text" class="p-2 w-full border border-slate-200 rounded-lg" name="house"
                        id="create-book-house" placeholder="Česká biblická společnost" value="{{ old('house') }}" autocomplete="off">
                    @error('house')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="create-book-year"
                        class="block mb-1 after:content-['*'] after:ml-0.5 after:text-red-500">Rok vydání</label>
                    <input type="text" class="p-2 w-full border border-slate-200 rounded-lg" name="year"
                        id="create-book-year" placeholder="2016" value="{{ old('year') }}" autocomplete="off">
                    @error('year')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="create-book-place" class="block mb-1">Místo vydání</label>
                    <input type="text" class="p-2 w-full border border-slate-200 rounded-lg" name="place"
                        id="create-book-place" placeholder="Praha" value="{{ old('place') }}" autocomplete="off">
                    @error('place')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="create-book-publication" class="block mb-1">Číslo publikace</label>
                    <input type="number" class="p-2 w-full border border-slate-200 rounded-lg" name="publication"
                        id="create-book-publication" placeholder="22" min="1" value="{{ old('publication') }}"
                        autocomplete="off">
                    @error('publication')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="create-book-ISBN" class="block mb-1">ISBN</label>
                    <input type="text" class="p-2 w-full border border-slate-200 rounded-lg" name="ISBN"
                        id="create-book-ISBN" placeholder="978-80-7545-028-9" value="{{ old('ISBN') }}" autocomplete="off">
                    @error('ISBN')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="create-book-amount"
                        class="block mb-1 after:content-['*'] after:ml-0.5 after:text-red-500">Počet knih</label>
                    <input type="number" class="p-2 w-full border border-slate-200 rounded-lg" name="amount"
                        id="create-book-amount" placeholder="1" min="1"
                        value="{{ old('amount') == '' ? '1' : old('amount') }}" autocomplete="off">
                    @error('amount')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="flex justify-center">
                <div class="mb-3">
                    <input type="submit"
                        class="px-3 py-2 border border-slate-200 bg-yellow-400 hover:bg-amber-400 shadow-sm rounded-lg transition"
                        value="Vytvořit">
                </div>
            </div>
        </form>
    </div>
</x-layout>