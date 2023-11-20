<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Database Demo 3</title>

    <link rel="stylesheet" href="mainStyleSheet.css">
    <script src="main.js"></script>
</head>

<body>
    <div id="content" class="container">
        <h1>JS/PHP CRUD Demo</h1>

        <button id="LoadButton" class="btn-primary">Load Items</button>
        <div id="ButtonPanel">
            <button id="AddButton" class="btn-primary">Add</button>
            <button id="DeleteButton" class="btn-primary" disabled>
                Delete
            </button>
            <button id="UpdateButton" class="btn-primary" disabled>
                Update
            </button>
        </div>

        <div id="AddUpdatePanel" class="hidden">
            <div class="inputContainer">
                <div class="inputLabel">Customer Number:</div>
                <div class="inputField">
                    <input id="customerNumber" name="customerNumber" type="number" min="100" max="999" />
                </div>
            </div>
            <div class="inputContainer">
                <div class="inputLabel">Customer Name:</div>
                <div class="inputField">
                    <input id="customerName" name="customerName" />
                </div>
            </div>
            <div class="inputContainer">
                <div class="inputLabel">Phone:</div>
                <div class="inputField">
                    <input id="phone" name="phone" />
                </div>
            </div>
            <div class="inputContainer">
                <div class="inputLabel">credit:</div>
                <div class="inputField">
                    <input id="credit" type="number" name="credit" min="0" step='.01'/>
                </div>
            </div>
            <div class="inputContainer">
                <div class="inputLabel">premiumMember:</div>
                <div class="inputField">
                    <input id="premiumMember" type="checkbox" name="premiumMember" />
                </div>
            </div>
            <div class="inputContainer">
                <div class="inputLabel">&nbsp;</div>
                <div class="inputField">
                    <button id="DoneButton" class="btn-primary">
                        Done
                    </button>
                    <button id="CancelButton" class="btn-primary">
                        Cancel
                    </button>
                </div>
            </div>
        </div>

        <div id="MenuitemsTable">
            <!-- to be filled in by JS -->
        </div>
    </div>
</body>

</html>