<?php	
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "test";
            
            $trends = array();
            $i = 0;
            $whotofollow = array();
            $j = 0;

            $following = array();

            $user = array();

            $conn = mysqli_connect($servername, $username, $password, $dbname);
           
            if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
            }

            if(isset($_GET['del_follow'])){
                $id = $_GET['del_follow'];
                //mysqli_query($conn, "DELETE FROM whotofollow WHERE user_id='$id'");
                mysqli_query($conn, "INSERT INTO following (user_id) VALUES ('$id')");
                mysqli_query($conn, "UPDATE usersprofile SET following_number = following_number +1 WHERE id=1");
                header('location: following.php');
            }

            if(isset($_GET['del_following'])){
                $id = $_GET['del_following'];
                mysqli_query($conn, "DELETE FROM following WHERE user_id='$id'");
                mysqli_query($conn, "UPDATE usersprofile SET following_number = following_number -1 WHERE id=1");
                //mysqli_query($conn, "INSERT INTO whotofollow (user_id) VALUES ('$id')");
                header('location: following.php');
            }

            $sql = mysqli_query($conn, 'SELECT `title`, `subtitle`,`tweets` FROM `trends`');
            while ($row = mysqli_fetch_array($sql))
                {
                    $trends[$i]['title'] = $row['title'];
                    $trends[$i]['subtitle'] = $row['subtitle'];
                    $trends[$i]['tweets'] = $row['tweets'];
                    $i++;
                }
            
            try { 
                $sql1 = "SELECT usersprofile.full_name as name, 
                usersprofile.id as user_id,
                usersprofile.img as img, 
                usersprofile.username as username
                FROM usersprofile
                INNER JOIN whotofollow
                ON usersprofile.id = whotofollow.user_id";
               $result = mysqli_query($conn, $sql1); 
            } catch (mysqli_sql_exception $e) { 
               var_dump($e);
               exit; 
            } 

            while ($row = mysqli_fetch_array($result)) {
                    $whotofollow[$j]['user_id'] = $row['user_id'];
                    $whotofollow[$j]['name'] = $row['name'];
                    $whotofollow[$j]['img'] = $row['img'];
                    $whotofollow[$j]['username'] = $row['username'];
                    $j++;
                    if ($j==5) break;
                 }


            $sql2 = mysqli_query($conn, 'SELECT `full_name`, `username`,`img`,`joined_date`,`followers_number`,`following_number`,`tweets_number` FROM `usersprofile` WHERE `id`= 1');
            while ($row = mysqli_fetch_array($sql2))
                {
                    $user[0]['full_name'] = $row['full_name'];
                    $user[0]['username'] = $row['username'];
                    $user[0]['img'] = $row['img'];
                    $user[0]['joined_date'] = $row['joined_date'];
                    $user[0]['followers_number'] = $row['followers_number'];
                    $user[0]['following_number'] = $row['following_number'];
                    $user[0]['tweets_number'] = $row['tweets_number'];
                }

            try { 
                $sql3 = "SELECT usersprofile.full_name as name, 
                usersprofile.id as user_id, 
                usersprofile.img as img, 
                usersprofile.username as username,
                usersprofile.description as description
                FROM usersprofile
                INNER JOIN following
                ON usersprofile.id = following.user_id";
               $result = mysqli_query($conn, $sql3); 
            } catch (mysqli_sql_exception $e) { 
               var_dump($e);
               exit; 
            } 

            $j = 0;
            while ($row = mysqli_fetch_array($result)) {
                    $following[$j]['user_id'] = $row['user_id'];
                    $following[$j]['name'] = $row['name'];
                    $following[$j]['img'] = $row['img'];
                    $following[$j]['username'] = $row['username'];
                    $following[$j]['description'] = $row['description'];
                    $j++;
                 }


            $conn->close();
            
            ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="profile.css">
        <link rel="icon" href="https://pngimg.com/uploads/twitter/small/twitter_PNG3.png">
        <title>Twitter</title>
    </head>
    <body>
        <div id="menu">
            
            <div class="logo"><a href="home.php"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/4f/Twitter-logo.svg/2491px-Twitter-logo.svg.png" width="30px"></a></div>
            
            <div class="menu-item"><a href="home.php"><img src="https://raw.githubusercontent.com/monsterlessonsacademy/monsterlessonsacademy/e677aae424559c05e20f1a3f7d8f89a6680f448a/svg/home.svg" class="icons">Home</a></div>
            <div class="menu-item"><a href="explore.html"><img src="https://raw.githubusercontent.com/monsterlessonsacademy/monsterlessonsacademy/e677aae424559c05e20f1a3f7d8f89a6680f448a/svg/explore.svg" class="icons">Explore</a></div>
            <div class="menu-item"><a href="notifications.html"><img src="https://raw.githubusercontent.com/monsterlessonsacademy/monsterlessonsacademy/e677aae424559c05e20f1a3f7d8f89a6680f448a/svg/notifications.svg" class="icons">Notifications</a></div>
            <div class="menu-item"><a href="messages.html"><img src="https://raw.githubusercontent.com/monsterlessonsacademy/monsterlessonsacademy/e677aae424559c05e20f1a3f7d8f89a6680f448a/svg/messages.svg" class="icons">Messages</a></div>
            <div class="menu-item"><a href="bookmarks.html"><img src="https://cdn-icons-png.flaticon.com/512/2956/2956783.png" class="icons">Bookmarks</a></div>
            <div class="menu-item"><a href="lists.php"><img src="https://cdn-icons-png.flaticon.com/512/2040/2040523.png" class="icons">Lists</a></div>
            <div class="menu-item"><a href="profile.php"><img src="https://raw.githubusercontent.com/monsterlessonsacademy/monsterlessonsacademy/e677aae424559c05e20f1a3f7d8f89a6680f448a/svg/profile.svg" class="icons"><b>Profile</b></a></div>
            <div class="menu-item"><a href="more.php"><img src="https://raw.githubusercontent.com/monsterlessonsacademy/monsterlessonsacademy/e677aae424559c05e20f1a3f7d8f89a6680f448a/svg/more.svg" class="icons">More</a></div>
            
            <button id="tweet">Tweet</button>

            <div class="user">
                    <?php echo '<img src='.$user[0]['img'].' align="left" width="30">'; ?>
                    <img src="https://cdn-icons-png.flaticon.com/512/2311/2311523.png" align="right" width="20">
                    <b><?php echo $user[0]['full_name'];?></b>
                    <br><span class="gray">@<?php echo $user[0]['username'];?></span>
                   
               </div>
        </div>

        <div id="main">
            <div class="fixed-title">
                <div class="back"><a href="profile.php"><img src="https://cdn-icons-png.flaticon.com/512/3114/3114883.png" width="20px"></a></div>
                <p><span id="topics">
                    <?php echo $user[0]['full_name'];?>
                </span>
                <br><span class="gray">@<?php echo $user[0]['username'];?></span></p>

            </div>

            <div class="moving">

            <div class="follow-part">Followers<br><br></div>
            <div class="follow-part"><b>Following</b><hr color="DeepSkyBlue" width="70" size="3"></div>
            
            <hr color="Gainsboro" size="1">
            

            <div>

                <?php foreach($following as $item): ?>
                <div class="follower-item">
                <?php echo '<img src='.$item['img'].'align="left" width="45">';?>
                <a href="following.php?del_following=<?php echo $item['user_id']; ?>">
                <button id="unfollow">Following</button></a>
                <b><a href="userprofile.php?following_id=<?php echo $item['user_id']; ?>">
                <?php echo $item['name'];?></a>
                </b><br><span class="gray">
                <?php echo '@'.$item['username'].'';?>
                </span><br><?php echo $item['description']; ?></div> 
                <?php endforeach; ?>

        
            </div>

            </div>
        </div>

        <div id="right">
            <div class="input"><img src="https://cdn-icons-png.flaticon.com/512/126/126474.png" width="15px"><input type="text" placeholder="Search Twitter"></div>

        <div class="trends">

        <h3>Trends for you</h3>

        <?php foreach($trends as $item): ?>
            <div class="trends-item"><span class="gray"><?php echo $item['subtitle'];?>
            </span><img src="https://cdn-icons-png.flaticon.com/512/2311/2311523.png"><br>
            <b><?php echo $item['title'];?></b>
            <br><span class="gray">
            <?php 
             if ($item['tweets']>0){echo ''.$item['tweets'].'  Tweets';}
            ?>
            </span>
            </div>
            <?php endforeach; ?>

            <div class="trends-item">
                <span class="show-more">Show more</span>
            </div>

        </div>
    
        <div class="follow">

        <h3>Who to follow</h3>
            <?php foreach($whotofollow as $item): ?>
            <div class="follower">
            <?php echo '<img src='.$item['img'].'align="left" width="40">';?>

            <?php 

            $conn = mysqli_connect($servername, $username, $password, $dbname);

            $follow_id = $item['user_id'];

            $sql = mysqli_query($conn, "SELECT id FROM following WHERE user_id=$follow_id");
            $isfollowed = $sql->fetch_row();
                
            $item_id = $item['user_id'];

                if ((bool)$isfollowed){
                    echo "<a href=\"following.php?del_following=$item_id\">";
                    echo "<button id=\"unfollow-button\">Following</button></a>";
                }
                else {
                    echo "<a href=\"following.php?del_follow=$item_id\">";
                    echo "<button id=\"follow\">Follow</button></a>";
                }
            
            $conn->close();
            ?>

            <b><a href="userprofile.php?following_id=<?php echo $item['user_id']; ?>">
            <?php echo $item['name'];?></a>
            </b><br><span class="gray">
            <?php echo '@'.$item['username'].'';?>
            </span> </div> 
            <?php endforeach; ?>

            <div class="follower">
                <span class="show-more">Show more</span>
            </div>

        </div>


        </div>

    </body>
</html>