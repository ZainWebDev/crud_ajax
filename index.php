<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajax</title>
  </head>
  <body>
    <h1 style="background-color: #02DB87;height:50px;text-align: center;padding-top:20px;margin:0px;">Ajax Lesson No 2 </h1>
    <div style="background-color: #023B87;height:50px;text-align: center;padding-top:20px;margin:0px;">
      <form id="myform">
      <input type="text" id="name">  
     <input type="submit" id="save_data" value="SAVE DATA"> 
    </div>
    </form>
     
    <table id="table_data" style="text-align:center;margin:10px auto" border="1px" >
      
    </table>
   <div id="error" style="background:red;"></div>
    <div id="success" style="background:green;"></div>
    <script
    src="https://code.jquery.com/jquery-3.5.1.min.js"
    integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
    crossorigin="anonymous"></script>
    <script>
      $(document).ready(function(){
        function loadTable(){
          
          $.ajax({
            url:"load_data.php",
            type:"POST",
            success:function(data){
              $('#table_data').html(data);
            }
          });
       
        }
        loadTable();

        $("#save_data").on("click",function(e){
          e.preventDefault();
          var uname=$("#name").val();
          if (uname=="")
          {
           $("#error").html("Field is Empty").slideDown();
           $("#success").slideUp();
          }
        else{
          $.ajax({
            url: "save_data.php",
            type: "POST",
            data: {username: uname},
            success:function(data){
              
             if (data==1){
              loadTable();
              $("#myform").trigger("reset");
           $("#success").html("Data Updated").slideDown();
           $("#error").slideUp();
             
             }
             else
             {
            $("#error").html("Error in Updating Data").slideDown();
           $("#success").slideUp();
             }
            }
          });
          }
        });
      });
    </script>
  </body>
</html>