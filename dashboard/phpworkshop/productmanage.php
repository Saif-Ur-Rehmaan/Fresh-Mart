<!-- add product work start -->
<?php
include "../inc/config.php";
$connection = DatabaseManager::connect();
if (isset($_POST["Add_Product"])) {
    $P_Title = $_POST["P_Title"];
    $_Catagory_id = $_POST["_Catagory_id"];
    $P_Weight = $_POST["P_Weight"];
    $P_Units = $_POST["P_Units"];
    $P_Description = $_POST["P_Description"];



    $Client_id=3;////  ALERT !      STATIC CLIENT ID
    
    
    if (isset($_POST["P_InStock"])) {
        $P_InStock = 1;
    } else {
        $P_InStock = 0;
    }


    $P_Code = $_POST["P_Code"];
    $P_SKU = $_POST["P_SKU"];
    $P_Status = $_POST["P_Status"];
    $P_RegularPrice = $_POST["P_RegularPrice"];
    $P_SalePrice = $_POST["P_SalePrice"];
    $P_MetaTitle = $_POST["P_MetaTitle"];
    $P_MetaDescription = $_POST["P_MetaDescription"];

    $images = $_FILES["file"]; //array

    $P_Images = time().$_FILES['file']['name'];
    $from = $_FILES['file']['tmp_name'];
    $name=$P_Images;
    $to = '../../assets/images/' .$name;
    
 
    
    $query = "INSERT INTO `products` (`P_Title`,`_Client_id`,`_Category_id`, `P_Weight`, `P_Units`, `P_Images`, `P_Description`, `P_InStock`, `P_Code`, `P_SKU`, `P_Status`, `P_RegularPrice`, `P_SalePrice`, `P_MetaTitle`, `P_MetaDescription`)
   VALUES ('$P_Title','$Client_id','$_Catagory_id', '$P_Weight', '$P_Units', '$P_Images', '$P_Description', '$P_InStock', '$P_Code', '$P_SKU', '$P_Status', '$P_RegularPrice', '$P_SalePrice', '$P_MetaTitle', '$P_MetaDescription')";
    echo "<pre>";
    print_r($query);
    $connection = DatabaseManager::connect();
    if (mysqli_query($connection, $query)) {
        if (move_uploaded_file($from, $to)) {
        } else {
            echo "not done";
        };
        header('location: ../products.php');
        die();
    };
}
?>
<!-- add product work end -->


<!-- Delete Product start -->
<?php

if (isset($_GET["DeleteProductOfId"])) {
    $ID = $_GET["DeleteProductOfId"];
    $filename = "../../assets/images/".DatabaseManager::select("products","P_Images as cl","P_Id=$ID")[0]["cl"]; // Specify the path to the file
    
    if (file_exists($filename)) {
        if (unlink($filename)) {
            echo "File 'i.png' has been deleted.";
        } else {
            echo "Unable to delete the file.";
        }
    } else {
        echo "File 'i.png' does not exist.";
    }
    if (mysqli_query($connection, "DELETE FROM `products` WHERE `P_Id` = $ID")) {
        header('location: ../products.php');
    }
}

?>



<!-- Delete Product end -->

<!-- edit Product start -->
<?php
if (isset($_POST["Edit_Product"])) {
    $Edit_Product_id = $_POST["Edit_Product_id"];
    echo $Edit_Product_id;
    echo "<pre>";
    print_r($_POST);
    print_r($_FILES);
    echo "</pre>";
    
    
    $P_Title = $_POST["P_Title"];
    $_Catagory_id = $_POST["_Catagory_id"];
    $P_Weight = $_POST["P_Weight"];
    $P_Units = $_POST["P_Units"];
    $P_Description = $_POST["P_Description"];

    if (isset($_POST["P_InStock"])) {
        $P_InStock = 1;
    } else {
        $P_InStock = 0;
    }


    $P_Code = $_POST["P_Code"];
    $P_SKU = $_POST["P_SKU"];
    $P_Status = $_POST["P_Status"];
    $P_RegularPrice = $_POST["P_RegularPrice"];
    $P_SalePrice = $_POST["P_SalePrice"];
    $P_MetaTitle = $_POST["P_MetaTitle"];
    $P_MetaDescription = $_POST["P_MetaDescription"];

    $images = $_FILES["file"]["name"]; //array
    
    print_r($images  !=null);
    
    
    
    
    if($images!=null){
      $P_Images =time().$_FILES['file']['name'];
      $from = $_FILES['file']['tmp_name'];
      $name=$P_Images;
      $to = '../../assets/images/' .$name;
      $filename = "../../assets/images/".DatabaseManager::select("products","P_Images as cl","P_Id=$Edit_Product_id")[0]["cl"]; // Specify the path to the file
    
    if (file_exists($filename)) {
        if (unlink($filename)) {
            echo "Image File has been deleted.";
            
        } else {
            echo "Unable to delete the file.";
        }
    } else {
        echo "Image File does not exist in Folder.";
    }
    if(move_uploaded_file($from,$to)){
        echo "Image File Moved TO New Folder .";
    }
    
    $editQuery = "UPDATE `products` SET `_Category_Id` = '$_Catagory_id',`P_Title` = '$P_Title', `P_Weight` = '$P_Weight', `P_Units` = '$P_Units', `P_Images` = '$P_Images', `P_Description` = '$P_Description',`P_Status`='$P_Status',`P_InStock`='$P_InStock',`Date`=CURRENT_TIMESTAMP() , `P_Code` = '$P_Code', `P_SKU` = '$P_SKU', `P_RegularPrice` = '$P_RegularPrice', `P_SalePrice` = '$P_SalePrice', `P_MetaTitle` = '$P_MetaTitle', `P_MetaDescription` = '$P_MetaDescription' WHERE `products`.`P_Id` = $Edit_Product_id
    ";
    // echo $editQuery;
}else{
    $editQuery = "UPDATE `products` SET `_Category_Id` = '$_Catagory_id',`P_Title` = '$P_Title', `P_Weight` = '$P_Weight', `P_Units` = '$P_Units', `P_Description` = '$P_Description',`P_Status`='$P_Status',`P_InStock`='$P_InStock',`Date`=CURRENT_TIMESTAMP() , `P_Code` = '$P_Code', `P_SKU` = '$P_SKU', `P_RegularPrice` = '$P_RegularPrice', `P_SalePrice` = '$P_SalePrice', `P_MetaTitle` = '$P_MetaTitle', `P_MetaDescription` = '$P_MetaDescription' WHERE `products`.`P_Id` = $Edit_Product_id
    ";
    // echo $editQuery;

  }
    if (mysqli_query($connection, $editQuery)) {
        header("location: ../products.php");
        die();
    } else {
        echo "<scrript>alert('product not added')</scrript>";
    };
}


?>

<!-- edit Product end -->