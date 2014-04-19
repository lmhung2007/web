/**
 * Created by hungle.info on 4/20/14.
 */

var RESULT = "result", TABLE = "table", TABLE_ID = "mytable", ROW = "tr", TD = "td";

function add_table() {
    var result = document.getElementById(RESULT);
    var table = document.getElementById(TABLE_ID);
    if (table == null || get_n_row(table) == 0) {
        append_table(result, TABLE_ID, 2, 2);
    }
}

function delete_table() {
    var table = document.getElementById(TABLE_ID);
    if (table != null) {
        table.parentNode.removeChild(table);
    }
}

function get_n_row(table) {
    return table.childElementCount;
}

function get_n_column(table) {
    if (table.childElementCount == 0) {
        return 0;
    }
    return table.childNodes[0].childElementCount;
}

function add_row() {
    var table = document.getElementById(TABLE_ID);
    if (table != null) {
        var n_column = get_n_column(table);
        if (n_column > 0) {
            append_row(table, n_column);
        }
    }
}

function add_column() {
    var table = document.getElementById(TABLE_ID);
    if (table != null && table.childElementCount > 0) {
        for (var i = 0; i < table.childElementCount; ++i) {
            append_cells(table.childNodes[i]);
        }
    }
}

function delete_row() {
    var table = document.getElementById(TABLE_ID);
    if (table != null && get_n_row(table) > 0) {
        var r = parseInt(prompt("Which row you want to delete?", "0"));
        if (!isNaN(r) && r >= 0 && r < get_n_row(table)) {
            table.childNodes[r].remove();
        }
    }
}

function delete_column() {
    var table = document.getElementById(TABLE_ID);
    if (table != null && table.childElementCount > 0) {
        var c = parseInt(prompt("Which row you want to delete?", "0"));
        if (!isNaN(c) && c >= 0 && c < get_n_column(table)) {
            var n_row = get_n_row(table);
            for (var r = 0; r < n_row; ++r) {
                table.childNodes[r].childNodes[c].remove();
            }
        }
    }
}

function append_table(result, table_id, n_row, n_column) {
    var table = document.createElement(TABLE);
    table.id = table_id;
    for (var row_index = 0; row_index < n_row; ++row_index) {
        append_row(table, n_column);
    }
    result.appendChild(table);
}

function append_row(table, n_column) {
    var row = document.createElement(ROW);
    for (var column_index = 0; column_index < n_column; ++column_index) {
        append_cells(row);
    }
    table.appendChild(row);
}

function append_cells(row) {
    var cell = document.createElement(TD);
    cell.innerHTML = parseInt(Math.random() * 100);
    row.appendChild(cell);
}