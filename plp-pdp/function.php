<?php include 'Db.php' ?>
<?php
function pagination()
{
    global $connection;
    // define how many results you want per page
    $results_per_page = 5;


    if(isset($_POST['search']))
    {
        $valueToSearch = $_POST['valueToSearch'];
        // search in all table columns
        // using concat mysql function
        $query = "SELECT * FROM `products` WHERE CONCAT(`Id`, `Name`, `Sku`, `Price`,`Description`,`Image`) LIKE '%".$valueToSearch."%'";
        
        $search_result = mysqli_query($connection, $query);
        
    }
     else 
    {
        $query = "SELECT * FROM `products`";
        $search_result = mysqli_query($connection, $query);
    }
    



    // find out the number of results stored in database
    $resultArr=[];
    array_push($resultArr,...$search_result);
    $number_of_results = mysqli_num_rows($search_result);
    // determine number of total pages available
    $number_of_pages = $number_of_results / $results_per_page;
    // determine which page number visitor is currently on
    if (!isset($_GET['page'])) {
         $page = 1;
    } 
    else 
    {
    $page = $_GET['page'];
    }
    // determine the sql LIMIT starting number for the results on the displaying page
    $this_page_first_result = ($page - 1) * $results_per_page;
    $resultArr = array_slice($resultArr, $this_page_first_result, $results_per_page);
    foreach($resultArr as $row)
    { ?>
      <form action="index.php?action=Add&Id=<?=$row['Id']; ?>" method="post">
          <tr>
                  <td id="product-image"><a href="details.php?Id=<?=$row['Id']; ?>"><img src="<?php echo $row["image"]; ?>"width="100" height="100"> </a></td>
                  <td><a href="details.php?Id=<?=$row['Id']; ?>"><?=$row['Name']; ?></a></td>
                  <td><?php echo $row['Sku']; ?></td>
                  <td>$<?=number_format($row['Price'], 2); ?></td>
                  <td> <input type="number" Name="quantity" value="1" min=1 max=1000 oninput="this.value = Math.abs(this.value)" class="number"></td>
                  <td><input type="submit" value="Add to Cart" class="btn btn-success btn-sm"></td>
                  <td><a href="details.php?Id=<?=$row['Id']; ?>" class ="btn btn-success">View details</a></td>

              </div>
          </div>
    </form> 
    <center>
    <?php
    }
   // display the links to the pages

    for ($page = 1;$page <= $number_of_pages;$page++)
    {
        echo '<a "  href="index.php?page=' . $page . '">' . $page . '</a> ';
    }

} ?>

    </center>

    