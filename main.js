let addOrUpdate; // to track whether we're doing an add or an update

window.onload = function () {
    // add event handlers for buttons
    /*document.querySelector("#AddButton").addEventListener("click", addItem);
    document
        .querySelector("#DeleteButton")
        .addEventListener("click", deleteItem);
    document
        .querySelector("#UpdateButton")
        .addEventListener("click", updateItem);
    document
        .querySelector("#DoneButton")
        .addEventListener("click", processForm);
    document
        .querySelector("#CancelButton")
        .addEventListener("click", hideUpdatePanel);
*/
    // add event handler for selections on the table
    document.querySelector("#teamsTable").addEventListener("click", handleRowClick);

    //initUpdatePanel();
    //hideUpdatePanel();
    getAllItems();
};

//This block can be reuse for admin or scorekeeper
/*function initUpdatePanel() {
    let url = "bowling/players";
    let method = "GET";
    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            let resp = JSON.parse(xhr.responseText);
            if (resp.data !== null) {
                buildComboBox(resp.data);
            } else {
                alert(resp.error + " status code: " + xhr.status);
            }
        }
    };
    xhr.open(method, url, true);
    xhr.send();
}

function buildComboBox(text) {
    let arr = JSON.parse(text);
    let html = "";
    for (let i = 0; i < arr.length; i++) {
        let row = arr[i];
        html +=
            "<option value='" +
            row.itemCategoryID +
            "'>" +
            row.itemCategoryDescription +
            "</option>";
    }
    let selectElement = document.querySelector("select#itemCategoryID");
    selectElement.innerHTML = html;
}
*/

function initPlayersPanel(id) {
    let url = "bowling/players";
    let method = "GET";
    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            let resp = JSON.parse(xhr.responseText);
            if (resp.data !== null) {
                console.log(resp.data);
                buildPlayersBox(resp.data,id);
            } else {
                alert(resp.error + " status code: " + xhr.status);
            }
        }
    };
    xhr.open(method, url, true);
    xhr.send();
}

function buildPlayersBox(text,id) {
    let arr = JSON.parse(text);
    let html = "<table><tr><th>PlayerID</th><th>Name</th><th>Lastname</th></tr>";

    console.log("received teamid is " + id);
    for (let i = 0; i < arr.length; i++) {
        
        let row = arr[i];
        if(row.teamID == id){
        html += "<tr>";
        html += "<td>" + row.playerID + "</td>";
        html += "<td>" + row.firstName + "</td>";
        html += "<td>" + row.lastName + "</td>";
        //html += "<td>" + (row.vegetarian === 1 ? "Yes" : "No") + "</td>";
        html += "</tr>";
        }
    }
    html += "</table>";
    let theTable = document.querySelector("#playersTable");
    theTable.innerHTML = html;

    //let selectElement = document.querySelector("select#itemCategoryID");
    //selectElement.innerHTML = html;
}

// make AJAX call to get JSON data to populate teams
function getAllItems() {
    //let url = "bowling/teams";
    let url = "bowling/teams";
    let method = "GET";
    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            //console.log(xhr.responseText);
            let resp = JSON.parse(xhr.responseText);
            if (resp.data) {
                buildTable(resp.data);
                //setDeleteUpdateButtonState(false);
            } else {
                alert(resp.error + "; status code: " + xhr.status);
            }
        }
    };
    xhr.open(method, url, true);
    xhr.send();
}

// get the JSON string and build a table
function buildTable(text) {
    let arr = JSON.parse(text); // get JS Objects
    //console.log(arr);
    let html =
        "<table><tr><th>Team ID</th><th>Team Name</th></tr>";
    for (let i = 0; i < arr.length; i++) {
        let row = arr[i];
        html += "<tr>";
        html += "<td>" + row.teamID + "</td>";
        html += "<td>" + row.teamName + "</td>";
        //html += "<td>" + (row.vegetarian === 1 ? "Yes" : "No") + "</td>";
        html += "</tr>";
    }
    html += "</table>";
    let theTable = document.querySelector("#teamsTable");
    theTable.innerHTML = html;
}

function addItem() {
    addOrUpdate = "add";
    clearUpdatePanel();
    showUpdatePanel();
}

function updateItem() {
    addOrUpdate = "update";
    populateUpdatePanel();
    showUpdatePanel();
}

function deleteItem() {
    let row = document.querySelector(".selected"); // we know there's only one
    let id = Number(row.querySelectorAll("td")[0].innerHTML);

    // AJAX
    //let url = "api/deleteItem.php/?itemID=" + id; // "?param=value"
    let url = "bowling/teams/" + id;
    let method = "DELETE";
    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            let resp = JSON.parse(xhr.responseText);
            if (resp.data) {
                alert("Item deleted");
            } else {
                alert(resp.error + " status code: " + xhr.status);
            }
            getAllItems();
        }
    };
    xhr.open(method, url, true);
    xhr.send();
}

// Called when "Done" button is pressed for either Add or Update
function processForm() {
    // Get data from the form and build an object.
    let id = Number(document.querySelector("#itemID").value);
    let cat = document.querySelector("#itemCategoryID").value;
    let desc = document.querySelector("#description").value;
    let price = Number(document.querySelector("#price").value);
    let tempveg = document.querySelector("#vegetarian").checked;

    let obj = {
        itemID: id,
        itemCategoryID: cat,
        description: desc,
        price: price,
        vegetarian: tempveg,
    };

    // Make AJAX call to add or update the record in the database.
    //let url = addOrUpdate === "add" ? "api/addItem.php" : "api/updateItem.php";
    let url = "bowling/items/" + id;
    let method = addOrUpdate === "add" ? "POST" : "PUT";
    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            let resp = JSON.parse(xhr.responseText);
            if (resp.data) {
                if (xhr.status === 200) {
                    alert("Item updated.");
                } else if (xhr.status === 201) {
                    alert("Item added.");
                }
            } else {
                alert(resp.error + " status code: " + xhr.status);
            }
            hideUpdatePanel();
            getAllItems();
        }
    };
    xhr.open(method, url, true);
    xhr.send(JSON.stringify(obj));
}

function setIDFieldState(val) {
    let idInput = document.querySelector("#itemIDInput");
    if (val) {
        idInput.removeAttribute("disabled");
    } else {
        idInput.setAttribute("disabled", "disabled");
    }
}

function hideUpdatePanel() {
    document.querySelector("#AddUpdatePanel").classList.add("hidden");
}

function showUpdatePanel() {
    document.querySelector("#AddUpdatePanel").classList.remove("hidden");
}

function clearUpdatePanel() {
    document.querySelector("#itemID").value = "";
    document.querySelector("#itemCategoryID").value = "";
    document.querySelector("#description").value = "";
    document.querySelector("#price").value = "";
    document.querySelector("#vegetarian").checked = false;
}

function populateUpdatePanel() {
    let selectedItem = document.querySelector(".selected");
    let itemID = Number(
        selectedItem.querySelector("td:nth-child(1)").innerHTML
    );
    let itemCategoryID =
        selectedItem.querySelector("td:nth-child(2)").innerHTML;
    let description = selectedItem.querySelector("td:nth-child(3)").innerHTML;
    let price = Number(selectedItem.querySelector("td:nth-child(4)").innerHTML);
    let vegetarian =
        selectedItem.querySelector("td:nth-child(5)").innerHTML === "Yes";

    document.querySelector("#itemID").value = itemID;
    document.querySelector("#itemCategoryID").value = itemCategoryID;
    document.querySelector("#description").value = description;
    document.querySelector("#price").value = price;
    document.querySelector("#vegetarian").checked = vegetarian;
}

function setDeleteUpdateButtonState(state) {
    if (state) {
        document.querySelector("#DeleteButton").removeAttribute("disabled");
        document.querySelector("#UpdateButton").removeAttribute("disabled");
    } else {
        document
            .querySelector("#DeleteButton")
            .setAttribute("disabled", "disabled");
        document
            .querySelector("#UpdateButton")
            .setAttribute("disabled", "disabled");
    }
}

function handleRowClick(evt) {
    clearSelections();
    
        // Get innerHTML of the selected element
        let innerHTML = evt.target.parentElement.innerHTML;
        let id = evt.target.parentElement.firstElementChild.innerHTML;
        
        console.log(innerHTML);
        console.log(id);

        // Alternatively, if it's an input element, get its value
        // let value = evt.target.parentElement.value;
        // console.log(value);
    evt.target.parentElement.classList.add("selected");

    setDeleteUpdateButtonState(true);

    initPlayersPanel(id);
}

function clearSelections() {
    let trs = document.querySelectorAll("tr");
    for (let i = 0; i < trs.length; i++) {
        trs[i].classList.remove("selected");
    }
}
