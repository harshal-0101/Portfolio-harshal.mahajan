

<?php

$server = 'localhost';
$name = 'root';
$password = "";
$database = "Portfolio_DB";

$conn = mysqli_connect($server,$name,$password,$database)or die("error");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize user inputs
    $senderName = mysqli_real_escape_string($conn, $_POST['senderName']);
    $email = mysqli_real_escape_string($conn, $_POST['Email']);
    $phoneNumber = mysqli_real_escape_string($conn, $_POST['PhoneNumber']);
    $service = mysqli_real_escape_string($conn, $_POST['serviceName']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    // Prepare and execute the SQL statement
    $sql = "INSERT INTO `user_message` (`Name`, `email`, `Phone_number`, `service`, `message`) VALUES (?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);
    
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sssss", $senderName, $email, $phoneNumber, $service, $message);
        
        if (mysqli_stmt_execute($stmt)) {
            $msg = "<p class='msg'>Your message was successfully sent</p>";
        } else {
            $msg = "<p class='msg'>Failed to send your message: " . mysqli_error($conn)."</p>";
        }
        
        mysqli_stmt_close($stmt);
    } else {
        $msg = "Failed to prepare the SQL statement: " . mysqli_error($conn);
    }

    mysqli_close($conn);

}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://kit.fontawesome.com/4238ddec9c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="portfolio.css">
    <script type="module" src="portfolio.js"></script>
</head>

<body>

    <div class="header">
        <div class="logo">
            <div class="color-div"></div>
            <div class="logo-name">PORTFOLIO</div>

            <div class="responsio-menu">
                <i id="Menu-btn" class="fa-solid fa-list-ul"></i>
            </div>
        </div>
        <div class="menu">
            <div id="moreOpion" class="option">
                <ul>
                    <li><a href="Portfolio.html"><i class="fa-solid fa-house"></i> HOME</a></li>
                    <li><a href="Project.html"><i class="fa-solid fa-circle-info"></i> ABOUT</a></li>
                    <li><a href="Project.html"><i class="fa-solid fa-code"></i> My Work</a></li>
                    <li><a href="Service.html"><i class="fa-solid fa-screwdriver-wrench"></i> SERVICE</a></li>
                    <li><a href="ContactUS.php"><i class="fa-solid fa-envelope"></i> CONTACT</a></li>
                </ul>

            </div>
            <!-- <div class="option-color"></div> -->
        </div>
    </div>



    <div class="container">
        <div class="contact-head">
            <div class="color1">

            </div>
            <div class="contact-info">
                <div class="text">
                    <h1>Contact Us</h1>
                    <p>go online and grow your bussanies with Us.</p>
                    <img src="images/ContactUsImg.jpg" alt="">
                </div>
                <div class="contact-form">
                    <form method="post">
                    <div class="messge">
                       <?php 
                         if (isset($_POST['submit']) && isset($_POST['senderName']) && isset($_POST['Email']) && isset($_POST['PhoneNumber']) && isset($_POST['serviceName']) && isset($_POST['message'])) {
                              if($msg){
                                  echo $msg;
                               }
                          }
                       ?>
                    </div>
                        <label for="name">
                         <i class="fa-solid fa-user"></i>
                         <input type="text" placeholder="UserName" required=""  name="senderName"><br>
                       </label>
                        <label for="Email">
                         <i class="fa-solid fa-envelope"></i>
                         <input type="text" placeholder="Email" required="" name="Email"><br>
                       </label>
                        <label for="PhoneNuber">
                         <i class="fa-solid fa-phone"></i>
                         <input type="text" placeholder="+91 00000 00000" required="" name="PhoneNumber"><br>
                       </label>

                        <label for="serviceNane">
                        <i class="fa-regular fa-object-group"></i> 
                        <select name="serviceName" id="servic-option" aria-placeholder="Select Servic">
                            <option value="not select">Select Servic </option>
                            <option value="Web Development">Web Development</option>
                            <option value="UI & UX Design">UI & UX Design</option>
                            <option value="Web Development">App Development</option>
                        </select><br>
                      </label>

                        <label for="Submit">
                        <textarea name="message" id="" rows="5"  placeholder="Meassage" required="" ></textarea><br>
                       </label><br>
                        <button class="Submit" type="submit" name="submit">Submit <i class="fa-solid fa-arrow-right-long"></i></button>
                    </form>
                </div>
                <div class="color2">

                </div>
            </div>
        </div>
    </div>
</body>

</html>


    <style>
        body {
            transition: 0.5s;
            margin: 10;
            padding: 0;
            background-color: black;
        }
        
        .container {
            margin-top: -40px;
            width: 100%;
            background-color: black;
        }
        
        .color1 {
            position: absolute;
            width: 300px;
            height: 300px;
            background-color: #763cac;
            border-radius: 100px;
            filter: blur(150px);
        }
        
        .contact-info {
            display: flex;
            max-width: 1300px;
            width: 100%;
            margin: auto;
        }
        
        .text {
            max-width: 650px;
            width: 100%;
            color: white;
        }
        
        .text h1 {
            font-size: 120px;
            margin-bottom: -30px;
        }
        
        .text p {
            font-size: 20px;
            margin-left: 20px;
        }
        
        .contact-form {
            position: relative;
            max-width: 650px;
            width: 100%;
            color: white;
            display: flex;
            margin: auto;
            justify-content: center;
            z-index: 2;
        }
        
        .contact-form form {
            max-width: 340px;
            width: 100%;
            align-self: center;
            background-color: rgba(255, 255, 255, 0.121);
            padding: 20px;
            border-radius: 25px;
            border: 1px solid #763cac;
        }
        
        .contact-form form label {
            display: flex;
            max-width: 300px;
            width: 100%;
            height: fit-content;
            font-size: 20px;
            border-radius: 25px;
            background-color: transparent;
            color: white;
            margin-top: 10px;
            border: 0;
            border: 1px solid #516DFF;
            font-family: 'Times New Roman', Times, serif;
            padding: 10px;
        }
        
        .fa-message {
            font-size: 25px;
        }
        
        .contact-form form label i {
            font-size: 20px;
            align-self: center;
        }
        
        .contact-form form input {
            max-width: 300px;
            width: 100%;
            font-size: 20px;
            border-radius: 25px;
            background-color: transparent;
            color: white;
            border: 0;
            padding: 5px;
        }
        
        #servic-option {
            transition: 1s;
            max-width: 300px;
            width: 100%;
            font-size: 20px;
            border-radius: 25px;
            background-color: transparent;
            color: white;
            border: 0;
            padding: 5px;
            color: white;
        }
        
        #servic-option option {
            transition: 1s;
            color: black;
            background-color: rgb(255, 255, 255);
        }
        
        .contact-form form input:focus {
            border: 0;
        }
        
        .contact-form form textarea {
            max-width: 280px;
            min-width: 280px;
            width: 100%;
            font-size: 25px;
            border-radius: 25px;
            background-color: transparent;
            padding: 10px;
            color: white;
            border: 0;
        }
        
        .contact-form form textarea::-webkit-scrollbar {
            display: none;
        }
        
        .Submit {
            transition: 0.5s;
            max-width: 150px;
            width: 100%;
            font-size: 25px;
            margin-top: 10px;
            border: 1px solid #516DFF;
            border-radius: 25px;
            background-color: #516DFF;
            color: white;
            padding: 5px;
            cursor: pointer;
        }
        
        .Submit:hover {
            transition: 0.5s;
            box-shadow: 2px 2px 10px 2px #763cac73;
            background-color: #1F1F1F;
            color: white;
            transform: translate(20px)
        }
        
        .Submit:hover i {
            transform: rotate(360deg)
        }
        
        .color2 {
            position: absolute;
            width: 350px;
            height: 350px;
            background-color: #1A00C1;
            right: 0;
            border-radius: 100px;
            filter: blur(200px);
            top: 50%;
            z-index: 1;
        }
        
        @media screen and (max-width: 890px) {
            .text h1 {
                font-size: 90px;
            }
            .text img {
                width: 300px;
            }
        }
        
        @media screen and (max-width: 550px) {
            .contact-info {
                display: block;
            }
            .text h1 {
                font-size: 60px;
            }
            .text p {
                font-size: 15px;
            }
            .text img {
                display: block;
                margin: auto;
            }
        }
.msg{
    max-width: 500px;
    width: 100%;
    margin:auto;
    color:green;
    border:1px solid white;
    padding:5px;
    border-radius: 25px;
    text-align: center;
}

    </style>