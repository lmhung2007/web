/**
 * Created by bkand1909 on 4/10/14.
 */

var cars;

function display_result() {
    var html = '<table border="1">';
    html += '<thead><tr><td>Id</td><td>Name</td><td>Year</td>';
    html += '<td>Modify</td><td>Delete</td>';
    html += '</tr></thead><tbody>';
    for (var i = 0; i < cars.length; ++i) {
        var car = cars[i];
        html += '<tr id="car' + car.id + '"><td>' + car.id + '</td><td class="cname">' + car.name + '</td><td>' + car.year + '</td>';
        html += '<td><button>Edit</button></td>';
        html += '<td><button onclick="delete_car(' + car.id + ');">Delete</button></td>';
        html += '</tr>';
    }
    html += '</tbody>';
    html += '</table>';
    $("#list").html(html);
}

function list_all_cars() {
    $.post("lab7.php",
        {
            type: "listing"
        },
        function (response) {
            var items = JSON.parse(response);
            cars = Array();
            for (var i = 0; i < items.length; ++i) {
                cars[i] = JSON.parse(items[i]);
            }
            display_result();
        }
    );
}

function delete_car(car_id) {
    var r = confirm("Delete this car?");
    if (r === true) {
        $.post("lab7.php",
            {
                type: "delete",
                car_id: car_id
            },
            function (response) {
                for (var i = 0; i < cars.length; ++i) {
                    if (cars[i].id === car_id.toString()) {
                        cars.splice(i, 1);
                        $("#car" + car_id).remove();
                        break;
                    }
                }
            }
        );
    }
}