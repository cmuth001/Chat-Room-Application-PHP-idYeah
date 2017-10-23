<!DOCTYPE html>
<html>
<style>
.formDiv{
    width: 50%;
    margin: auto;
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
}
h2{
    text-align: center;
}
/* Full-width input fields */
.inputfield{
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
    border-radius: .5em;
}

/* Set a style for all buttons */
button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}

/* Extra styles for the cancel button */
.cancelbtn {
    padding: 14px 20px;
    background-color: #f44336;
}

/* Float cancel and signup buttons and add an equal width */
.signupbtn {
    float: left;

}

/* Add padding to container elements */
.container {
    padding: 16px;
}

/* Clear floats */
.clearfix::after {
    content: "";
    clear: both;
    display: table;
}

/* Change styles for cancel button and signup button on extra small screens */
@media screen and (max-width: 300px) {
     .signupbtn {
       width: 100%;
    }
}
</style>
<body>


<div class = "formDiv">
    <h2>Slack Signup Form</h2>
    <form action="" method = "post"style="border:1px solid #ccc">
      <div class="container">
        <label><b>Email</b></label>
        <input type="text" class = "inputfield"placeholder="Enter Email" name="email" autofocus required>
        <label><b>User Name</b></label>
        <input type="text" class = "inputfield"placeholder="Enter User Name" name="userName" autofocus required>
        <label><b>Password</b></label>
        <input type="password" class = "inputfield" placeholder="Enter Password" name="psw" required>

        <label><b>Repeat Password</b></label>
        <input type="password" class = "inputfield" placeholder="Repeat Password" name="pswRepeat" required>
        <input type="checkbox" checked="checked"> Remember me
        

        <div class="clearfix">
          <button type="submit" class="signupbtn">Sign Up</button>
        </div>
      </div>
    </form>
</div>

</body>
</html>
