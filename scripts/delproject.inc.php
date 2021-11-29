<?php

    include '/home/mumeora/dbconfig.php';
    //include './dbconfig.php';

    if (isset($_POST['projectid'])){
        $projectId = $_POST['projectid'];
        
        //Delete actual project from projects table
        $query = "DELETE FROM projects WHERE id='$projectId';";
        $result = mysqli_query($conn, $query);


        /* Delete all books and associated plot points
            First, get all project books */
        $bookQuery = "SELECT id FROM books WHERE project_id='$projectId';";
        $bookResult = mysqli_query($conn, $bookQuery);
        $books = mysqli_fetch_all($bookResult, MYSQLI_ASSOC);
       
        /* Then for each book, delete it as well as all plot points with its id */
        foreach($books as $book) { 
            $bookId = $book['id'];
            $delPP = "DELETE FROM plot_points WHERE book_id='$bookId';";
            $delBook = "DELETE FROM books WHERE id='$bookId';";
            $result = mysqli_query($conn, $delPP);
            $result = mysqli_query($conn, $delBook);
        }


        /* Delete characters and associated appearance/basic_info entries
            First, get all project characters */
        $charQuery = "SELECT id FROM characters WHERE project_id='$projectId';";
        $charResult = mysqli_query($conn, $charQuery);
        $characters = mysqli_fetch_all($charResult, MYSQLI_ASSOC);

        /* Then for each character, delete it as well as all app/info entries with its id */
        foreach($characters as $character) { 
            $charId = $character['id'];
            $delApp = "DELETE FROM char_appearance WHERE id='$charId';";
            $delInfo = "DELETE FROM char_basic_info WHERE id='$charId';";
            $delChar = "DELETE FROM characters WHERE id='$charId';";
            $result = mysqli_query($conn, $delApp);
            $result = mysqli_query($conn, $delInfo);
            $result = mysqli_query($conn, $delChar);
        }
    

        //Delete locations
        $delLoca = "DELETE FROM world WHERE project_id='$projectId';";
        $result = mysqli_query($conn, $delLoca);

        //Delete encyclopedia entries
        $delEncy = "DELETE FROM encyclopedia WHERE project_id='$projectId';";
        $result = mysqli_query($conn, $delEncy);
    }
    else{
        header("location:../pages/dashboard.php?error=nosubmit");
    }
?>