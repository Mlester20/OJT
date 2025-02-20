document.addEventListener("DOMContentLoaded", function () {
    let table = document.getElementById("dynamicTableBody");
    let addRowBtn = document.getElementById("addRowBtn");
    let submitBtn = document.getElementById("submitData");

    // Function to add a new row
    function addNewRow() {
        let newRow = table.insertRow();
        for (let i = 0; i < 5; i++) { // Awards, Conferred to, Conferred by, Date, Venue
            let newCell = newRow.insertCell();
            if (i === 3) {
                newCell.innerHTML = '<input type="date">';
            } else {
                newCell.contentEditable = "true";
            }
        }
        let actionCell = newRow.insertCell();
        actionCell.innerHTML = '<button class="btn btn-danger deleteRow">Delete</button>';
        attachDeleteEvent(newRow);
    }

    // Function to attach delete event
    function attachDeleteEvent(row) {
        row.querySelector(".deleteRow").addEventListener("click", function () {
            row.remove();
        });
    }

    // Add 4 default rows on page load
    for (let i = 0; i < 4; i++) { 
        addNewRow();
    }

    // Event listener for adding rows
    addRowBtn.addEventListener("click", addNewRow);

    // Event listener for submitting data
    submitBtn.addEventListener("click", function () {
        let data = [];
        Array.from(table.rows).forEach(row => {
            let rowData = [];
            Array.from(row.cells).forEach((cell, index) => {
                if (index < 5) {
                    rowData.push(index === 3 ? cell.querySelector("input").value : cell.textContent.trim());
                }
            });
            data.push(rowData);
        });

        fetch("save.php", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ tableData: data })
        })
        .then(response => response.text())
        .then(result => alert(result))
        .catch(error => console.error("Error:", error));
    });
});