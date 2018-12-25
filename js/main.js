$(document).ready(function(){
    var url = 'routing.php',
        ajaxRespond = function(action) {
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    action: action
                },
                processData: false,
                success: function (data) {
                    console.log(data);
                },
                error: function() {

                }
            });
        },
        pageWatcher = {
            start: function() {
                ajaxRespond('start');
            },
            checkTransportRoute: function() {
                ajaxRespond('check');
            },
            addNewTransportRoute: function() {
                ajaxRespond('add');
            }
        };

    pageWatcher.start();

    /*setTimeout(
        pageWatcher.checkTransportRoute(),
        5000
    );

    setTimeout(
        pageWatcher.addNewTransportRoute(),
        7000
    );*/
});