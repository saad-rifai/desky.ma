function edit(id) {
    $("#iddata").val(id);
}
function delet(id) {
    $("#iddelet").val(id);
}
function editcard(id) {
    $("#iddatacard").val(id);
}
function deletcard(id) {
    $("#iddeletcard").val(id);
}
/*  ********************/
function edit_1(id) {
    $("#iddata_1").val(id);
}
function delet_1(id) {
    $("#iddelet_1").val(id);
}
function edit_2(id) {
    $("#iddata_2").val(id);
}
function delet_2(id) {
    $("#iddelet_2").val(id);
}
function edit_4(id) {
    $("#iddata_4").val(id);
}
function delet_4(id) {
    $("#iddelet_4").val(id);
}
function edit_5(id) {
    $("#iddata_5").val(id);
}
function delet_5(id) {
    $("#iddelet_5").val(id);
}
function edit_6(id) {
    $("#iddata_6").val(id);
}
function delet_6(id) {
    $("#iddelet_6").val(id);
}
function SearchTabelOID() {
    // Declare variables
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");

    // Loop through all table rows, and hide those who don't match the search query
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[0];
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}
function SearchTabelEmail(id) {
    // Declare variables
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById(id);
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");

    // Loop through all table rows, and hide those who don't match the search query
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[2];
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}
function SearchTabelPhone(id) {
    // Declare variables
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById(id);
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");

    // Loop through all table rows, and hide those who don't match the search query
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[3];
        if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}
$(function() {
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });

    $(window).resize(function(e) {
        if ($(window).width() <= 768) {
            $("#wrapper").removeClass("toggled");
        } else {
            $("#wrapper").addClass("toggled");
        }
    });
});
