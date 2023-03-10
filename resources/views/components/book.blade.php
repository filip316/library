<div
    class="flex gap-2 {{ $placement == 'show' ? 'mb-5 justify-center' : 'items-center border border-slate rounded-lg p-2 shadow-inner mt-3' }}">
    @if ($available === false)
        <p class="text-red-600 text-sm {{ $placement == 'show' ? '' : 'flex-auto pr-1' }}">Momentálně nedostupné</p>
    @elseif ($available === 'soon')
        <p class="text-amber-500 text-sm {{ $placement == 'show' ? '' : 'flex-auto pr-1' }}">Dostupné již brzy</p>
    @elseif ($available === 'booked')
        <p class="text-slate-500 text-sm {{ $placement == 'show' ? '' : 'flex-auto pr-1' }}">Tuto knihu již máte
            rezervovanou
        </p>
    @elseif ($available === 'over')
        <p class="text-slate-500 text-sm {{ $placement == 'show' ? '' : 'flex-auto pr-1' }}">Máte zarezervován maximální
            počet knih
        </p>
    @elseif($available === true)
        <p class="text-lime-600 text-sm {{ $placement == 'show' ? '' : 'flex-auto pr-1' }}">Dostupné právě teď</p>
    @else
        <p class="text-amber-500 text-sm {{ $placement == 'show' ? '' : 'flex-auto pr-1' }}">Dostupné přibližně od
            {{ date('d. m. Y', strtotime($available)) }}
        </p>
    @endif
    @if ($placement == 'index')
        <button
            class="px-3 py-2 shadow z-10 {{ $bookable ? 'bg-sky-100 hover:bg-sky-200' : 'bg-slate-100' }} transition rounded-lg"
            {{ $bookable ? '' : 'disabled' }} title="Rezervovat" onclick="openBook{{ $book->id }}()">
            <i class="fa-regular fa-bookmark"></i>
        </button>
    @endif
</div>

@if ($placement == 'show')
    <div class="flex justify-center mb-5">
        <button
            class="px-3 py-2 shadow {{ $bookable ? 'bg-sky-100 hover:bg-sky-200' : 'bg-slate-100' }} transition rounded-lg"
            {{ $bookable ? '' : 'disabled' }} onclick="openBook{{ $book->id }}()">Rezervovat</button>
    </div>
@endif

<div id="fullscreen-book-{{ $book->id }}" style="display: none"
    class="fixed top-0 left-0 w-full h-full px-3 backdrop-blur bg-yellow-400/70 z-50 grid grid-cols-1 place-content-center overflow-y-auto overscroll-contain">
    <div
        class="mx-auto w-full max-w-3xl xl:max-w-5xl max-h-[92vh] py-8 px-6 rounded-lg shadow-md bg-slate-50 grid xl:grid-cols-2 overflow-y-auto overscroll-contain">
        <div class="hidden xl:flex justify-center items-center mb-5 xl:mb-0">
            <div class="h-min">
                <div class="flex justify-center">
                    @if ($book->image !== null)
                        <img src="{{ asset('/img/' . $book->image) }}" alt="Obrázek přebalu" class="max-h-28 shadow">
                    @else
                        <img src="{{ asset('/img/book_cover.svg') }}" alt="Ukázkový obrázek přebalu"
                            class="max-h-28 drop-shadow">
                    @endif
                </div>
                <h3 class="text-lg mt-2 mx-5 text-center">{{ $book->title }}</h3>
                <p class="text-center">{{ $book->work->author->name }}</p>
            </div>
        </div>
        <div>
            <div class="mx-auto max-w-3xl grid grid-cols-1 place-content-center place-items-center gap-5">
                <h2 class="text-2xl font-bold text-center">Rezervace knihy</h2>
                @auth
                    <p class="text-center">Knihu si vyzvedněte do pěti dnů od rezervace. Do měsíce ji vraťte.</p>
                    <form class="grid grid-cols-2 gap-5 w-full" action="/rezervace" method="post">
                        @csrf
                        <input type="hidden" name="book_id" value="{{ old('book_id') ?? $book->id }}" autocomplete="off">
                        @lib
                            <div class="col-span-2">
                                <x-Select type="user" :target="[]" :values=$users identifier="{{ $book->id }}" />
                            </div>
                        @endlib
                        <div class="flex justify-start">
                            <input type="button"
                                class="px-3 py-2 bg-sky-100 hover:bg-sky-200 transition rounded-lg shadow cursor-pointer"
                                value="Zrušit" onclick="closeBook{{ $book->id }}()" />
                        </div>
                        <div class="flex justify-end">
                            <button
                                class="px-3 py-2 bg-yellow-400 hover:bg-amber-400 transition rounded-lg shadow">Rezervovat</button>
                        </div>
                    </form>
                @else
                    <p class="text-center">Pro možnost rezervace knihy si prosím zřiďte uživatelský účet.</p>
                    <div class="grid grid-cols-2 gap-5 w-full">
                        <div class="flex justify-start">
                            <button class="px-3 py-2 bg-sky-100 hover:bg-sky-200 transition rounded-lg shadow"
                                onclick="closeBook{{ $book->id }}()">Zrušit</button>
                        </div>
                        <div class="flex justify-end">
                            <a href="/registrace"
                                class="px-3 py-2 bg-yellow-400 hover:bg-amber-400 transition rounded-lg shadow">Registrovat</a>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</div>

<script>
    function openBook{{ $book->id }}() {
        $("#fullscreen-book-{{ $book->id }}").fadeIn("fast");
        @lib
        placeDropdown{{ $book->id }}();
        @endlib
    }

    function closeBook{{ $book->id }}() {
        $("#fullscreen-book-{{ $book->id }}").fadeOut("fast");
    }
</script>
