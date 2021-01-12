<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajax</title>
    <link rel="stylesheet" href="style.css">
 
  </head>
  <body>
    <h1 style="background-color: #02DB87;height:50px;text-align: center;padding-top:20px;margin:0px;">Ajax Lesson No 2 </h1>
    <div style="background-color: #023B87;height:50px;text-align: center;padding-top:20px;margin:0px;">
      <form id="myform">
      <input type="text" id="name">  
     <input type="submit" id="save_data" value="SAVE DATA"> 
   
    </form>
      </div>
    <table id="table_data" style="text-align:center;margin:10px auto" border="1px" >
      
    </table>
   <div id="error"></div>
    <div id="success"></div>
    <div class="modal">
      <div class="modal_form">
        <h2>Edit</h2>
        <form id="edit_form">
        
        <label>Name</label><br>
        <input type="text" id="ename"> <br> 
         
        <button id="btn_update">Update</button>
        </form>
        <button id="btn_close">X</button>
      </div>
    </div>
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
        $(document).on("click",".delete_btn",function(){
          if (confirm("Delete Data?"))
          {
          var element=this;
          var userId=$(element).data("id");
          $.ajax({
          url:"delete_ajax.php",
          type:"POST",
          data:{id:userId}, 
          success:function(data){
          if (data==1)
          {
            $(element).closest("tr").fadeOut();
            $("#success").html("Data Deleted").slideDown();
            $("#error").slideUp();
          }
          else
          {
          $("#error").html("Error in Deleting Data").slideDown();
          $("#success").slideUp();

          }  
          } 
          });
        }
        
        });
        $(document).on("click",".edit_btn",function(){
          $(".modal").show();
          //get data from db into from
          var eid=$(this).data("eid");
          $.ajax({
            url:"get_form_update.php",
            type:"POST",
            data:{id:eid},
            success:function(data){
              $("#edit_form").html(data);

            }
          });

        });
        //close modal
        $("#btn_close").on("click",function(){
           $(".modal").hide(); 
          });
        $(document).on("click","#btn_update",function(){
           var userid= $(this).data("uid");
           var username=$("#ename").val();
          
           $.ajax({
            url:"update.php",
            type:"POST",
            data:{userid:userid,username:username},
            success:function(data){
            loadTable();
            if (data==1)
            {
            
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
          });

  
      });
    </script>
  </body>
</html>