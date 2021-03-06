<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../src/style/product.css?2022053101" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous" />
    <link rel="shortcut icon" href="/CD-Book-Store-System/view/src/image/logo.png" type="image/x-icon" />
    <title>Pascal Store</title>
</head>

<body>
    <?php

    session_start();

    if (isset($_SESSION['member_id']) && isset($_SESSION['email'])) {

    ?>

        <!-- Navbar -->
        <div class="container-fluid bg-white p-3 navbar-area">
            <div class="row">
                <div class="col-3" id="search-div">
                    <div class="nav-item d-flex mt-2">
                        <input class="form-control search_input" type="text" id="search" placeholder="search" style="width: 240px" />
                        <button class="navbar_btn mx-1" type="button" onclick="" id="search_btn">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </div>
                <div class="col-6 d-flex justify-content-center">
                    <div class="nav-item gradient-text">
                        <a href="/CD-Book-Store-System/view/" class="navbar_topic">
                            <h1><strong>Pascal Store</strong></h1>
                        </a>
                    </div>
                </div>
                <div class="col-3 d-flex justify-content-end mt-2">
                    <div class="nav-item username-nav-item" style="height: 32px">
                        <a class="navbar_btn mx-1" type="button" href="/CD-Book-Store-System/view/cart/"><i class="bi bi-cart-fill"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
            <div class="offcanvas-header d-flex justify-content-center username-offcanvas-header"></div>
            <div class="offcanvas-body">
                <div class="d-flex justify-content-center">
                    <a type="button" class="offcanvas_btn my-3" href="/CD-Book-Store-System/view/editMemberInfo/"><i class="bi bi-pen mx-3"></i>Edit Profile</a>
                </div>
                <div class="d-flex justify-content-center">
                    <a type="button" class="offcanvas_btn my-3" href="/CD-Book-Store-System/view/orderList/"><i class="bi bi-card-list mx-3"></i>Order List</a>
                </div>
                <div class="d-flex justify-content-center">
                    <a type="button" class="offcanvas_btn my-3" href="/CD-Book-Store-System/view/cart/"><i class="bi bi-cart-fill mx-3"></i>Shopping Cart</a>
                </div>
                <div class="d-flex justify-content-center">
                    <a type="button" class="offcanvas_btn my-3" href="/CD-Book-Store-System/view/followList/"><i class="bi bi-list-stars mx-3"></i>Following</a>
                </div>
                <div class="d-flex justify-content-center">
                    <a type="button" class="offcanvas_btn my-3" href="/CD-Book-Store-System/view/browserHistory/"><i class="bi bi-clock-history mx-3"></i>History</a>
                </div>
                <div class="d-flex justify-content-center">
                    <a type="button" class="offcanvas_btn my-3" href="/CD-Book-Store-System/view/cs/"><i class="bi bi-chat-dots mx-3"></i>Customer Service</a>
                </div>
            </div>
            <div class="offcanvas-footer d-flex justify-content-center">
                <a type="button" class="offcanvas_btn" href="" onclick="logout()"><i class="bi bi-box-arrow-left mx-2"></i>Log out</a>
            </div>
        </div>
        <!-- Navbar end -->

    <?php

    } else {

    ?>

        <!-- No Login Navbar -->
        <div class="container-fluid bg-white p-3 navbar-area">
            <div class="row">
                <div class="col-3" id="search-div">
                    <div class="nav-item d-flex mt-2">
                        <input class="form-control search_input" type="text" id="search" placeholder="search" style="width: 240px" />
                        <button class="navbar_btn mx-1" type="button" onclick="" id="search_btn">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </div>
                <div class="col-6 d-flex justify-content-center">
                    <div class="nav-item gradient-text">
                        <a href="/CD-Book-Store-System/view/" class="navbar_topic">
                            <h1><strong>Pascal Store</strong></h1>
                        </a>
                    </div>
                </div>
                <div class="col-3 d-flex justify-content-end mt-2">
                    <div class="nav-item" style="height: 32px;">
                        <a class="navbar_btn mx-1" type="button" href=""><i class="bi bi-cart-fill"></i> </a>
                        <a class="navbar_btn" type="button" href="/CD-Book-Store-System/view/login"><i class="bi bi-person-fill mx-2"></i>Login</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- No Login Navbar End -->

    <?php

    }

    ?>

    <!-- Navbar end -->
    <div class="page">
        <!-- contentArea -->
        <section class="contentArea" id="contentArea">
            <div class="productWrap">
                <!-- productLeftBox -->
                <div class="productLeftBox">
                    <img src="" class="book-img" id="product_image" />
                    <div class="rate">
                        <i class="bi star1 star"></i>
                        <i class="bi star2 star"></i>
                        <i class="bi star3 star"></i>
                        <i class="bi star4 star"></i>
                        <i class="bi star5 star"></i>
                    </div>
                </div>
                <!-- productLeftBox end -->
                <!-- productRightBox -->
                <div class="productRightBox">
                    <div class="product-text">
                        <h1 class="book-name ellipsis-3" id="product_name"></h1>
                        <h2 class="book-auth ellipsis-1">by <a id="product_author"></a></h2>
                        <p class="book-description ellipsis-6" id="product_description"></p>
                    </div>
                    <div class="price">
                        <p class="price-text">
                            <strong>NT$ <a id="product_price"></a></strong>
                        </p>
                    </div>
                    <div class="btn-area">
                        <button class="follow-btn" id="follow_btn">
                            <a id="follow_btn_txt"></a><i class="bi bi-heart-fill"></i>
                        </button>
                        <button class="cart-btn" id="cart_btn">
                            <a id="cart_btn_txt"></a><i class="bi bi-cart-fill"></i>
                        </button>
                    </div>
                </div>
                <!-- productRightBox end -->
            </div>
            <div class="scrollHint" onclick="document.getElementById('commentArea').scrollIntoView({behavior: 'smooth'});">
                <p>Scroll to see comments</p>
                <div class="scrollIcon">
                    <i class="bi bi-chevron-compact-down"></i>
                </div>
            </div>
        </section>
        <!-- contentArea end -->
        <!-- commentArea -->
        <section class="commentArea" id="commentArea">
            <div class="commentWrap">
                <!-- commentLeftBox -->
                <div class="commentLeftBox">
                    <div class="commentImgArea">
                        <img src="" class="commentBookImg" id="comment_product_image" />
                    </div>
                    <div class="commentInfoArea">
                        <h1 class="commentBookName" id="comment_product_name"></h1>
                        <h2 class="commentBookAuth">by <a id="comment_product_author"></a></h2>
                        <div class="commentRate">
                            <i class="bi star1 star"></i>
                            <i class="bi star2 star"></i>
                            <i class="bi star3 star"></i>
                            <i class="bi star4 star"></i>
                            <i class="bi star5 star"></i>
                        </div>
                    </div>
                </div>
                <!-- commentLeftBox end -->
                <!-- commentRightBox -->
                <div class="commentRightBox">
                    <div class="commentTitleArea">
                        <h1 class="commentTitle">Comments</h1>
                    </div>
                    <!-- Comment Component Area -->
                    <div class="commentComponentArea" id="commentComponentArea"></div>
                    <!-- Comment Component Area end-->
                </div>
                <!-- commentRightBox end -->
            </div>
        </section>
        <!-- commentArea end -->
    </div>
</body>

<!-- Google api jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<!-- Navbar js -->
<script src="/CD-Book-Store-System/view/src/script/member.js"></script>
<script src="../src/script/searchProduct.js"></script>
<!-- Custom js -->
<script src="../src/script/product.js?2022052801"></script>

</html>