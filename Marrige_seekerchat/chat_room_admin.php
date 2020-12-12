<?php
require_once __DIR__ . '/../db_config.php';
require_once __DIR__ . '/Chat_session.php';
$current_date= date("Y-m-d H:i:s");
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Inbox</title>
    <script src="jquery.js"></script>
  <script type="text/javascript" src="formscript1.js"></script>
    <!-- Bootstrap CSS-->
    <link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="css/theme3.css" rel="stylesheet" media="all">
<style>
body {font-family: Arial, Helvetica, sans-serif;}
* {box-sizing: border-box;}

/* Button used to open the chat form - fixed at the bottom of the page */
.open-button {
  background-color: #555;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  position: fixed;
  bottom: 23px;
  right: 28px;
  width: 280px;
}

/* The popup chat - hidden by default */
.chat-popup {
  display: none;
  position: fixed;
  bottom: 0;
  right: 15px;
  border: 3px solid #f1f1f1;
  z-index: 9;
}

/* Add styles to the form container */
.form-container {
  max-width: 300px;
  padding: 10px;
  background-color: white;
}

/* Full-width textarea */
.form-container textarea {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
  resize: none;
  min-height: 200px;
}

/* When the textarea gets focus, do something */
.form-container textarea:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit/send button */
.form-container .btn {
  background-color: #4CAF50;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}
  input[type=text] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  box-sizing: border-box;
}
</style>
</head>
<body>

<button class="open-button" onclick="openForm()">Chat</button>
<div class="chat-popup" id="myForm">
<?php
$current_date= date("Y-m-d H:i:s");
$session=session_id();
		$conversation = "SELECT * FROM user_chat_room " ;
        $conversation_result = mysqli_query($con,$conversation ) or die("<b>Error:</b> <br/>" . mysqli_error($con));
			?>
  <form name='form' id="chatForm" class="form-container">
    <h3>Chat Room</h3>
	
                           <div class="au-chat__content">
						   	<?php while($conversation_row  = mysqli_fetch_array($conversation_result)) 
						     { 
								 ?>
	                        <div class="recei-mess-wrap">
                                <div class="recei-mess__inner">
								<?php
			                 if(($conversation_row["sender"]=="yeshanew.al387@yahoo") and ($conversation_row["receiver"]==$session))
								{								
	                              echo'<div class="send-mess-list">';
                                   echo'<div class="recei-mess">'.$conversation_row["message"].'</div>';
									echo'<span class="mess-time">'.$conversation_row["date"].'</span>';
                                    echo'</div>
                                     </div>';
					        			}
                                     echo'</div>';
                                          ?>
                                      <div class="send-mess-wrap">                                            
                                      <div class="send-mess__inner">
									    <?php if(($conversation_row["sender"]==$session) and ($conversation_row["receiver"]=="yeshanew.ale387@yahoo"))
														{								
                                       echo'<div class="send-mess-list">';
										echo'<div class="recei-mess">'.$conversation_row["message"].'</div>';
								        echo' <br><span class="mess-time">'.$conversation_row["date"].'</span>';   
                                         echo'</div>
                                          </div>';
					        			}
                                     echo'</div>';
										  }
										   ?>
                                            
   
   
    <input type="text"  placeholder="Type message.." id="msg" name="msg" required>

	   <input id="submit" class="btn" onclick="formsubmit()" type="button" value="Send">
    <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
  </form>
</div>
<script>

function openForm() {
  document.getElementById("myForm").style.display = "block";
}
/*     //<button type="button" name="send" class="btn"  onclick="sendMessage()">Send</button>
function sendMessage() {
  document.getElementById("myForm").style.display = "block";
}*/
function closeForm() {
  document.getElementById("myForm").style.display = "none";
}

</script>

</body>
</html>
