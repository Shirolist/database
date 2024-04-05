<html>
<head>
    <title>Live Search for admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container" style="max-width: 50%;">
    <input type="submit" value="Change to Product" onclick="location.href='livesearch_index.php'">
    <input type="submit" value="Change to Update/Delete User Information" onclick="location.href='crud_index.php'">
    <input type="submit" value="logout" onclick="location.href='active/destroy.php'">
        <div class="text-center mt-5 mb-4">
            <h1>Live Search for User</h1>
        </div>

        <input type="text" class = "form-control" id="live_search" autocomplete="off" placeholder="Search...">

    </div>

    <div id="searchresult"></div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script type ="text/javascript">
        $(document).ready(function()
        {
            $("#live_search").keyup(function()
            {
                var input = $(this).val();
                //alert(input)
                if(input != "")
                {
                    $.ajax(
                    {
                        url:"livesearch_User.php",
                        method:"POST",
                        data:{input:input},

                        success:function(data)
                        {
                            $("#searchresult").html(data);
                        }
                    });
                } else
                {
                    $("searchresult").css("display","none");
                }
            }
                );
        })
    </script>    
</body>
<html>