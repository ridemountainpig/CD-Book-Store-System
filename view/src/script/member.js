// $('#submitBtn').click();
function login() {
    let email = $('#email').val();
    let member_password = $('#member_password').val();
    let data = {
        controller: 'member',
        method: 'login',
        parameter: {
            email: email,
            member_password: member_password
        }
    };
    let json = JSON.stringify(data);
    $.ajax({
        url: '/CD-Book-Store-System/controller/core.php',
        method: 'POST',
        data: json,
        success: res => {
            if (res) {
                // 登入成功
                $url = "/CD-Book-Store-System/view/";
                window.location.href = $url;
            } else {
                // 帳號密碼錯誤登入失敗
                $('#modal').modal('show');
            }
        }
    });
}

$("#member_password").keypress((e) => {
    code = e.keyCode ? e.keyCode : e.which;
    if (code == 13) {
        login();
    }
});

function logout() {
    let data = {
        controller: 'member',
        method: 'logout'
    };
    let json = JSON.stringify(data);
    $.ajax({
        url: '/CD-Book-Store-System/controller/core.php',
        method: 'POST',
        data: json,
        success: res => {
            // 登出
        }
    });
}

const displayUserName = (data) => {
    let member_name = data[0]['member_name'];
    $(".username-nav-item").append(`<button class="navbar_btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="bi bi-person-fill mx-2"></i>${member_name}</button>`);
    $(".username-offcanvas-header").append(`<h4 class="offcanvas-title" id="offcanvasRightLabel"><i class="bi bi-person-fill mx-3"></i>${member_name}</h4>`);
}



function register() {
    let email = $('#email').val();
    let member_password = $('#member_password').val();
    let member_name = $('#member_name').val();
    let birthday = $('#birthday').val();
    let phone_num = $('#phone_num').val();
    let credit_num = '100';

    let sex = []
    let checkboxes = document.querySelectorAll('input[type=checkbox]:checked')
    for (let i = 0; i < checkboxes.length; i++) {
        sex.push(checkboxes[i].value)
    }

    if (email == '' || member_password == '' || member_name == '' || birthday == '' || phone_num == '' || credit_num == '' || sex.length == 0) {
        $('#modalError').modal('show');
        return;
    }

    if (member_name.length > 100) {
        $('#modalNameError').modal('show');
        return;
    }

    if (phone_num.length > 10) {
        $('#modalPhoneError').modal('show');
        return;
    }

    if (member_password.length > 100) {
        $('#modalPasswordError').modal('show');
        return;
    }

    if (sex.length == 2) {
        $('#modalSex').modal('show');
        return;
    }

    let data = {
        controller: 'member',
        method: 'register',
        parameter: {
            email: email,
            member_password: member_password,
            member_name: member_name,
            birthday: birthday,
            phone_num: phone_num,
            sex: sex[0],
            credit_num: credit_num
        }
    };
    let json = JSON.stringify(data);
    $.ajax({
        url: '/CD-Book-Store-System/controller/core.php',
        method: 'POST',
        data: json,
        success: res => {
            if (res) {
                // 註冊成功
                $('#modalSuccess').modal('show');
            } else {
                // email重複註冊失敗
                $('#modalEmailSame').modal('show');
            }
        }
    });
}

function forgetPassword() {
    let email = $('#email').val();

    let data = {
        controller: 'member',
        method: 'forgetPassword',
        parameter: {
            email: email
        }
    };
    let json = JSON.stringify(data);
    $.ajax({
        url: '/CD-Book-Store-System/controller/core.php',
        method: 'POST',
        data: json,
        success: res => {
            console.log(res);
            if (!res) {
                // 無此email
                $('#modalNoMail').modal('show');
            } else {
                $('#modalSendMail').modal('show');
            }
        }
    });
}

function confirm() {
    let email = $('#email').val();
    let confirmNumber = $('#confirmNumber').val();

    if (email == '' || confirmNumber == '') {
        $('#error').modal('show');
    }

    let data = {
        controller: 'member',
        method: 'confirm',
        parameter: {
            email: email,
            confirmNumber: confirmNumber
        }
    };
    let json = JSON.stringify(data);
    $.ajax({
        url: '/CD-Book-Store-System/controller/core.php',
        method: 'POST',
        data: json,
        success: res => {
            console.log(res);
            if (res) {
                // 驗證碼正確
                window.location.replace(`/CD-Book-Store-System/view/resetPassword/index.html?email=${email}&confirm=${confirmNumber}`);
            } else {
                // 驗證碼錯誤
                $('#modalConfirmWrong').modal('show');
            }
        }
    });
}

function confirmResetPage() {
    let url_string = window.location.href;
    let url = new URL(url_string);
    let email = url.searchParams.get('email');
    let confirmNumber = url.searchParams.get('confirm');

    let data = {
        controller: 'member',
        method: 'emailExist',
        parameter: {
            email: email
        }
    };
    let json = JSON.stringify(data);
    $.ajax({
        url: '/CD-Book-Store-System/controller/core.php',
        method: 'POST',
        data: json,
        success: res => {
            if (res) {
                window.location.replace("/CD-Book-Store-System/view/404");
            }
        }
    });

    let data1 = {
        controller: 'member',
        method: 'getConfirmNumber',
        parameter: {
            email: email
        }
    };
    let json1 = JSON.stringify(data1);
    $.ajax({
        url: '/CD-Book-Store-System/controller/core.php',
        method: 'POST',
        data: json1,
        success: res => {
            if (res != confirmNumber) {
                window.location.replace("/CD-Book-Store-System/view/404");
            }
        }
    });
}

function resetPassword() {
    let new_password = $('#new_password').val();
    let confirm_password = $('#confirm_password').val();
    
    let url_string = window.location.href;
    let url = new URL(url_string);
    let email = url.searchParams.get('email');
    let confirmNumber = url.searchParams.get('confirm');

    if (new_password.localeCompare(confirm_password) == 0) {
        let data = {
            controller: 'member',
            method: 'resetPassword',
            parameter: {
                new_password: new_password,
                email: email
            }
        };
        let json = JSON.stringify(data);
        $.ajax({
            url: '/CD-Book-Store-System/controller/core.php',
            method: 'POST',
            data: json,
            success: res => {
                if (res) {
                    // 重置密碼成功
                    $('#modalSuccess').modal('show');
                }
            }
        });
    } else {
        // 兩個新密碼不相同
        $('#modalNotSame').modal('show');
    }
}

function updateMemberInfo() {
    let member_name = $('#member_name').val();
    let birthday = $('#birthday').val();
    let phone_num = $('#phone_num').val();
    let member_password = $('#member_password').val();

    let sex = []
    let checkboxes = document.querySelectorAll('input[type=checkbox]:checked')
    for (let i = 0; i < checkboxes.length; i++) {
        sex.push(checkboxes[i].value)
    }

    if (member_password == '' || member_name == '' || birthday == '' || phone_num == '' || sex.length == 0) {
        $('#modalError').modal('show');
        return;
    }

    if (member_name.length > 100) {
        $('#modalNameError').modal('show');
        return;
    }

    if (phone_num.length > 10) {
        $('#modalPhoneError').modal('show');
        return;
    }

    if (member_password.length > 100) {
        $('#modalPasswordError').modal('show');
        return;
    }

    if (sex.length == 2) {
        $('#modalSex').modal('show');
        return;
    }

    let data = {
        controller: 'member',
        method: 'updateMemberInfo',
        parameter: {
            member_name: member_name,
            birthday: birthday,
            phone_num: phone_num,
            sex: sex[0],
            member_password: member_password
        }
    };
    console.log(data);
    let json = JSON.stringify(data);
    $.ajax({
        url: '/CD-Book-Store-System/controller/core.php',
        method: 'POST',
        data: json,
        success: res => {
            // 更改成功
            $('#modalSuccess').modal('show');
        }
    });
}

function getMemberInfo() {
    let data = {
        controller: 'member',
        method: 'getMemberInfo',
    };
    let json = JSON.stringify(data);
    $.ajax({
        url: '/CD-Book-Store-System/controller/core.php',
        method: 'POST',
        data: json,
        async: false,
        success: res => {
            result = res;
        }
    });
    return result;
}

function getMemberInfoById() {

    let data = {
        controller: 'member',
        method: 'getMemberInfoById'
    };
    let json = JSON.stringify(data);
    $.ajax({
        url: '/CD-Book-Store-System/controller/core.php',
        method: 'POST',
        data: json,
        success: res => {
            // console.log(res);
            $('#member_name').val(res[0]['member_name']);
            $(`#${res[0]['sex']}`).prop('checked', true);
            $('#phone_num').val(res[0]['phone_num']);
            $('#birthday').val(res[0]['birthday']);
        }
    });
}

function getMemberAccountById() {

    let data = {
        controller: 'member',
        method: 'getMemberAccountById'
    };
    let json = JSON.stringify(data);
    $.ajax({
        url: '/CD-Book-Store-System/controller/core.php',
        method: 'POST',
        data: json,
        success: res => {
            // console.log(res);
            $('#member_password').val(res[0]['member_password']);
        }
    });
}

function getMemberCredit() {
    let data = {
        controller: 'member',
        method: 'getMemberCredit',
    };
    let json = JSON.stringify(data);
    $.ajax({
        url: '/CD-Book-Store-System/controller/core.php',
        method: 'POST',
        data: json,
        success: res => {
            console.log(res);
        }
    });
}