<body>
    <form method="post">
        <label>U: <input name="username" /></label>
        <label>P: <input type="password" name="password" /></label>
        <input type="submit" value="log in">
    </form>
    <?php //ANYONE READING THIS: I GAVE UP ON THIS AND DIDN'T IMPLEMENT IN PRODUCTION. The actual authentication method is not on github.
        if('kikoboss' == filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING) && '21f0daa379f2a205a80fb086a957af7aaaf31c4545d72e10aa79b3527b940fd4' == hash('sha256', filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING))) {
            $_SESSION['loggedin'] = true;
        } ?>
</body>