$(() => {
    let memberRes = getMemberInfo();
    if (memberRes) {
        displayUserName(memberRes);
        createBrowsingHistory();
        checkFollow();
        checkCart();
        $("#follow_btn").click(() => {
            if ($("#follow_btn").hasClass("follow-btn")) {
                addToFollow();
                showUnFollowBtn();
            } else {
                removeFollow();
                showFollowBtn();
            }
        });
        $("#cart_btn").click(() => {
            if ($("#cart_btn").hasClass("cart-btn")) {
                addToCart();
                showUnCartBtn();
            } else {
                removeCart();
                showCartBtn();
            }
        });
    } else {
        $("#follow_btn_txt").html("Follow");
        $("#follow_btn").addClass("follow-btn");
        $("#cart_btn_txt").html("Add To Cart");
        $("#cart_btn").addClass("cart-btn");
        $("#follow_btn").click(() => {
            let url = "/CD-Book-Store-System/view/login";
            window.location = url;
        });
        $("#cart_btn").click(() => {
            let url = "/CD-Book-Store-System/view/login";
            window.location = url;
        });
    }
    let product_id = getUrl();
    searchProductById(product_id);
    searchComment(product_id);
});

/* logic */
const displayFollowBtn = (data) => {
    data == "" ? showFollowBtn() : showUnFollowBtn();
};

const displayCartBtn = (data) => {
    data == "" ? showCartBtn() : showUnCartBtn();
};

/* DOM Function */
const getUrl = () => {
    let param = new URLSearchParams(window.location.search);
    return param.get("id");
};

const display404 = () => {
    window.location.replace("/CD-Book-Store-System/view/404");
};

const displayData = (data) => {
    $("#contentArea").addClass("bg-img-" + data[0]["color_theme"]);
    $("#commentArea").addClass("bg-" + data[0]["color_theme"]);
    document.title = "Pascal Store | " + data[0]["product_name"];
    $("#product_name").html(data[0]["product_name"]);
    $("#comment_product_name").html(data[0]["product_name"]);
    $("#comment_product_author").html(data[0]["product_author"]);
    $("#product_author").html(data[0]["product_author"]);
    $("#product_description").html(data[0]["product_description"]);
    $("#product_price").html(data[0]["product_price"]);
    $("#product_image").attr("src", data[0]["product_image"]);
    $("#comment_product_image").attr("src", data[0]["product_image"]);

    displayRate(data);
};

const showFollowBtn = () => {
    $("#follow_btn_txt").html("Follow");
    $("#follow_btn").removeClass("unFollow-btn");
    $("#follow_btn").addClass("follow-btn");
};

const showUnFollowBtn = () => {
    $("#follow_btn_txt").html("Unfollow");
    $("#follow_btn").removeClass("follow-btn");
    $("#follow_btn").addClass("unFollow-btn");
};

const showCartBtn = () => {
    $("#cart_btn_txt").html("Add To Cart");
    $("#cart_btn").removeClass("unCart-btn");
    $("#cart_btn").addClass("cart-btn");
};

const showUnCartBtn = () => {
    $("#cart_btn_txt").html("Remove");
    $("#cart_btn").removeClass("cart-btn");
    $("#cart_btn").addClass("unCart-btn");
};

const displayRate = (data) => {
    let rate = parseInt(data[0]["avg_star"][0]["AVG(star)"]);
    switch (rate) {
        case 1:
            $(".star1").addClass("bi-star-fill");
            $(".star2, .star3, .star4, .star5").addClass("bi-star");
            break;
        case 2:
            $(".star1, .star2").addClass("bi-star-fill");
            $(".star3, .star4, .star5").addClass("bi-star");
            break;
        case 3:
            $(".star1, .star2, .star3").addClass("bi-star-fill");
            $(".star4, .star5").addClass("bi-star");
            break;
        case 4:
            $(".star1, .star2, .star3, .star4").addClass("bi-star-fill");
            $(".star5").addClass("bi-star");
            break;
        case 5:
            $(".star1, .star2, .star3, .star4, .star5").addClass("bi-star-fill");
            break;
    }
};

const displayComment = (comment) => {
    let html = `
    <div class="commentComponent">
        <div class="commentProfileImageArea">
            <img src="../src/image/profile-image.png" class="profileImg" />
        </div>
        <div class="commentTextArea">
            <div class="commentTextHead">
                <div class="commentUserName">
                    <h1>${comment["member_name"]}</h1>
                </div>
                <div class="commentTextRate">
                
    `;
    switch (comment["star"]) {
        case "1":
            html += `
                    <i class="bi bi-star-fill starDark"></i>
                    <i class="bi bi-star starDark"></i>
                    <i class="bi bi-star starDark"></i>
                    <i class="bi bi-star starDark"></i>
                    <i class="bi bi-star starDark"></i>
            `;
            break;
        case "2":
            html += `
                    <i class="bi bi-star-fill starDark"></i>
                    <i class="bi bi-star-fill starDark"></i>
                    <i class="bi bi-star starDark"></i>
                    <i class="bi bi-star starDark"></i>
                    <i class="bi bi-star starDark"></i>
            `;
            break;
        case "3":
            html += `
                    <i class="bi bi-star-fill starDark"></i>
                    <i class="bi bi-star-fill starDark"></i>
                    <i class="bi bi-star-fill starDark"></i>
                    <i class="bi bi-star starDark"></i>
                    <i class="bi bi-star starDark"></i>
            `;
            break;
        case "4":
            html += `
                    <i class="bi bi-star-fill starDark"></i>
                    <i class="bi bi-star-fill starDark"></i>
                    <i class="bi bi-star-fill starDark"></i>
                    <i class="bi bi-star-fill starDark"></i>
                    <i class="bi bi-star starDark"></i>
            `;
            break;
        case "5":
            html += `
                    <i class="bi bi-star-fill starDark"></i>
                    <i class="bi bi-star-fill starDark"></i>
                    <i class="bi bi-star-fill starDark"></i>
                    <i class="bi bi-star-fill starDark"></i>
                    <i class="bi bi-star-fill starDark"></i>
            `;
            break;
    }
    html += `
                </div>
            </div>
            <div class="commentTextBody">
                <p class="commentText">${comment["product_comment"]}</p>
            </div>
        </div>
    </div>
    `;
    $("#commentComponentArea").append(html);
};

const displayNoComment = () => {
    let html = `
    <h5 class="no-comment-text">There are no comments for this product yet.</h5>
    `;
    $("#commentComponentArea").append(html);
};

/* Ajax Function */
const searchProductById = (product_id) => {
    let data = {
        controller: "product",
        method: "searchProductById",
        parameter: {
            product_id: product_id,
        },
    };
    let json = JSON.stringify(data);
    $.ajax({
        url: "/CD-Book-Store-System/controller/core.php",
        method: "POST",
        data: json,
        success: (res) => {
            res ? displayData(res) : display404();
        },
    });
};

const searchProductByName = () => {
    let product_name = $("#text-1").val();
    let data = {
        controller: "product",
        method: "searchProductByName",
        parameter: {
            product_name: product_name,
        },
    };
    let json = JSON.stringify(data);
    $.ajax({
        url: "/CD-Book-Store-System/controller/core.php",
        method: "POST",
        data: json,
        success: (res) => console.log(res),
    });
};

const searchProductNum = () => {
    let product_id = $("#text-2").val();
    let data = {
        controller: "product",
        method: "searchProductNum",
        parameter: {
            product_id: product_id,
        },
    };
    let json = JSON.stringify(data);
    $.ajax({
        url: "/CD-Book-Store-System/controller/core.php",
        method: "POST",
        data: json,
        success: (res) => console.log(res),
    });
};

const updateProductNum = () => {
    let product_id = $("#text-3-1").val();
    let new_product_number = $("#text-3-2").val();
    let data = {
        controller: "product",
        method: "updateProductNum",
        parameter: {
            product_id: product_id,
            new_product_number: new_product_number,
        },
    };
    let json = JSON.stringify(data);
    $.ajax({
        url: "/CD-Book-Store-System/controller/core.php",
        method: "POST",
        data: json,
        success: (res) => console.log(res),
    });
};

const checkFollow = () => {
    let product_id = getUrl();
    let data = {
        controller: "followList",
        method: "isFollow",
        parameter: {
            product_id: product_id,
        },
    };
    let json = JSON.stringify(data);
    $.ajax({
        url: "/CD-Book-Store-System/controller/core.php",
        method: "POST",
        data: json,
        success: (res) => displayFollowBtn(res),
    });
};

const addToFollow = () => {
    let product_id = getUrl();
    let data = {
        controller: "followList",
        method: "insertFollowList",
        parameter: {
            product_id: product_id,
        },
    };
    let json = JSON.stringify(data);
    $.ajax({
        url: "/CD-Book-Store-System/controller/core.php",
        method: "POST",
        data: json,
    });
};

const removeFollow = () => {
    let product_id = getUrl();
    let data = {
        controller: "followList",
        method: "deleteFollowList",
        parameter: {
            product_id: product_id,
        },
    };
    let json = JSON.stringify(data);
    $.ajax({
        url: "/CD-Book-Store-System/controller/core.php",
        method: "POST",
        data: json,
    });
};

const checkCart = () => {
    let product_id = getUrl();
    let data = {
        controller: "cart",
        method: "isCart",
        parameter: {
            product_id: product_id,
        },
    };
    let json = JSON.stringify(data);
    $.ajax({
        url: "/CD-Book-Store-System/controller/core.php",
        method: "POST",
        data: json,
        success: (res) => displayCartBtn(res),
    });
};

const addToCart = () => {
    let product_id = getUrl();
    let data = {
        controller: "cart",
        method: "insertCart",
        parameter: {
            product_id: product_id,
        },
    };
    let json = JSON.stringify(data);
    $.ajax({
        url: "/CD-Book-Store-System/controller/core.php",
        method: "POST",
        data: json,
    });
};

const removeCart = () => {
    let product_id = getUrl();
    let data = {
        controller: "cart",
        method: "deleteCartByMIdPId",
        parameter: {
            product_id: product_id,
        },
    };
    let json = JSON.stringify(data);
    $.ajax({
        url: "/CD-Book-Store-System/controller/core.php",
        method: "POST",
        data: json,
    });
};

const createBrowsingHistory = () => {
    let product_id = getUrl();
    let data = {
        controller: "browserHistory",
        method: "insertBrowserHis",
        parameter: {
            product_id: product_id,
        },
    };
    let json = JSON.stringify(data);
    $.ajax({
        url: "/CD-Book-Store-System/controller/core.php",
        method: "POST",
        data: json,
    });
};

const searchComment = (product_id) => {
    let data = {
        controller: "commentList",
        method: "getCommentByProductId",
        parameter: {
            product_id: product_id,
        },
    };
    let json = JSON.stringify(data);
    $.ajax({
        url: "/CD-Book-Store-System/controller/core.php",
        method: "POST",
        data: json,
        success: (res) => {
            if (res != "") {
                res.forEach((element) => {
                    displayComment(element);
                });
            } else {
                displayNoComment();
            }
        },
    });
};
