<?php 
    session_start();
    if(!isset($_SESSION['user'])) header('location: login.php');

    $_SESSION['table'] = 'products';
    $products = include('database/show.php');
?>

<!DOCTYPE html>
<html>
    <head>
        <title>View Products - Stock Management System</title>
        <?php include('partials/app-header-scripts.php'); ?>
    </head>

<body>
    <div id="dashboardMainContainer">
        <?php include('partials/app-sidebar.php') ?>
        <div class="dashboard_content_container" id="dashboard_content_container">
            <?php include('partials/app-topnav.php') ?>
            <div class="dashboard_content">
                <div class="dashboard_content_main">
                    <div class="row">
                        <div class="column column-12">
                            <h1 class="section_header"><i class="fa fa-list"></i> List of Products</h1> 
                            <div class="section_content">
                                <div class="users">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>id</th>
                                                <th>Product Name</th>
                                                <th>Location</th>
                                                <th>Data Type</th>
                                                <th>Value</th>
                                                <th>Average Value</th>
                                                <th>Quantity</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        // Filtrare solo i prodotti con location consentite
                                        $filteredProducts = array_filter($products, function ($product) {
                                            $allowed_locations = ['magazzino1', 'magazzino2', 'magazzino3'];
                                            return in_array($product['location'], $allowed_locations);
                                        }); ?>  
                                            <?php foreach($filteredProducts as $index => $product){ ?>
                                                <tr>
                                                    <td><?= $index + 1 ?></td>
                                                    <td class="product_id"><?= $product['product_id'] ?></td>
                                                    <td class="product_name"><?= $product['product_name'] ?></td>
                                                    <td class="location"><?= $product['location'] ?></td>
                                                    <td class="data_type"><?= $product['data_type'] ?></td>
                                                    <td class="value"><?= $product['value'] ?></td>
                                                    <td class="avg_value"><?= $product['avg_value'] ?></td>
                                                    <td class="quantity"><?= $product['quantity'] ?></td>
                                                    <td class="editDelete">
                                                        <a href="" class="updateProduct" data-pid="<?= $product['id'] ?>"><i class="fa fa-pencil"></i>  Edit</a> |
                                                        <a href="" class="deleteProduct" data-pid="<?= $product['id'] ?>" data-name="<?= $product['product_name'] ?>"><i class="fa fa-trash"></i>  Delete</a>
                                                    </td>
                                                </tr>
                                            <?php } ?>    
                                        </tbody>
                                    </table>
                                    <p class="userCount"><?= count($filteredProducts) ?> Products </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>    
            </div>
        </div>
    </div>

    <?php include('partials/app-scripts.php'); ?>

<script>
    function script(){
        var vm = this;

        this.registerEvents = function(){
            document.addEventListener('click', function(e){
                targetElement = e.target;
                classList = targetElement.classList;

                if(classList.contains('deleteProduct')){
                    e.preventDefault();

                    pId = targetElement.dataset.pid;
                    pName = targetElement.dataset.name;

                    BootstrapDialog.confirm({
                        type: BootstrapDialog.TYPE_DANGER,
                        title: 'Delete Product',
                        message: 'Are you sure to delete <strong>'+ pName + '</strong>?',
                        callback: function(isDelete){
                            if(isDelete){
                                $.ajax({
                                    method: 'POST',
                                    data: {
                                        id: pId,
                                        table: 'products'
                                    },
                                    url: 'database/delete.php',
                                    dataType: 'json',
                                    success: function(data){
                                        message = data.success ?
                                            pName + ' successfully deleted' : 'Error processing your request';

                                        BootstrapDialog.alert({
                                            type: data.success ? BootstrapDialog.TYPE_SUCCESS : BootstrapDialog.TYPE_DANGER,
                                            message: message,
                                            callback: function(){
                                                if(data.success) location.reload();
                                            }
                                        });                           
                                    }
                                });
                            }
                        }
                    });
                }

                if(classList.contains('updateProduct')){
                    e.preventDefault();

                    pId = targetElement.dataset.pid;

                    vm.showEditDialog(pId);

                }

            });
            
            document.addEventListener('submit', function(e){
                e.preventDefault();
                targetElement = e.target;

                if(targetElement.id === 'editProductForm'){
                    vm.saveUpdatedData(targetElement);
                }
            })

        },

        this.saveUpdatedData = function(form){

            $.ajax({
                method: 'POST',
                data: new FormData(form),
                url: 'database/update-product.php',
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(data){

                    BootstrapDialog.alert({
                        type: data.success ? BootstrapDialog.TYPE_SUCCESS : BootstrapDialog.TYPE_DANGER,
                        message: data.message,
                        callback: function(){
                            if(data.success) location.reload();
                        }
                    });                         
                }
            });
        },

        this.showEditDialog = function(id){
            $.get('database/get-product.php', {id: id}, function(productDetails){

                BootstrapDialog.confirm({
                    title: 'Update <strong>' + productDetails.product_name + '</strong>',
                    message: '<form action="database/add.php" method="POST" enctype="multipart/form-data" id="editProductForm">\
                                <div class="appFormInputContainer">\
                                    <label for="product_id">ID</label>\
                                    <input type="text" class="appFormInput" id="product_id" value="' + productDetails.product_id +'" placeholder="Enter product id..." name="product_id"/>\
                                </div>\
                                <div class="appFormInputContainer">\
                                    <label for="product_name">Product Name</label>\
                                    <input type="text" class="appFormInput" id="product_name" value="' + productDetails.product_name +'" placeholder="Enter product name..." name="product_name"/>\
                                </div>\
                                <div class="appFormInputContainer">\
                                    <label for="location">Location</label>\
                                    <label for="location">Location</label>\
                                        <select class="appFormInput" id="location" name="location">\
                                        <option value="magazzino1">Magazzino 1</option>\
                                        <option value="magazzino2">Magazzino 2</option>\
                                        <option value="magazzino3">Magazzino 3</option>\
                                        </select>\
                                </div>\
                                <div class="appFormInputContainer">\
                                    <label for="data_type">Data Type</label>\
                                    <input type="text" class="appFormInput" id="data_type" value="' + productDetails.data_type +'" placeholder="Enter product type..." name="data_type"/>\
                                </div>\
                                <div class="appFormInputContainer">\
                                    <label for="value">Value</label>\
                                    <input type="number" class="appFormInput" id="value" value="' + productDetails.value +'" placeholder="Enter product value..." name="value"/>\
                                </div>\
                                <div class="appFormInputContainer">\
                                    <label for="avg_value">Average Value</label>\
                                    <input type="number" class="appFormInput" id="avg_value" value="' + productDetails.avg_value +'" placeholder="Enter product average value..." name="avg_value"/>\
                                </div>\
                                <div class="appFormInputContainer">\
                                    <label for="quantity">Quantity</label>\
                                    <input type="number" class="appFormInput" id="quantity" value="' + productDetails.quantity +'" placeholder="Enter product Quantity..." name="quantity"/>\
                                </div>\
                                <input type="hidden" name="pid" value="'+ productDetails.id +'" />\
                                <input type="submit" value="submit" id="editProductSubmitBtn" class="hidden"/>\
                            </form>',
                        callback: function(isUpdate){
                            if(isUpdate){

                                document.getElementById('editProductSubmitBtn').click();

                            }
                        }
                    });
            }, 'json');

        }

        this.initialize = function(){
            this.registerEvents();
        }
    }
    var script = new script;
    script.initialize();

</script>
</body>
</html>