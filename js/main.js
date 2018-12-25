$(document).ready(function(){
    var url = 'routing.php',
        ajaxRespond = function(action, data = {}) {
        console.log(data);
            data.action = action;
            console.log(data);

            $.ajax({
                url: url,
                type: 'POST',
                data: data,
                dataType: 'json',
                success: function (data) {
                    console.log('start success');

                    if (data.length > 0) {
                        $(data).each(function(index, item){
                            $('table tbody').prepend('<tr data-id="' + item.id + '"><td>' + item.name + '</td><td>' + item.number + '</td><td>' + item.route + '</td><td>' + item.hand_made + '</td></tr>');
                        });
                    } else {
                        console.log('not elements');
                    }
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
                var data = {
                        number: $('tbody tr').first().data("id")
                    };

                ajaxRespond('check', data);
            },
            addNewTransportRoute: function() {
                ajaxRespond('add');
            },
            handAddNewTrasportRoute: function(data) {
                data.action = 'hand_add';

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: data,
                    dataType: 'json',
                    success: function (data) {
                        console.log('hand add success');
                        if ($(data).find('name')) {
                            $('#success').modal('show');
                        } else {
                            console.log('not elements');
                            $('#error').modal('show');
                        }
                        console.log(data);
                    },
                    error: function() {
                        console.log('err');
                    }
                });
            }
        };

    if (window.location.pathname !== "/form.html") {
        pageWatcher.start();

        setInterval(
            function(){
                pageWatcher.checkTransportRoute()
            },
            5000
        );

        setInterval(
            function(){
                pageWatcher.addNewTransportRoute()
            },
            7000
        );
    } else {
        $('form').on('submit', function(e){
            e.preventDefault();
            var validate = true,
                formInput = $(this).find('input'),
                params = {};

            formInput.each(function (index, item){
                $(item).removeClass('alert-danger');

                if (item.value === '') {
                    $(item).addClass('alert-danger');
                    validate = false;
                } else {
                    params[item.id] = item.value;
                }
            });

            if (validate) {
                pageWatcher.handAddNewTrasportRoute(params);
            }
        })
    }
});