<?php	
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "test";
            
            $trends = array();
            $i = 0;
            $whotofollow = array();
            $j = 0;

            $conn = mysqli_connect($servername, $username, $password, $dbname);
           
            if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
            }

            if(isset($_GET['del_follow'])){
                $id = $_GET['del_follow'];
                //mysqli_query($conn, "DELETE FROM whotofollow WHERE user_id='$id'");
                mysqli_query($conn, "UPDATE usersprofile SET following_number = following_number +1 WHERE id=1");
                mysqli_query($conn, "INSERT INTO following (user_id) VALUES ('$id')");
                header('location: home.php');
            }

            if(isset($_GET['del_following'])){
                $id = $_GET['del_following'];
                mysqli_query($conn, "DELETE FROM following WHERE user_id='$id'");
                mysqli_query($conn, "UPDATE usersprofile SET following_number = following_number -1 WHERE id=1");
                //mysqli_query($conn, "INSERT INTO whotofollow (user_id) VALUES ('$id')");
                header('location: home.php');
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
                    usersprofile.username as username,
                    usersprofile.description as description
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
                        $whotofollow[$j]['description'] = $row['description'];
                        $whotofollow[$j]['name'] = $row['name'];
                        $whotofollow[$j]['img'] = $row['img'];
                        $whotofollow[$j]['username'] = $row['username'];
                        $j++;
                        if ($j==5) break;
                     }

                $myuser = array();

            $sql2 = mysqli_query($conn, "SELECT full_name, username,img,joined_date,followers_number,following_number,tweets_number FROM usersprofile WHERE id= 1");
            while ($row = mysqli_fetch_array($sql2))
                {
                    $myuser[0]['full_name'] = $row['full_name'];
                    $myuser[0]['username'] = $row['username'];
                    $myuser[0]['img'] = $row['img'];
                    $myuser[0]['joined_date'] = $row['joined_date'];
                    $myuser[0]['followers_number'] = $row['followers_number'];
                    $myuser[0]['following_number'] = $row['following_number'];
                    $myuser[0]['tweets_number'] = $row['tweets_number'];
                }

                

            $conn->close();
            ?>
<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="style.css">
        <link rel="icon" href="https://pngimg.com/uploads/twitter/small/twitter_PNG3.png">
        <title>Twitter</title>
    </head>
    <body>
        <div id="menu">
            
            <div class="logo"><a href="home.php"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/4f/Twitter-logo.svg/2491px-Twitter-logo.svg.png" width="30px"></a></div>
            
            <div class="menu-item"><a href="home.php"><img src="https://raw.githubusercontent.com/monsterlessonsacademy/monsterlessonsacademy/e677aae424559c05e20f1a3f7d8f89a6680f448a/svg/home.svg" class="icons"><b>Home</b></a></div>
            <div class="menu-item"><a href="explore.php"><img src="https://raw.githubusercontent.com/monsterlessonsacademy/monsterlessonsacademy/e677aae424559c05e20f1a3f7d8f89a6680f448a/svg/explore.svg" class="icons">Explore</a></div>
            <div class="menu-item"><a href="notifications.php"><img src="https://raw.githubusercontent.com/monsterlessonsacademy/monsterlessonsacademy/e677aae424559c05e20f1a3f7d8f89a6680f448a/svg/notifications.svg" class="icons">Notifications</a></div>
            <div class="menu-item"><a href="messages.php"><img src="https://raw.githubusercontent.com/monsterlessonsacademy/monsterlessonsacademy/e677aae424559c05e20f1a3f7d8f89a6680f448a/svg/messages.svg" class="icons">Messages</a></div>
            <div class="menu-item"><a href="bookmarks.php"><img src="https://cdn-icons-png.flaticon.com/512/2956/2956783.png" class="icons">Bookmarks</a></div>
            <div class="menu-item"><a href="lists.php"><img src="https://cdn-icons-png.flaticon.com/512/2040/2040523.png" class="icons">Lists</a></div>
            <div class="menu-item"><a href="profile.php"><img src="https://raw.githubusercontent.com/monsterlessonsacademy/monsterlessonsacademy/e677aae424559c05e20f1a3f7d8f89a6680f448a/svg/profile.svg" class="icons">Profile</a></div>
            <div class="menu-item"><a href="more.php"><img src="https://raw.githubusercontent.com/monsterlessonsacademy/monsterlessonsacademy/e677aae424559c05e20f1a3f7d8f89a6680f448a/svg/more.svg" class="icons">More</a></div>
            
            <button id="tweet">Tweet</button>

            <div class="user">
                    <?php echo '<img src='.$myuser[0]['img'].' align="left" width="30">';?>
                    <img src="https://cdn-icons-png.flaticon.com/512/2311/2311523.png" align="right" width="20">
                    <b><?php echo $myuser[0]['full_name'];?></b>
                    <br><span class="gray">@<?php echo $myuser[0]['username'];?></span>
                   
               </div>
        </div>

        <div id="main">
            <div class="content-main">
                <div id="main-home">
                    <span id="home">Home</br></span>
                    <img id="ava" alt="user" src="https://cdn-icons-png.flaticon.com/512/456/456212.png" align="left" width="40">
                    <span id="everyone"><a href="">Everyone ∨</a></span>
                    <div id="input-new"><input class="new" type="text" placeholder="What's happening?"></div>
                    <div id="home-logos">
                        <img class="home-logos" alt="image" src="https://img.icons8.com/small/344/image.png">
                        <img class="home-logos" alt="image" src="https://img.icons8.com/ios-glyphs/344/attach-gif.png">
                        <img class="home-logos" alt="image" src="https://cdn-icons-png.flaticon.com/512/569/569501.png">
                        <img class="home-logos" alt="image" src="https://cdn-icons-png.flaticon.com/512/4322/4322107.png">
                        <img class="home-logos" alt="image" src="https://cdn-icons-png.flaticon.com/512/956/956926.png">
                        <button id="tweet-new">Tweet</button>
                    </div>
                </div>

                <div class="content">
                    <div class="ava"><img class="content-ava" alt="img" src="https://pbs.twimg.com/profile_images/1553522673409576960/sewydVLi_400x400.jpg"></div>
                    <p class="topic"><a href=""><span class="topic-user">Marvel Updates </span></a><span class="topic-span topic-login"> @marvel_updat3s</span></br></p>
                    <img class="content-logos more-topic" alt="more" src="https://img.icons8.com/ios-glyphs/344/more.png">
                    <p class="topic bottom-topic">Scarlett Johansson is the executive producer of #Thunderbolts #MarvelStudios</p>
                    <div><img class="content-image" alt="image" src="https://pbs.twimg.com/media/FfWbfnzXwAArLJc?format=jpg&name=small"></div>
                    <div class="logos"><img class="content-logos" alt="comment" src="https://img.icons8.com/ios/344/speech-bubble--v1.png">
                    <img class="content-logos repost" alt="repost" src="https://img.icons8.com/material-outlined/344/retweet.png">
                    <img class="content-logos like" alt="like" src="https://cdn-icons-png.flaticon.com/512/8182/8182897.png">
                    <img class="content-logos" alt="repost" src="https://img.icons8.com/ios-glyphs/344/share-rounded.png"></div>
                </div>

                <div class="content">
                    <div class="ava"><img class="content-ava" alt="img" src="https://pbs.twimg.com/profile_images/965775897193275398/LLrUTVUs_400x400.jpg"></div>
                    <p class="topic"><a href=""><span class="topic-user">Programmer humor </span></a><span class="topic-span topic-login"> @Phumor</span></br></p>
                    <img class="content-logos more-topic" alt="more" src="https://img.icons8.com/ios-glyphs/344/more.png">
                    <p class="topic bottom-topic">Programmer humor</p>
                    <div><img class="content-image" alt="image" src="https://pbs.twimg.com/media/FfAvgDfVsAA5ewq?format=jpg&name=small"></div>
                    <div class="logos"><img class="content-logos" alt="comment" src="https://img.icons8.com/ios/344/speech-bubble--v1.png">
                    <img class="content-logos repost" alt="repost" src="https://img.icons8.com/material-outlined/344/retweet.png">
                    <img class="content-logos like" alt="like" src="https://cdn-icons-png.flaticon.com/512/8182/8182897.png">
                    <img class="content-logos" alt="repost" src="https://img.icons8.com/ios-glyphs/344/share-rounded.png"></div>
                </div>

                <div class="content">
                    <div class="ava"><img class="content-ava" alt="img" src="https://pbs.twimg.com/profile_images/1553721706094682112/TQu0xewn_400x400.jpg"></div>
                    <p class="topic"><a href=""><span class="topic-user">Attack On Titan </span></a><span class="topic-span topic-login"> @AoTJewels</span></br></p>
                    <img class="content-logos more-topic" alt="more" src="https://img.icons8.com/ios-glyphs/344/more.png">
                    <p class="topic bottom-topic">Your last saved anime image is what they’re looking at</p>
                    <div><img class="content-image" alt="image" src="https://pbs.twimg.com/media/FfHOjRjXwAAvhjr?format=jpg&name=small"></div>
                    <div class="logos"><img class="content-logos" alt="comment" src="https://img.icons8.com/ios/344/speech-bubble--v1.png">
                    <img class="content-logos repost" alt="repost" src="https://img.icons8.com/material-outlined/344/retweet.png">
                    <img class="content-logos like" alt="like" src="https://cdn-icons-png.flaticon.com/512/8182/8182897.png">
                    <img class="content-logos" alt="repost" src="https://img.icons8.com/ios-glyphs/344/share-rounded.png"></div>
                </div>

                <div class="content">
                    <div class="ava"><img class="content-ava" alt="img" src="https://pbs.twimg.com/profile_images/1580543729307451394/5syTOolK_400x400.jpg"></div>
                    <p class="topic"><a href=""><span class="topic-user">jk.97</span></a><span class="topic-span topic-login"> @jeonIves</span></br></p>
                    <img class="content-logos more-topic" alt="more" src="https://img.icons8.com/ios-glyphs/344/more.png">
                    <p class="topic bottom-topic">almost 11M on weverse.. im praying for this app at this point</p>
                    <div class="logos"><img class="content-logos" alt="comment" src="https://img.icons8.com/ios/344/speech-bubble--v1.png">
                    <img class="content-logos repost" alt="repost" src="https://img.icons8.com/material-outlined/344/retweet.png">
                    <img class="content-logos like" alt="like" src="https://cdn-icons-png.flaticon.com/512/8182/8182897.png">
                    <img class="content-logos" alt="repost" src="https://img.icons8.com/ios-glyphs/344/share-rounded.png"></div>
                </div>

                <div class="content">
                    <div class="ava"><img class="content-ava" alt="img" src="https://pbs.twimg.com/profile_images/1342086006149791750/Ar0drcXS_400x400.jpg"></div>
                    <p class="topic"><a href=""><span class="topic-user">chart data</span></a><span class="topic-span topic-login"> @chartdata</span></br></p>
                    <img class="content-logos more-topic" alt="more" src="https://img.icons8.com/ios-glyphs/344/more.png">
                    <p class="topic bottom-topic">518 albums were submitted for Album of the Year consideration at next year's #GRAMMYs</p>
                    <div class="logos"><img class="content-logos" alt="comment" src="https://img.icons8.com/ios/344/speech-bubble--v1.png">
                    <img class="content-logos repost" alt="repost" src="https://img.icons8.com/material-outlined/344/retweet.png">
                    <img class="content-logos like" alt="like" src="https://cdn-icons-png.flaticon.com/512/8182/8182897.png">
                    <img class="content-logos" alt="repost" src="https://img.icons8.com/ios-glyphs/344/share-rounded.png"></div>
                </div>
                
                <div class="content">
                    <div class="ava"><img class="content-ava" alt="img" src="https://pbs.twimg.com/profile_images/1477617077766828039/AOjJSjDW_400x400.jpg"></div>
                    <p class="topic"><a href=""><span class="topic-user">Andreas Kling </span></a><span class="topic-span topic-login"> @awesomeking</span></br></p>
                    <img class="content-logos more-topic" alt="more" src="https://img.icons8.com/ios-glyphs/344/more.png">
                    <p class="topic bottom-topic">Looking at this file from WebKit may change how you think about web browsers</p>
                    <div><img class="content-image" alt="image" src="https://pbs.twimg.com/media/FfDRHTQWIAAeX21?format=jpg&name=small"></div>
                    <div class="logos"><img class="content-logos" alt="comment" src="https://img.icons8.com/ios/344/speech-bubble--v1.png">
                    <img class="content-logos repost" alt="repost" src="https://img.icons8.com/material-outlined/344/retweet.png">
                    <img class="content-logos like" alt="like" src="https://cdn-icons-png.flaticon.com/512/8182/8182897.png">
                    <img class="content-logos" alt="repost" src="https://img.icons8.com/ios-glyphs/344/share-rounded.png"></div>
                </div>
            </div>
            <script src="script.js"></script>
        </div>

        <div id="right">
            <div class="input"><img src="https://cdn-icons-png.flaticon.com/512/126/126474.png" width="15px"><input type="text" placeholder="Search Twitter" id="search"></div>
       
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
                    echo "<a href=\"home.php?del_following=$item_id\">";
                    echo "<button id=\"unfollow-button\">Following</button></a>";
                }
                else {
                    echo "<a href=\"home.php?del_follow=$item_id\">";
                    echo "<button id=\"follow\">Follow</button></a>";
                }
            
            $conn->close();?>
            
            <b><a href="userprofile.php?following_id=<?php echo $item['user_id']; ?>">
            <?php echo $item['name']; ?></a>
            </b><br><span class="gray">
            <?php echo '@'.$item['username'].'';?>
            </span> </div> 
            <?php endforeach;?>

             <div class="follower">
                    <span class="show-more">Show more</span>
                </div>
           
        </div>

        </div>
    </body>
    </html>