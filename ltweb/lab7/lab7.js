/**
 * Created by bkand1909 on 4/10/14.
 */
function list_all_cars() {
    $.post("lab7.php",
        {
            type: "listing"
        },
        function (response) {
            var cars = JSON.parse(response);
            var html = '<table border="1">';
            html += '<tr><td>Id</td><td>Name</td><td>Year</td></tr>';
            for (var i = 0; i < cars.length; ++i) {
                var car = JSON.parse(cars[i]);
                html += '<tr><td>' + car.id + '</td><td>' + car.name + '</td><td>' + car.year + '</td></tr>';
            }
            html += '</table>';
            $("#result").html(html);
        }
    );
}

