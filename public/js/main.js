$('.panggil').on('click', function(){
    $('.panggil').prop('disabled', true);
});
var counter_id = document.getElementById('counter_id').value;
// console.log(counter_id);
document.addEventListener("DOMContentLoaded", function() {
    Echo.channel('button-state-channel')
        .listen('ButtonStateEvent', (e) => {
            if(e['data'] == counter_id){
                $('.panggil').prop('disabled', false);
            }
            console.log(e['data']);
        });
});



