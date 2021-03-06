$(() => {
    /* Navbar */
    let memberRes = getMemberInfo();
    displayUserName(memberRes);
    /* Navbar End */
    selfIdentity = "member";
    otherIdentity = "cs";
    loadOrder();
    loadMsg();
    $("#send-btn").click(() => {
        createCsMessage();
        cleanInputBox();
    });
    $("#msg-content").keypress((e) => {
        code = e.keyCode ? e.keyCode : e.which;
        if (code == 13) {
            createCsMessage();
            cleanInputBox();
        }
    });
    setInterval(() => {
        loadUnreadMsg();
    }, 500);
});