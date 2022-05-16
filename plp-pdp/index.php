<?php include "function.php"; ?>
<?php
session_start();
if (!empty($_GET['action']))
{
    switch ($_GET['action'])
    {
        case 'Add':
            if (!empty($_POST['quantity']))
            {

                $id = $_GET['Id'];
                $query = "SELECT * FROM products WHERE Id=" . $id;
                $result = mysqli_query($connection, $query);
                while ($product = mysqli_fetch_array($result))
                {
                    $itemArray = [$product['Sku'] => ['Name' => $product['Name'], 'Sku' => $product['Sku'], 'quantity' => $_POST['quantity'], 'Price' => $product['Price'], 'image' => $product['image']]];
                    if (isset($_SESSION['cart_item']) && !empty($_SESSION['cart_item']))
                    
                    {
                        if (in_array($product['Sku'], array_keys($_SESSION['cart_item'])))
                        {
                            foreach ($_SESSION['cart_item'] as $key => $value)
                            {
                                if ($product['Sku'] == $key)
                                {
                                    if (empty($_SESSION['cart_item'][$key]["quantity"]))
                                    {
                                        $_SESSION['cart_item'][$key]['quantity'] = 0;
                                    }
                                    $_SESSION['cart_item'][$key]['quantity'] += $_POST['quantity'];
                                }
                            }
                        }
                        else
                        {
                            $_SESSION['cart_item'] += $itemArray;
                        }
                    }
                    else
                    {
                        $_SESSION['cart_item'] = $itemArray;
                    }
                }
            }
        break;
        case 'remove':
            if (!empty($_SESSION['cart_item']))
            {
                foreach ($_SESSION['cart_item'] as $key => $value)
                {
                    if ($_GET['Sku'] == $key)
                    {
                        unset($_SESSION['cart_item'][$key]);
                    }
                    if (empty($_SESSION['cart_item']))
                    {
                        unset($_SESSION['cart_item']);
                    }
                }
            }
        break;
        case 'empty':
            unset($_SESSION['cart_item']);
        break;
    }
}

?>



<html>
<head>
    <title>PLP & PDP</title>
    <link rel="stylesheet" href="css/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" >
   <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

<!-- Including our scripting file. -->

<script type="text/javascript" src="script.js"></script>


</head>
<body class="body">
    <div class="container">
        <div>
        <h1 align="center">PLP & PDP</h1>
        </div>
        <div>
        
        <form action="index.php" method="post">
            <input type="text" name="valueToSearch" placeholder="Value To Search">
            <input type="submit" name="search" value="Search"><br><br>

<div class="float:right">
   <form action="" method="post">
    <select name="link">
       <option value="http://localhost/plp-pdp/index.php?page=1" selected>Accessories</option>
       <option value="http://localhost/plp-pdp/index.php?page=2" selected>Appliances</option>
       <option value="http://localhost/plp-pdp/index.php?page=3" selected>Dress</option>
       <option value="http://localhost/plp-pdp/index.php?page=4" selected>Electronics</option>
    </select>
    <input type="submit" name="redirect" value="GO" /> 
</form>
</div><br><br>

        <div class="float-right">
        <table  class="table">
        <h3> Cart </h3>
            <tbody>
            <tr>
                <th class="text-left">Name</th>
                <th class="text-left">Sku</th>
                <th class="text-right">Quantity</th>
                <th class="text-right">Item Price</th>
                <th class="text-right">Price</th>
                <th class="text-center">Remove</th>
            </tr>
            <a id="btnEmpty" href="index.php?action=empty">EMPTY CART</a>
            <?php
            $total_quantity=0;
            $total_Price=0;
if (isset($_SESSION['cart_item']) && !empty($_SESSION['cart_item']))
{
    foreach ($_SESSION['cart_item'] as $item)
    {
        $item_Price = $item['quantity'] * $item['Price'];
?>
                    <tr>
                        <td class="text-left">
                            <img src="<?=$item['image'] ?>" alt="<?=$item['Name'] ?>"  width="100" height="100">
                            <?=$item['Name'] ?>
                        </td>
                        <td class="text-left"><?=$item['Sku'] ?></td>
                        <td class="text-right"><?=$item['quantity'] ?></td>
                        <td class="text-right">$<?=number_format($item['Price'], 2) ?></td>
                        <td class="text-right">$<?=number_format($item_Price, 2) ?></td>
                        <td class="text-center">
                            <a href="index.php?action=remove&Sku=<?=$item['Sku']; ?>" class="btn btn-danger">X</a>
                        </td>
                    </tr>

                    <?php
        
        $total_quantity += $item["quantity"];
        $total_Price += ($item["Price"] * $item["quantity"]);
    }
}

if (isset($_SESSION['cart_item']) && !empty($_SESSION['cart_item']))
{
?>
                <tr>
                    <td colspan="2" align="right">Total:</td>
                    <td align="right"><strong><?=$total_quantity
?></strong></td>
                    <td></td>
                    <td align="right"><strong>$<?=number_format($total_Price, 2); ?></strong></td>
                    <td></td>
                </tr>

            <?php
}

?>
            </tbody>
        </table>
    </div>
    <div class="float-lg-left" class="col-md-3">
            <table id="myTable" class="table  ">
                <tr >
                    <th>Product</th>
                    <th>Name</th>
                    <th>Sku</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Action</th>
                    <th>Details</th>
                </tr>

                <?php while($row = mysqli_fetch_array($search_result)):?>
                <tr>
                    <td><?php echo $row['Id'];?></td>
                    <td><?php echo $row['Name'];?></td>
                    <td><?php echo $row['Sku'];?></td>
                    <td><?php echo $row['Price'];?></td>
                    <td><?php echo $row['Description'];?></td>
                    <td><?php echo $row['Image'];?></td>

                </tr>
                <?php endwhile;?>
                <hr> 
           <?php 
           
           if(isset($_POST['redirect'])){
            header('Location: '.$_POST['link']);
            exit;
        }
           
           ?>
                <?php
                pagination();

                ?>

        </table> 
            </div>
            </div>
</body>
</html>

   