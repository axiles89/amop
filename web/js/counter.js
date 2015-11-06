/**
 * Created by Дима on 06.11.2015.
 */


/**
 * Counter for menu
 */
var counter = function() {
    $.post(
        '/ajax/counter/count',
        function(data) {
            if (data.status == 200) {

                if (data.result.profiler.total != false) {
                    $(".total_profiler > a").append('<span class="label label-primary pull-right">' + data.result.profiler.total + '</span>');
                }

                for (value in data.result.profiler.item) {
                    var item = data.result.profiler.item[value];
                    $(".profiler_"+value+" > a").append('<span class="label pull-right bg-red">' + item + '</span>');
                }
            } else {
                alert("Произошла ошибка получения данных!");
            }
        }
    );
};

jQuery(document).ready(function(){
    counter();
})