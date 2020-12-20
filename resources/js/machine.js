$(document).ready(function () {
    console.log(1);
    var pusher = new Pusher('f0018eeb73f4d3558c43', {
        cluster: 'ap2'
    });
    var channel = pusher.subscribe('switch-pressed');
    channel.bind('App\\Events\\SwitchPressed', function(data) {
        console.log(data);
        var button = data.switch;
        var floor = data.floor;
        var status = data.status;
        var block = $('#'+button+'-'+floor);
        if(status == 1){
            block.removeClass('btn-danger');
            block.addClass('btn-success');
        }else if(status == 0){
            block.removeClass('btn-danger');
            block.addClass('btn-danger');
            $('html, body').animate({
                scrollTop: (block.offset().top)
            },1500);
            var message = 'In Floor '+floor+' machine '+button+' shows Problem';
            toastr.error(message);
            toastr.options = {
                'closeButton': true,
                'debug': false,
                'newestOnTop': false,
                'progressBar': false,
                'positionClass': 'toast-top-right',
                'preventDuplicates': false,
                'onclick': null,
                'showDuration': '300',
                'hideDuration': '1000',
                'timeOut': 0,
                'extendedTimeOut': 0,
                'showEasing': 'swing',
                'hideEasing': 'linear',
                'showMethod': 'fadeIn',
                'hideMethod': 'fadeOut'
            }
        }

    });
});
