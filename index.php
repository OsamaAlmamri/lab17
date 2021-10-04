<?php include "header.php"; ?>
<ul class="breadcrumb">
    <li class="breadcrumb-item active "><a href="#">الرئيسية</a></li>
    <?php if (is_login()) {
        ?>
        <a href="addProduct.php" class="btn btn-primary  ml-auto "> اضافة </a>
    <?php } ?>
    </li>
</ul>


<div class="row " style="margin-top: 10px;">
    <?php
    $product  = new Product();
    $products = $product->getAll();
    foreach ($products as $pro) { ?>
        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2 mt-2">
            <div class="card shadow py-2 ">
                <div class="close ml-auto">
                    <div class="dropdown dropright">

                        <a class="dropdown-toggle" href="javascript::void(0)" data-toggle="dropdown">
                            ...
                        </a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="edit.php?id=<?php echo $pro->id ?>"> <i
                                        class="fa fa-edit"> </i> edit </a>
                            <a class="dropdown-item" href="delete.php?id=<?php echo $pro->id ?>"> <i
                                        class="fa fa-trash"> </i> delete </a>
                        </div>
                    </div>

                </div>
                <img class="card-img-top" src="<?php echo empty($pro->image) ? 'images/avatar3.png' : $pro->image; ?>"
                     alt="">
                <div class="card-body">
                    <div class="card-title"><?php echo $pro->name ?></div>
                    <div class="card-text "><?php echo $pro->description ?></div>
                </div>
                <div class="body-footer mx-2">
                    <button class="show_detail btn btn-info" data-description="<?php echo $pro->description ?>"> show
                    </button>
                </div>
            </div>
        </div>

    <?php } ?>
</div>


<!-- The Modal -->
<div class="modal fade" id="myDetaols">
    <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title"> التفاصيل </h4>
                <button type="button" class="close close_modal"> &times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <p id="modal_desc">
                </p>

            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger close_modal">Close</button>

            </div>

        </div>
    </div>
</div>


<?php include "footer.php"; ?>

