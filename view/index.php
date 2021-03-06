<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Pascal Store | Home</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="src/style/homepage.css?2022053101" />
    <link rel="shortcut icon" href="/CD-Book-Store-System/view/src/image/logo.png" type="image/x-icon" />
</head>

<body>

    <div class="loading-area" id="loading-area">
        <div class="logo-box" id="logo-box">
            <div class="shine">
                <div class="logo-text">
                    <h1><strong>Pascal Store</strong></h1>
                </div>
            </div>
        </div>
        <div class="left-box" id="left-box">

        </div>
        <div class="right-box" id="right-box">

        </div>
    </div>

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
                <a type="button" class="offcanvas_btn" href="" onclick="homepageLogout()"><i class="bi bi-box-arrow-left mx-2"></i>Log out</a>
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
                        <a href="" class="navbar_topic">
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

    <div class="container-full">
        <!-- Ad Area -->
        <div class="ad-area" id="ad-area">
            <div class="col-3 ad-wrap p-3"></div>
        </div>
        <!-- Ad End -->
        <!-- Content Area -->
        <div class="content-area">
            <div class="row m-0 p-0">
                <!-- Recent Area -->
                <div class="col-3 recent-area ps-3 p-0" id="recent-area">
                    <div class="head p-4">
                        <h1><i class="bi bi-clock-history me-2"></i>Recent Browsing</h1>
                    </div>
                    <div class="browsing-history-component-wrap" id="browsing-history-component-wrap"></div>
                </div>
                <!-- Recent Area End -->
                <!-- Foryou Area -->
                <div class="col-9 foryou-area pe-5" id="foryou-area">
                    <div class="head py-4">
                        <h1><i class="bi bi-star me-2"></i>For <strong class="strong-black">You</strong></h1>
                    </div>
                    <div class="row foryou-component-area m-0" id="foryou-component-area">
                    </div>
                </div>
                <!-- Foryou Area End -->
            </div>
        </div>
        <!-- Content Area End -->
    </div>

    <!-- Google api jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <!-- Navbar -->
    <script src="/CD-Book-Store-System/view/src/script/searchProduct.js"></script>
    <script src="/CD-Book-Store-System/view/src/script/member.js"></script>
    <!-- Custom -->
    <script src="/CD-Book-Store-System/view/src/script/homepage.js?2022052801"></script>
</body>

</html>