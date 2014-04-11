/**
 * Created by bkand1909 on 4/10/14.
 */

var cars;
var prev_car_id = "";
var row_edit;

function display_result() {
    var html = '<table border="0">';
    html += '<thead><tr><td>Id</td><td>Name</td><td>Year</td>';
    html += '<td>Modify</td><td>Delete</td>';
    html += '</tr></thead><tbody>';
    html += '<tr id="row_edit"><td class="col_edit"><input type="text" placeholder="Id"></td>';
    html += '<td class="col_edit cname"><input type="text" placeholder="Name"></td></tr>';
    for (var i = 0; i < cars.length; ++i) {
        var car = cars[i];
        html += '<tr id="car' + car.id + '" ><td class="car_id">' + car.id + '</td>';
        html += '<td class="cname">' + car.name + '</td><td>' + car.year + '</td>';
        html += '<td><a onclick="edit_car(\'' + car.id + '\')";>Edit</a></td>';
        html += '<td><a onclick="delete_car(\'' + car.id + '\');">Delete</a></td>';
        html += '</tr>';
    }
    html += '</tbody>';
    html += '</table>';
    $("#list").html(html);
    row_edit = $("#row_edit");
    row_edit.hide();
}

function list_all_cars() {
    $.post("lab7.php",
        {
            type: "listing"
        },
        function (response) {
            cars = JSON.parse(response);
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
                for (var i = cars.length - 1; i >= 0; --i) {
                    if (cars[i].id === car_id) {
                        cars.splice(i, 1);
                        $("#car" + car_id).remove();
                    }
                }
            }
        );
    }
}

function edit_car(car_id) {
    var row = $("#list > table > tbody > tr#car" + car_id);
    if (prev_car_id != "") {
        $("#list > table > tbody > tr#car" + prev_car_id).show();
    }
    prev_car_id = car_id;
    row.after(row_edit);
    row.hide();
    row_edit.show();
}