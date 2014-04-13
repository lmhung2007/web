/**
 * Created by bkand1909 on 4/10/14.
 */

var cars;
var row_edit;
var row_update = null;

function gen_edit_row() {
    var html = '<td class="col_edit"><input class="id" type="text" placeholder="Id"></td>'
        + '<td class="col_edit"><input class="name" type="text" placeholder="Name"></td>'
        + '<td><select class="year">';
    for (var i = 1990; i <= 2013; ++i) {
        html += '<option value="' + i + '">' + i + '</option>';
    }
    html += '</select>';
    return html;
}

function gen_row(id, name, year) {
    var html = '<tr id="car' + id + '" >';
    html += '<td class="id">' + id + '</td>';
    html += '<td class="name">' + name + '</td>';
    html += '<td class="year">' + year + '</td>';
    html += '<td><a class="btn-edit">Edit</a></td>';
    html += '<td><a class="btn-delete">Delete</a></td>';
    html += '</tr>';
    return html;
}

function display_result() {
    var html = "";
    for (i = 0; i < cars.length; ++i) {
        var car = cars[i];
        html += gen_row(car.id, car.name, car.year);
    }
    var body = $("#list").find("tbody");
    body.find("tr:not(.row-edit)").remove();
    body.find("tr:last").after(html);
    row_edit = body.find(".row-edit");
    $(row_edit).hide();

    $(".btn-delete").click(function () {
        delete_car(this.parentNode.parentNode);
    });
    $(".btn-edit").click(function () {
        edit_car(this.parentNode.parentNode);
    });
}

function list_all_cars() {
    $.post("lab7.php",
        {
            type: "listing"
        },
        function (response) {
            var result = JSON.parse(response);
            if (result.success) {
                cars = result.data;
                display_result();
            } else {
                alert(result.error);
            }
        }
    );
}

function get_index(car_id) {
    for (var i = cars.length - 1; i >= 0; --i) {
        if (cars[i].id === car_id) {
            return i;
        }
    }
    return -1;
}

function delete_car(row) {
    console.log(row);
    var car_id = $(row).find(".car_id").text();
    console.log(row.rowIndex);
    var ok = confirm("Delete this car?");
    if (ok === true) {
        $.post("lab7.php",
            {
                type: "delete",
                car_id: car_id
            },
            function (response) {
                var result = JSON.parse(response);
                if (result.success) {
                    var i = get_index(car_id);
                    if (car_id >= 0) {
                        cars.splice(i, 1);
                    }
                    row.remove();
                } else {
                    alert(result.error);
                }
            }
        );
    }
}

function edit_car(row) {
    if (row_update !== null) {
        $(row_update).show();
    }
    row_update = row;

    row_edit.find(".id").val($(row).find(".id").text());
    row_edit.find(".name").val($(row).find(".name").text());
    row_edit.find(".year").val($(row).find(".year").text());

    $(row).after(row_edit);
    $(row).hide();
    row_edit.show();
    row_edit.find("#id").focus();
    row_edit.find("#id").select();
}

function update_car(row) {
    var car_id = $(row).find(".id").val();
    var car_name = $(row).find(".name").val();
    var car_year = $(row).find(".year").val();
    var old_id = $(row_update).find(".id").text();

    $.post("lab7.php",
        {
            type: "update",
            old_id: old_id,
            car_id: car_id,
            car_name: car_name,
            car_year: car_year
        },
        function (response) {
            var result = JSON.parse(response);
            if (result.success) {
                var i = get_index(old_id);
                if (i >= 0) {
                    cars[i].id = car_id;
                    cars[i].name = car_name;
                    cars[i].year = car_year;
                    update_row(row_update, car_id, car_name, car_year);
                }
                cancel(row);
            } else {
                alert(result.error);
            }
        });
}

function update_row(row, car_id, car_name, car_year) {
    $(row).find(".id").text(car_id);
    $(row).find(".name").text(car_name);
    $(row).find(".year").text(car_year);
}

function cancel(row) {
    if (row_update != null) {
        row_edit.hide();
        $(row_update).show();
        row_update = null;
    }
}

function add_car(row) {
    var car_id = $(row).find(".id").val();
    var car_name = $(row).find(".name").val();
    var car_year = $(row).find(".year").val();

    $.post("lab7.php",
        {
            type: "insert",
            car_id: car_id,
            car_name: car_name,
            car_year: car_year
        },
        function (response) {
            var result = JSON.parse(response);
            if (result.success) {
                var i = cars.length;
                cars[i] = JSON.stringify({
                    id: car_id, name: car_name, year: car_year
                });
                var html = gen_row(car_id, car_name, car_year);
                $("#list").find("tbody tr:last").after(html);
            } else {
                alert(result.error);
            }
        });
}

function reset(row) {
    $(row).find(".id").val("");
    $(row).find(".name").val("");
    $(row).find(".year").val(1990);
}