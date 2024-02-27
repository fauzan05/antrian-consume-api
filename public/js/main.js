var counter_id = document.getElementById('counter_id').value;
// console.log(counter_id);
$('.panggil').on('click', function () {
        $('.panggil').prop('disabled', true);
});
// console.log(counter_id);
document.addEventListener("DOMContentLoaded", function () {
    Echo.channel('button-state-channel')
        .listen('ButtonStateEvent', (e) => {
            // console.log(e['data']);
            if (e['data'] == counter_id) {
                $('.panggil').prop('disabled', false);
                // console.log("Button Disabled : " + counter_id);
                Livewire.dispatch('buttonState');
            }
        });
});
    // $(document).ready(function () {
    //     const parent = $('.index-page', '.pagination').length;
    //     let currentPage = 1;
    //     let nextButton = $('#next');
    //     let previousButton = $('#previous');
    //     console.log(currentPage);
    //     // console.log("parent : " + parent);
    //     $('.index-page').eq(currentPage - 1).addClass('active');
    //     previousButton.addClass('disabled');

    //     $('.index-page').on('click', function () {
    //         window.Livewire.dispatch('page', { pageId: currentPage });
    //         currentPage = $(this).index();
    //         console.log("current click : " + currentPage);
    //         $('.index-page').removeClass('active');
    //         $(this).addClass('active');
    //         if (currentPage == parent) {
    //             nextButton.removeClass('disabled');
    //             previousButton.removeClass('disabled');
    //             nextButton.addClass('disabled');
    //             Livewire.dispatch('page', { pageId: currentPage });
    //         }
    //         if (currentPage == 1) {
    //             nextButton.removeClass('disabled');
    //             previousButton.removeClass('disabled');
    //             previousButton.addClass('disabled');
    //             Livewire.dispatch('page', { pageId: currentPage });
    //         } else {
    //             nextButton.removeClass('disabled');
    //             previousButton.removeClass('disabled');
    //             Livewire.dispatch('page', { pageId: currentPage });
    //         }
    //     });
    //     $('#previous').on('click', function () {
    //         if (currentPage <= parent && currentPage != 1) {
    //             previousButton.removeClass('disabled');
    //             nextButton.removeClass('disabled');
    //             currentPage--;
    //             $('.index-page').removeClass('active');
    //             $('.index-page').eq(currentPage - 1).addClass('active');
    //             // Livewire.dispatch('page', { pageId: currentPage });
    //             console.log(currentPage);
    //         }
    //         if (currentPage == 1) {
    //             previousButton.removeClass('disabled');
    //             nextButton.removeClass('disabled');
    //             previousButton.addClass('disabled');
    //             $('.index-page').removeClass('active');
    //             $('.index-page').eq(currentPage - 1).addClass('active');
    //             currentPage = 1;
    //             // Livewire.dispatch('page', { pageId: currentPage });
    //             console.log(currentPage);
    //         }
    //     });
    //     $('#next').on('click', function () {
    //         if (currentPage < parent) {
    //             previousButton.removeClass('disabled');
    //             nextButton.removeClass('disabled');
    //             currentPage++;
    //             $('.index-page').removeClass('active');
    //             $('.index-page').eq(currentPage - 1).addClass('active');
    //             // Livewire.dispatch('page', { pageId: currentPage });
    //             console.log(currentPage);
    //         }
    //         if (currentPage == parent) {
    //             nextButton.removeClass('disabled');
    //             nextButton.addClass('disabled').click(false);
    //             $('.index-page').removeClass('active');
    //             $('.index-page').eq(currentPage - 1).addClass('active');
    //             currentPage = parent;
    //             // Livewire.dispatch('page', { pageId: currentPage });
    //             console.log(currentPage);
    //         }
    //     });
    // });

