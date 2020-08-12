var selectedRow = null


function onFormSubmit() {
        var formData = readFormData();
        if(selectedRow == null)
            insertNewRecord(formData);
            else
            updateRecord(formData);
        resetForm();
    }

function readFormData(){
    var formData = {};
    formData["bookName"] = document.getElementById("bookName").value;
    formData["authorBook"] = document.getElementById("authorBook").value;
    formData["publishBook"] = document.getElementById("publishBook").value;
    formData["years"] = document.getElementById("years").value;    
    return formData;
}

function insertNewRecord(data){
    var table = document.getElementById("bookList").getElementsByTagName('tbody')[0];
    var newRow = table.insertRow(table.length);
    cell1 = newRow.insertCell(0);
    cell1.innerHTML = data.bookName;
    cell2 = newRow.insertCell(1);
    cell2.innerHTML = data.authorBook;
    cell3 = newRow.insertCell(2);
    cell3.innerHTML = data.publishBook;
    cell4 = newRow.insertCell(3);
    cell4.innerHTML = data.years;
    cell4 = newRow.insertCell(4);
    cell4.innerHTML = `<a onClick="onEdit(this)"> Edit </a>
                       <a onClick="onDelete(this)"> Delete </a>`;
}

function resetForm(){
    document.getElementById("bookName").value = "";
    document.getElementById("authorBook").value = "";
    document.getElementById("publishBook").value = "";
    document.getElementById("years").value = "";
    selectedRow = null;
}


function onEdit(td){
    selectedRow = td.parentElement.parentElement;
    document.getElementById("bookName").value = selectedRow.cells[0].innerHTML;
    document.getElementById("authorBook").value = selectedRow.cells[1].innerHTML;
    document.getElementById("publishBook").value = selectedRow.cells[2].innerHTML;
    document.getElementById("years").value = selectedRow.cells[3].innerHTML;
}

function updateRecord(formData){
    selectedRow.cells[0].innerHTML = formData.bookName;
    selectedRow.cells[1].innerHTML = formData.authorBook;
    selectedRow.cells[2].innerHTML = formData.publishBook;
    selectedRow.cells[3].innerHTML = formData.years;
}

function onDelete(td){
    if(confirm('Are you sure to delete this record?')){
        row = td.parentElement.parentElement;
        document.getElementById("bookList").deleteRow(row.rowIndex);
        resetForm();
    }
}
