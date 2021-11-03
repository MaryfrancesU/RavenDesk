<?php

    //include '/home/mumeora/dbconfig.php';
    include '../scripts/dbconfig.php';

    $bookid =  $_SESSION["bookid"];
    $bookQuery = "SELECT title FROM books WHERE id='$bookid';";
    $plotQuery = "SELECT id, content from plot_points WHERE book_id='$bookid';";
    $result1 = mysqli_query($conn, $bookQuery);
    $result2 = mysqli_query($conn, $plotQuery);
    $book = mysqli_fetch_all($result1, MYSQLI_ASSOC)[0];
    $plotpoints = mysqli_fetch_all($result2, MYSQLI_ASSOC);

    $title = $book['title'];
?>

<!DOCTYPE html>
<html>
    <head> 
        <link rel="stylesheet" href="../style/tabs.css"/>
        <script src="../scripts/main.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    </head>

    <body>
        <input 
            class="h3input" 
            value="<?php echo $title; ?>" 
            style="margin-left: 12%; text-align: center;"
            onchange="updateBook(<?php echo $bookid ?>, 'title', event)"
        /> <br>

        <?php 
            foreach($plotpoints as $pp) { 
                $id = $pp['id'];
                $content = $pp['content']; ?>
                <div 
                    class="plot-point" 
                    contenteditable="true"
                    id=<?php echo $id;?>
                    onfocusout="updatePlotPoint(event)"
                >
                    <?php echo $content; ?>
                </div>
            <?php }
        ?> 
        
        <div id="plot-footer">
            <div id="footer-row">
                <textarea id="ppta">Type next plot point here...</textarea>
                <button onclick="addPlotPoint()"> Add </button>
            </div>
        </div>
    </body>

</html>
