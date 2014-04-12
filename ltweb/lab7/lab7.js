/**
 * Created by bkand1909 on 4/10/14.
 */

var cars;
var prev_row = null;
var row_edit;

function display_result() {
    var html = '<table border="0">';
    html += '<thead><tr><td>Id</td><td>Name</td><td>Year</td>';
    html += '<td>Modify</td><td>Delete</td>';
    html += '</tr></thead><tbody>';
    html += '</tr><tr class="row_edit" style="display: none;"><td></td></tr>';
    html += '<tr class="row_edit"><td class="col_edit"><input id="id" type="text" placeholder="Id"></td>';
    html += '<td class="col_edit"><input id="name" type="text" placeholder="Name"></td>';
    html += '<td><select id="year">';
    for (var i = 1990; i <= 2013; ++i) {
        html += '<option value="' + i + '">' + i + '</option>';
    }
    html += '</select></td><td><button>Update</button></td>';
    html += '<td><button>Cancel</button></td>';
    html += '</tr>';
    for (i = 0; i < cars.length; ++i) {
        var car = cars[i];
        html += '<tr id="car' + car.id + '" ><td class="car_id">' + car.id + '</td>';
        html += '<td class="car_name">' + car.name + '</td><td class="car_year">' + car.year + '</td>';
        html += '<td><a onclick="edit_car(this.parentNode.parentNode)";>Edit</a></td>';
        html += '<td><a onclick="delete_car(this.parentNode.parentNode);">Delete</a></td>';
        html += '</tr>';
    }
    html += '</tbody>';
    html += '</table>';
    $("#list").html(html);
    row_edit = $(".row_edit");
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

function delete_car(row) {
    var car_id = $(row).find(".car_id").text();
    console.log(row.rowIndex);
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
                    }
                }
                row.remove();
            }
        );
    }
}

function edit_car(row) {
    if (prev_row !== null) {
        $(prev_row).show();
    }
    prev_row = row;
    row_edit.find("#id").val($(row).find(".car_id").text());
    row_edit.find("#name").val($(row).find(".car_name").text());
    console.log($(row).find(".car_year").text());
    row_edit.find("#year").val($(row).find(".car_year").text());
    $(row).after(row_edit);
    $(row).hide();
    row_edit.show();
    row_edit.find("#id").focus();
    row_edit.find("#id").select();
}