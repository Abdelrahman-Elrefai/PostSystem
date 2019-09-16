<?php
include_once('dbconn.php');     #include db connection
/*variables*/
$user = $_REQUEST['u'];         /*user who wrote the post*/
$post = $_REQUEST['p'];         /*the post*/
$updpost = $_REQUEST['up'];     #the post text after updating it
$reqType = $_REQUEST['req'];    /*the request type*/
$id = $_REQUEST['id'];
/*if statments*/
if($reqType == 'add')
    $insert = mysqli_query($conn , "insert into post(user,text) values ('$user','$post') ");
    #excute insert query

if($reqType == 'delete')
    $delete = mysqli_query($conn , "delete from post where id = $id");
    #excute delete query

if($reqType == 'edit')
    $update = mysqli_query($conn , "update post set text = '$updpost' where id = $id");
    #excute update query
/*show all records*/
$select = mysqli_query($conn , "select * from post order by id desc"); 
#excute select query
#tip : make select the last query

while ($rows = mysqli_fetch_assoc($select))
{
?>


<article class="container">
    <div class="col-8 d-block mx-auto my-5 bg-white card card-x">
        <div class="card-header">
            <p class="lead"><?php echo $rows['user']; ?></p>
            <!--show the user-->
            <small class="d-block ml-3"><i class="far fa-clock mr-2"></i><?php echo $rows['time'] ?></small>
            <div class="ico">
                <!--show the time-->
                <i class="fas ml-2 fa-edit editt" data-id="<?php echo $rows['id'] ?>" data-toggle="modal" data-target="#exampleModalCenter"></i> <!--we used custom attr named data-id to send id-->
                <i class="fas ml-2 fa-trash" onclick="post('delete','<?php echo $rows['id'] ?>')"></i>
            </div>
            <!--icons-->
        </div>
        <!--card's head -->
        <div class="card-body">
            <p id="postpara" style="font-size:18px;"><?php echo $rows['text'];?></p>
            
            <!--show the post text-->
        </div>
        <!--card's body -->
    </div>
    <!--card's -->
</article>
<!--container's  -->
<?php 
}                                                                           #close the while loop

?>