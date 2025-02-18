document.addEventListener("DOMContentLoaded", function () {
    let table = document.getElementById("dynamicTableBody");
    let header = document.getElementById("dynamicTableHeader");
    let addRowBtn = document.getElementById("addRowBtn");
    let addColumnBtn = document.getElementById("addColumnBtn");

    addRowBtn.addEventListener("click", function () {
        let rowCount = table.rows.length;
        let newRow = table.insertRow();
        
        let colCount = header.cells.length;
        
        for (let i = 0; i < colCount; i++) {
            let newCell = newRow.insertCell();
            if (i === 0) {
                newCell.textContent = rowCount + 1;
            } else if (i === colCount - 1) {
                newCell.innerHTML = '<button class="btn btn-danger deleteRow">Delete</button>';
            } else {
                newCell.contentEditable = "true";
            }
        }
        attachDeleteEvent(newRow);
    });

    addColumnBtn.addEventListener("click", function () {
        let newColIndex = header.cells.length - 1; // Before the last Actions column
        
        let newHeader = document.createElement("th");
        newHeader.textContent = "New Column " + newColIndex;
        header.insertBefore(newHeader, header.lastElementChild);
        
        Array.from(table.rows).forEach(row => {
            let newCell = row.insertCell(newColIndex);
            newCell.contentEditable = "true";
        });
    });

    function attachDeleteEvent(row) {
        row.querySelector(".deleteRow").addEventListener("click", function () {
            row.remove();
        });
    }
});