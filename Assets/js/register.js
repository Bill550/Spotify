$(document).ready(function(){
    $("#hideLogin").click(function(){
        console.log("Login Was Pressed");
        $("#LoginForm").hide();
        $("#RegisterForm").show();
    });

    $("#hideRegister").click(function () {
        console.log("Register Was Pressed");
        $("#LoginForm").show();
        $("#RegisterForm").hide();
    });
});