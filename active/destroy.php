<?php
function destroy_session_and_data(){
    session_start();
    $_SESSION = [];
    session_unset();
    session_destroy();
    echo "Please <a href = ../login.php>click here </a> to log in.";
}
destroy_session_and_data();
?>