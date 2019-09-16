<?php
include ('dbconn.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!--bootstrap-->
    <link rel="stylesheet" href="css/fontawsome.css" />
    <!--fontawsome-->
    <link rel="stylesheet" href="css/style.css" />
    <!--mainstyle-->
    <title>Post System</title>
</head>

<body onload="post()">
    <?php 

        if(!$conn)
            die("<h1 class='display1 text-center mt-5 text-white'>Can't Connect<h1>");
        #we but it here to have bootstrap characterstics

    ?>
    <h1 class="display-4 text-center mt-5 text-white">Best Post System</h1>
    <section class="container">
        <div class="col-8 d-block mx-auto mt-5 bg-white card">
            <div class="card-header font-weight-bold">
                <p class="lead">Create A Post</p>
            </div>
            <div class="card-body">
                <form>
                    <div class="form-group">
                        <label class="form-control-placeholder" for="txt-area">Write Something :</label>
                        <textarea onkeyup="actbtn()" class="form-control" id="txtarea" rows="3"></textarea>
                    </div>
                </form>
                <button id="postbtn" class="btn btn-info px-4 py-2" onclick="post('add','')" disabled>POST</button>


            </div>
        </div>
    </section>
    <section id="posts-container">



    </section>
    <!--EOF POSTS CONTAINER-->
    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Edit Post</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div><!--eof modal header-->
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label class="form-control-placeholder" for="edit-area">Edit Your Post :</label>
                            <textarea onkeyup="actbtn()" class="form-control editclss" id="editarea" rows="3"></textarea>
                            <input type="text" id="post-id" hidden>
                        </div>
                    </form>
                </div><!--Eof modal form -->
                <div class="modal-footer">
                    <button id="editbtn" class="btn btn-info" onclick="post('edit')" data-toggle="modal" data-target="#exampleModalCenter" disabled>Edit</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div><!--eof modal footer-->
            </div>
        </div>
    </div>
    <!--EOF MODAL-->

    <script src="js/all.js"></script>
    <!--font-awsome-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!--jquery-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <!--propper.js-->
    <script src="js/bootstrap.min.js"></script>
    <!--bootstrap-->
    <script>
    $(document).ready(function (){
           $("#posts-container").on("click",".editt",function () {
            //$(this).hide();   this is the icon
               $("#editarea").val( $(this).parents(".card-header").siblings(".card-body").children('#postpara').text());
               $("#post-id").val($(this).data("id"));   /*I don't understand this */
               $('#exampleModalCenter').modal('dispose');
           })
        });    
    </script>
    <script>
        
        function post(reqType = '', id = '') {
            /* make default parameters*/
            var xhr = new XMLHttpRequest(); /*new xml http request variable*/
            var user = "Abdelrahman"; /*this is fixed user no good practice*/
            var postText = document.getElementById('txtarea').value; /*txt area value*/
            var updPost = ''; /*updatted post*/
            /* if (edittedPost == udefined ||edittedPost == null){
                 edittedPost = '';
             }*/

            if (reqType == 'delete') 
            {
                var ans = window.confirm("Are You Sure ?");
                if (ans == false)
                    id = '';
            }
            else if (reqType == 'edit')
            {
                updPost = document.getElementById('editarea').value;
                id = document.getElementById('post-id').value;
                
            }
            xhr.onreadystatechange = function() {
                /*check to see if connected*/
                if (xhr.readyState == 4 && xhr.status == 200) {
                    document.getElementById("posts-container").innerHTML = xhr.responseText;
                    document.getElementById('txtarea').value = "";
                }
            }

            /*open connection*/
            xhr.open("get", "post-server.php?req=" + reqType + "&u=" + user + "&p=" + postText +"&up="+updPost+ "&id=" + id, true);
            //xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); /*needed for post method*/

            xhr.send();
            /*send the request*/

        }



        function actbtn() {
            /*this func is for the click when text area is empty!!*/
            var txt = document.getElementById("txtarea").value;
            var txt1 = document.getElementById("editarea").value;

            /*this is for txt area*/
            if (txt == "")
                document.getElementById("postbtn").disabled = true;
            else
                document.getElementById("postbtn").disabled = false;
            /*this is for edit area*/
            if (txt1 == "")
                document.getElementById("editbtn").disabled = true;
            else
                document.getElementById("editbtn").disabled = false;
        }
    </script>
</body>

</html>