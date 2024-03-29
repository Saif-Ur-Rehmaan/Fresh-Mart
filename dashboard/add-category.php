<?php  
include "inc/config.php"; 
$EditId=(isset($_GET["EditCategoryOfId"]))?$_GET["EditCategoryOfId"]:"";
?>
<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from freshcart.codescandy.com/dashboard/add-category.php by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 31 Mar 2023 10:11:27 GMT -->

<?php include "inc/head/head1.php"; ?>

<body>
    <!-- main wrapper -->

    <?php include 'inc/nav/nav.php' ?>
    <div class="main-wrapper">
        <!-- navbar vertical -->

        <?php include 'inc/nav/nav2.php' ?>


        <!-- main -->
        <main class="main-content-wrapper">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row mb-8">
                    <div class="col-md-12">
                        <div class="d-md-flex justify-content-between align-items-center">
                            <!-- page header -->
                            <div>
                                <h2>Add New Category</h2>
                                <!-- breacrumb -->
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb mb-0">
                                        <li class="breadcrumb-item"><a href="#" class="text-inherit">Dashboard</a></li>
                                        <li class="breadcrumb-item"><a href="#" class="text-inherit">Categories</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Add New Category</li>
                                    </ol>
                                </nav>
                            </div>
                            <div>
                                <a href="categories.php" class="btn btn-light">Back to Categories</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-12">
                        <!-- card -->
                        <form action="phpworkshop/categorymanage.php" method="post" enctype="multipart/form-data">

                            <div class="card mb-6 shadow border-0">
                                <!-- card body -->
                                <div class="card-body p-6">
                                    <h4 class="mb-5 h5">Category Image</h4>
                                    <div class="mb-4 d-flex">
                                        <div class="position-relative">
                                            <img class="image  icon-shape icon-xxxl bg-light rounded-4"
                                                src="../assets/images/<?php echo (isset($_GET["EditCategoryOfId"]))?DatabaseManager::select("categories","C_Logo as p","C_id=$EditId")[0]["p"] :""; ?>"
                                                alt="image">

                                            <div class="file-upload position-absolute end-0 top-0 mt-n2 me-n1">
                                                <input type="file" name="C_image" class="file-input ">
                                                <span class="icon-shape icon-sm rounded-circle bg-white">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                                        fill="currentColor" class="bi bi-pencil-fill text-muted"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z" />
                                                    </svg>
                                                </span>
                                            </div>
                                        </div>



                                    </div>
                                    <h4 class="mb-4 h5 mt-5">Category Information</h4>

                                    <div class="row">
                                        <!-- input -->
                                        <div class="mb-3 col-lg-6">
                                            <label class="form-label">Category Name</label>
                                            <input type="text" name="C_name"
                                                <?php echo (isset($_GET["EditCategoryOfId"]))?"value='".DatabaseManager::select("categories","C_name as p","C_id=$EditId")[0]["p"]."'" :"value=''"; ?>
                                                class="form-control" id="cat_inp" placeholder="Category Name" required>
                                        </div>
                                        <!-- input -->
                                        <div class="mb-3 col-lg-6">
                                            <label class="form-label">Slug</label>
                                            <input type="text" name="C_Slug"
                                                <?php echo (isset($_GET["EditCategoryOfId"]))?"value='".DatabaseManager::select("categories","C_Slug as p","C_id=$EditId")[0]["p"]."'" :"value=''"; ?>
                                                class="form-control" id="slug_inp" placeholder="Slug" required>
                                        </div>
                                        <!-- input -->
                                        <div class="mb-3 col-lg-6">
                                            <label class="form-label">Parent Category</label>
                                            <select class="form-select" name="C_ParentCategory">
                                                <option value="NULL">Parent Category Name</option>
                                                <?php $categoriesName= DatabaseManager::select("categories","C_id,C_name");
                                                    if(isset($_GET["EditCategoryOfId"])){
                                                        $PC=DatabaseManager::select("categories","C_ParentCategory as p","C_id=$EditId")[0]["p"];
                                                    }
                                                foreach ($categoriesName as $key => $category) {
                                                    $a="";
                                                    if(isset($_GET["EditCategoryOfId"])){
                                                        $a=($PC==$category["C_id"])?"selected":"";
                                                    };
                                                    echo "<option $a  value='".$category["C_id"]."'>".$category["C_name"]."</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>


                                        <div>

                                        </div>
                                        <!-- input -->
                                        <div class="mb-3 col-lg-12 ">
                                            <label class="form-label">Descriptions</label>

                                            <textarea class="py-8" placeholder="<?php
                                             echo (isset($_GET["EditCategoryOfId"]))?DatabaseManager::select("categories","C_Description as p","C_id=$EditId")[0]["p"]:" ";
                                            ?>" name="C_Description" style="width: inherit;" id="editor"></textarea>

                                        </div>

                                        <!-- input -->
                                        <div class="mb-3 col-lg-12 ">
                                            <label class="form-label">Status</label><br>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="C_Status"
                                                    id="inlineRadio1" value="1" <?php
                                                    //edit category work
                                                     if (isset($_GET["EditCategoryOfId"])){
                                                     $status=DatabaseManager::select("categories","C_Status as p","C_id=$EditId")[0]["p"];
                                                        echo ($status=="1")?"checked":"";
                                                     
                                                     }else{echo "checked";};
                                                    ?>>
                                                <label class="form-check-label" for="inlineRadio1">Active</label>
                                            </div>
                                            <!-- input -->
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="C_Status"
                                                    id="inlineRadio2" value="0" <?php
                                                    //edit category work
                                                     if (isset($_GET["EditCategoryOfId"])){
                                                     $status=DatabaseManager::select("categories","C_Status as p","C_id=$EditId")[0]["p"];
                                                        echo ($status=="0")?"checked":"";
                                                     
                                                     };
                                                    ?>>
                                                <label class="form-check-label" for="inlineRadio2">Disabled</label>
                                            </div>

                                        </div>
                                        <div class="mb-3 col-lg-12 mt-5 ">
                                            <h4 class="mb-4 h5">Meta Data</h4>
                                            <!-- input -->
                                            <div class="mb-3">
                                                <label class="form-label">Meta Title</label>
                                                <input <?php echo (isset($_GET["EditCategoryOfId"]))?
                                                
                                                "value='".DatabaseManager::select("categories","C_MetaTitle as p","C_id=$EditId")[0]["p"]."'" 
                                                
                                                :"value=''"; ?> name="C_MetaTitle" type="text" class="form-control"
                                                    placeholder="Title">
                                            </div>

                                            <!-- input -->
                                            <div class="mb-3">
                                                <label class="form-label">Meta Description</label>
                                                <textarea name="C_MetaDescription" class="form-control" rows="3"><?php
                                             echo (isset($_GET["EditCategoryOfId"]))?DatabaseManager::select("categories","C_MetaDescription  as p","C_id=$EditId")[0]["p"]:"";
                                            ?>

                                                </textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <?php  
                                            if(isset($_GET["EditCategoryOfId"])){
                                                echo "<input type=\"submit\" class=\"btn btn-primary\" value=\"Edit Category \"
                                                name=\"\" readonly>";
                                                echo "<input type=\"hidden\" class=\"btn btn-primary\" value=\"$EditId \"
                                                name=\"Edit_Category\" readonly>";
                                            }else{
                                                
                                                echo '<input type="submit" class="btn btn-primary" value="Create  Category"
                                                name="Create_Category" readonly>';
                                            }
                                            ?>
                                            

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>

                    </div>


                </div>
            </div>
        </main>

    </div>

    <script src="../assets/libs/flatpickr/dist/flatpickr.min.js"></script>
    <!-- Libs JS -->
     <?php include "../inc/LibsJs.php"?>
    
    

    <!-- Theme JS -->
     <script src="../assets/js/theme.min.js"></script>
    <script src="../assets/libs/quill/dist/quill.min.js"></script>
    <script src="../assets/js/vendors/editor.js"></script>
    <script src="../assets/libs/dropzone/dist/min/dropzone.min.js"></script>

    <script>
    $(document).ready(function() {
        // Function to generate a slug from a category name
        function generateSlug(categoryName) {
            // Convert the category name to lowercase
            const lowercaseName = categoryName.toLowerCase();

            // Replace spaces with hyphens and remove special characters
            const slug = lowercaseName
                .replace(/\s+/g, '-') // Replace spaces with hyphens
                .replace(/[^a-z0-9-]/g, '') // Remove special characters and non-alphanumeric characters
                .replace(/-+/g, '-') // Replace consecutive hyphens with a single hyphen

            return slug;
        }

        // Example usage when a button is clicked
        $('#cat_inp').on("keyup", () => {
            const categoryName = $('#cat_inp').val();
            const slug = generateSlug(categoryName);
            console.log(slug);
            $('#slug_inp').val(slug);
        });
    });
    </script>
</body>


<!-- Mirrored from freshcart.codescandy.com/dashboard/add-category.php by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 31 Mar 2023 10:11:28 GMT -->

</html>