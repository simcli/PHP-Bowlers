<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Bowling Tournament</title>

    <link rel="stylesheet" href="mainStyleSheet.css">
    <script src="main.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 0;
            padding: 0;
        }

        .header {
            background-color: #0074d9;
            color: #fff;
            padding: 20px;
        }

        .menu {
            background-color: #f0f0f0;
            padding: 20px;
            box-sizing: border-box;
            overflow: hidden;
        }

        .menu a {
            display: inline-block;
            margin: 0 10px;
            padding: 10px;
            text-decoration: none;
            color: #000;
        }

        .menu a:hover {
            background-color: #ddd;
        }

        .content {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            box-sizing: border-box;
        }

        .slideshow-container {
            position: relative;
            max-width: 100%;
            margin: 0 auto;
        }

        .slideshow-container img {
            width: 100%;
            display: none;
        }

        .grid-container {
        display: grid;
        grid-template-columns: 1fr 1fr; /* Two columns of equal width */
        gap: 20px; /* Gap between the two divs */
        }

        #teamsTable,
        #playersTable {
        border: 1px solid #ccc; /* Adding borders for visualization */
        padding: 10px;
        }

    </style>
</head>

<body>
    <div id="content" class="container">
    <div class="header">
        <img src="logo.png" alt="Company Logo" width="500" />
    </div>
    <div class="menu">
        <a href="teams.php">Teams</a>
        <a href="statistics.php">Statistics</a>
        <a href="tournament_standings.php">Tournament Standings</a>
        <a href="game_recaps.php">Game Recaps</a>
        <a href="prize_payouts.php">Prize Payouts</a>
    </div>
    <div class="content">

        <!-- This Container creates two columns for teams and players visualization -->
        <div class="grid-container">
            <div id="teamsTable">
            <!-- to be filled in by JS -->
            </div>
            <div id="playersTable">
            <!-- to be filled in by JS -->
            </div>
        </div>
    </div>

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
                <div class="inputLabel">Item ID:</div>
                <div class="inputField">
                    <input id="itemID" name="itemID" type="number" min="100" max="999" />
                </div>
            </div>
            <div class="inputContainer">
                <div class="inputLabel">Category:</div>
                <div class="inputField">
                    <select id="itemCategoryID" name="itemCategoryID">
                        <!-- to be filled in by JS -->
                    </select>
                </div>
            </div>
            <div class="inputContainer">
                <div class="inputLabel">Description:</div>
                <div class="inputField">
                    <input id="description" name="description" />
                </div>
            </div>
            <div class="inputContainer">
                <div class="inputLabel">Price:</div>
                <div class="inputField">
                    <input id="price" type="number" name="price" min="0" />
                </div>
            </div>
            <div class="inputContainer">
                <div class="inputLabel">Vegetarian:</div>
                <div class="inputField">
                    <input id="vegetarian" type="checkbox" name="vegetarian" />
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


    </div>
</body>

</html>