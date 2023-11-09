<?php
include('../includes/connect.php');
if (isset($_POST['insert_cat'])) {
    $category_title = $_POST['cat_title'];

    // Select data from the database
    $select_query = "SELECT * FROM categories WHERE category_title = '$category_title'";
    $result_select = mysqli_query($con, $select_query);
    $number = mysqli_num_rows($result_select);

    if ($number > 0) {
        echo "<script>alert('This category is already present in the database')</script>";
    } else {
        // Insert the category using a prepared statement
        $insert_query = "INSERT INTO categories (category_title) VALUES (?)";
        $stmt = mysqli_prepare($con, $insert_query);
        mysqli_stmt_bind_param($stmt, 's', $category_title);

        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Category has been inserted successfully')</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($con) . "')</script>";
        }
    }
}


?>

<h2 class="text-center">Insert Categories</h2>
<form action="" method="post" class="mb-2">
    <div class="input-group w-90 mb-2">
        <span class="input-group-text bg-warning" id="basic-addon1"><i class="fa-solid fa-receipt"></i></span>
        <input type="text" class="form-control" name="cat_title" placeholder="Insert categories" aria-label="Categories" aria-describedby="basic-addon1">
    </div>

    <div class="input-group w-10 mb-2 m-auto">
        
        <input type="submit" class="bg-warning border-0 p-2 my-2" name="insert_cat" value="Insert Categories " >

       
    </div>
</form>