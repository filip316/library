function navbar() {
    /**
     * Changes navbar classes according to scroll position
     */
    var scroll = $(window).scrollTop();
    if (scroll === 0) {
        $("#navbar-backdrop")
            .addClass("bg-sky-100")
            .removeClass("bg-sky-100/80")
            .removeClass("shadow-lg");
    } else {
        $("#navbar-backdrop")
            .addClass("bg-sky-100/80")
            .removeClass("bg-sky-100")
            .addClass("shadow-lg");
    }
}

function workDetails() {
    /**
     * Toggles work details table
     */
    $("#work-details-table").slideToggle();
    $("#work-details-toggle").toggleClass("rotate-90");
}

function bookDetails() {
    /**
     * Toggles book details table
     */
    $("#book-details-table").slideToggle();
    $("#book-details-toggle").toggleClass("rotate-90");
}

function showResults() {
    /**
     * Shows live search results frame
     */
    $("#search-frame").addClass("shadow-lg").addClass("backdrop-blur-xl");
    $("#search-results").stop().slideDown("fast");
}

function hideResults() {
    /**
     * Hides live search results frame, hides search bar on smaller screens
     */
    $("#search-results").slideUp("fast", function () {
        $("#search-frame")
            .removeClass("shadow-lg")
            .removeClass("backdrop-blur-xl")
            .removeClass("-top-2");
    });
}

function showSearchBar() {
    /**
     * Shows search results
     */
    $("#search-frame").addClass("-top-2");
    $("#search-input").focus();
}

function search() {
    /**
     * Fetches quick search results and displays them below search field
     */

    // Check that the search query is longer than 3 chars
    if ($("#search-input").val().trim().length < 3) {
        $("#search-results")
            .empty()
            .append(
                '<div class="grid place-content-center h-full w-full"><span>Pro vyhledávání začněte psát</span></div>'
            );
        return;
    }

    // Get quick results as JSON from API
    $.getJSON(
        "/api/search?query=" + $("#search-input").val(),
        function (result) {
            // Refresh results displayed below search field
            $("#search-results").empty();
            if (result["author"].length !== 0) {
                // Show results from authors table
                $("#search-results").append(
                    '<p class="p-2 font-bold text-slate-500">Autoři:</p>'
                );

                $.each(result["author"], function (i, field) {
                    $("#search-results").append(
                        '<a href="/autor/' +
                            field["id"] +
                            '"><p class="p-2 rounded-md hover:bg-yellow-200/80 transition">' +
                            field["name"] +
                            "</p></a>"
                    );
                });

                $("#search-results").append(
                    '<p class="p-2 text-right text-slate-500"><a href="javascript:void(0)" onclick="go(event)">Zobrazit vše <i class="fa-solid fa-arrow-right"></i></a></p>'
                );
            }

            if (result["work"].length !== 0) {
                // Show results from works table
                $("#search-results").append(
                    '<p class="p-2 font-bold text-slate-500">Díla:</p>'
                );

                $.each(result["work"], function (i, field) {
                    $("#search-results").append(
                        '<a href="/knihovna/' +
                            field["id"] +
                            '"><p class="p-2 rounded-md hover:bg-yellow-200/80 transition">' +
                            field["title"] +
                            "</p></a>"
                    );
                });

                $("#search-results").append(
                    '<p class="p-2 text-right text-slate-500"><a href="javascript:void(0)" onclick="go(event)">Zobrazit vše <i class="fa-solid fa-arrow-right"></i></a></p>'
                );
            }

            if (result["book"].length !== 0) {
                // Show results from books table
                $("#search-results").append(
                    '<p class="p-2 font-bold text-slate-500">Knihy:</p>'
                );

                $.each(result["book"], function (i, field) {
                    $("#search-results").append(
                        '<a href="/kniha/' +
                            field["id"] +
                            '"><p class="p-2 rounded-md hover:bg-yellow-200/80 transition">' +
                            field["title"] +
                            "</p></a>"
                    );
                });

                $("#search-results").append(
                    '<p class="p-2 text-right text-slate-500"><a href="javascript:void(0)" onclick="go(event)">Zobrazit vše <i class="fa-solid fa-arrow-right"></i></a></p>'
                );
            }

            // If nothing matches the query
            if ($("#search-results").html() == "") {
                $("#search-results").append(
                    '<div class="grid place-content-center h-full w-full"><span>Vašemu hledání neodpovídá žádný výsledek</span></div>'
                );
            }

            // If the query was erased in the meantime
            if ($("#search-input").val().trim().length < 3) {
                search();
            }
        }
    );
}

function go(e) {
    /**
     * Go to dedicated search page
     *
     * @param {Event} e Event to be cancelled
     */
    e.preventDefault();
    // TODO: Submit the search form
}

$(document)
    .ready(function () {
        navbar();

        $("#search-input").bind("keydown", "esc", function () {
            $("#search-input").blur();
            return false;
        });
    })
    .bind("keydown", "ctrl+k", function () {
        showSearchBar();
        return false;
    });

$(window).scroll(function () {
    navbar();
});