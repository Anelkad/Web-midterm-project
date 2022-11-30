<?php	
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "test";
            
            $trends = array();
            $i = 0;
            $whotofollow = array();
            $j = 0;



            $suggested_topics = array();
            $following_topics = array();

            $conn = mysqli_connect($servername, $username, $password, $dbname);
           
            if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
            }

            if(isset($_GET['follow_topic'])){
                $id = $_GET['follow_topic'];
                mysqli_query($conn, "INSERT INTO followingtopics (topic_id) VALUES ('$id')");
                mysqli_query($conn, "DELETE FROM recommendedtopics WHERE topic_id='$id'");
                header('location: more.php');
            }

            if(isset($_GET['unfollow_topic'])){
                $id = $_GET['unfollow_topic'];
                mysqli_query($conn, "INSERT INTO recommendedtopics (topic_id) VALUES ('$id')");
                mysqli_query($conn, "DELETE FROM followingtopics WHERE topic_id='$id'");
                header('location: more.php');
            }

            if(isset($_GET['notinterested'])){
                $id = $_GET['notinterested'];
                mysqli_query($conn, "DELETE FROM recommendedtopics WHERE topic_id='$id'");
                mysqli_query($conn, "INSERT INTO notinterestedtopics (topic_id) VALUES ('$id')");
                header('location: more.php');
            }

            
            //здесь есть изменения от сюда, ссылка должна быть текущая страница, здесь more.php

            if(isset($_GET['del_follow'])){
                $id = $_GET['del_follow'];
                //mysqli_query($conn, "DELETE FROM whotofollow WHERE user_id='$id'");
                mysqli_query($conn, "UPDATE usersprofile SET following_number = following_number +1 WHERE id=1");
                mysqli_query($conn, "INSERT INTO following (user_id) VALUES ('$id')");
                header('location: more.php');
            }

            if(isset($_GET['del_following'])){
                $id = $_GET['del_following'];
                mysqli_query($conn, "DELETE FROM following WHERE user_id='$id'");
                mysqli_query($conn, "UPDATE usersprofile SET following_number = following_number -1 WHERE id=1");
                //mysqli_query($conn, "INSERT INTO whotofollow (user_id) VALUES ('$id')");
                header('location: more.php');
            }
            //до сюда
            
            $sql = mysqli_query($conn, 'SELECT `title`, `subtitle`,`tweets` FROM `trends`');
            while ($row = mysqli_fetch_array($sql))
                {
                    $trends[$i]['title'] = $row['title'];
                    $trends[$i]['subtitle'] = $row['subtitle'];
                    $trends[$i]['tweets'] = $row['tweets'];
                    $i++;
                }
            
            try { 
                $sql = "SELECT topics.title as title, 
                topics.id as id,
                topics.category_id as category_id,
                topics.description as description
                FROM topics
                INNER JOIN followingtopics
                ON topics.id = followingtopics.topic_id";
               $result = mysqli_query($conn, $sql); 
            } catch (mysqli_sql_exception $e) { 
               var_dump($e);
               exit; 
            } 

            $i = 0;
            while ($row = mysqli_fetch_array($result))
                {
                    $following_topics[$i]['title'] = $row['title'];
                    $following_topics[$i]['id'] = $row['id'];
                    $following_topics[$i]['category_id'] = $row['category_id'];
                    $following_topics[$i]['description'] = $row['description'];
                    $i++;
                }
            
                try { 
                    $sql = "SELECT topics.title as title, 
                    topics.id as id,
                    topics.category_id as category_id
                    FROM topics
                    INNER JOIN recommendedtopics
                    ON topics.id = recommendedtopics.topic_id AND topics.category_id = 1";
                   $result = mysqli_query($conn, $sql); 
                } catch (mysqli_sql_exception $e) { 
                   var_dump($e);
                   exit; 
                } 
    
                $i = 0;
                while ($row = mysqli_fetch_array($result))
                    {
                        $suggested_topics[$i]['title'] = $row['title'];
                        $suggested_topics[$i]['id'] = $row['id'];
                        $suggested_topics[$i]['category_id'] = $row['category_id'];
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
            //здесь увеличила с 3 до 5 пользователей
                    if ($j==5) break;
                 }

            //текущий user от сюда
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
            
            //до сюда
            $conn->close();
            
            ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="more.css">
        <link rel="icon" href="https://pngimg.com/uploads/twitter/small/twitter_PNG3.png">
        <title>Twitter</title>
    </head>
    <body>
        <div id="menu">
            
            <div class="logo"><a href="home.php"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/4f/Twitter-logo.svg/2491px-Twitter-logo.svg.png" width="30px"></a></div>
            
            <div class="menu-item"><a href="home.php"><img src="https://raw.githubusercontent.com/monsterlessonsacademy/monsterlessonsacademy/e677aae424559c05e20f1a3f7d8f89a6680f448a/svg/home.svg" class="icons">Home</a></div>
            <div class="menu-item"><a href="explore.php"><img src="https://raw.githubusercontent.com/monsterlessonsacademy/monsterlessonsacademy/e677aae424559c05e20f1a3f7d8f89a6680f448a/svg/explore.svg" class="icons">Explore</a></div>
            <div class="menu-item"><a href="notifications.php"><img src="https://raw.githubusercontent.com/monsterlessonsacademy/monsterlessonsacademy/e677aae424559c05e20f1a3f7d8f89a6680f448a/svg/notifications.svg" class="icons">Notifications</a></div>
            <div class="menu-item"><a href="messages.php"><img src="https://raw.githubusercontent.com/monsterlessonsacademy/monsterlessonsacademy/e677aae424559c05e20f1a3f7d8f89a6680f448a/svg/messages.svg" class="icons">Messages</a></div>
            <div class="menu-item"><a href="bookmarks.php"><img src="https://cdn-icons-png.flaticon.com/512/2956/2956783.png" class="icons">Bookmarks</a></div>
            <div class="menu-item"><a href="lists.php"><img src="https://cdn-icons-png.flaticon.com/512/2040/2040523.png" class="icons">Lists</a></div>
            <div class="menu-item"><a href="profile.php"><img src="https://raw.githubusercontent.com/monsterlessonsacademy/monsterlessonsacademy/e677aae424559c05e20f1a3f7d8f89a6680f448a/svg/profile.svg" class="icons">Profile</a></div>
            <div class="menu-item"><a href="more.php"><img src="https://raw.githubusercontent.com/monsterlessonsacademy/monsterlessonsacademy/e677aae424559c05e20f1a3f7d8f89a6680f448a/svg/more.svg" class="icons">More</a></div>
            
            <button id="tweet">Tweet</button>
            
            <?php //здесь блок myuser от сюда ?>
            <div class="user">
                    <?php echo '<img src='.$myuser[0]['img'].' align="left" width="30">';?>
                    <img src="https://cdn-icons-png.flaticon.com/512/2311/2311523.png" align="right" width="20">
                    <b><?php echo $myuser[0]['full_name'];?></b>
                    <br><span class="gray">@<?php echo $myuser[0]['username'];?></span>
                   
               </div>
            <?php //до сюда ?>
            
        </div>

        <div id="main">
            <div class="fixed-title">
                <div class="back"><a href="home.php"><img src="https://cdn-icons-png.flaticon.com/512/3114/3114883.png" width="20px"></a></div>
                <h3 id="topics">Topics</h3>

                <br>
                <div class="topic-part"><a href="more.php"><b>Followed</b><hr color="DeepSkyBlue" width="60" size="3"></a></div>
                <div class="topic-part"><a href="more2.php">Suggested</a><br></div>
                <div class="topic-part"><a href="more3.php">Not Interested</a><br></div>
            </div>

            <div class="moving">
            <div id="topics-descr">
                The Topics you follow are used to personalize the Tweets, events, and ads that you see, and show up publicly on your profile
            </div>

            <div>
                <?php foreach($following_topics as $item): ?>
                <div class="follower-item">
                <img src="https://create.twitter.com/content/dam/create-twitter/global-backgrounds/marketing-module/bg-marketing-module-blue-d.jpg.twimg.1920.jpg" align="left" width="30" height="30">
                <button id="unfollow"><a href="more.php?unfollow_topic=<?php echo $item['id']; ?>">Following</a></button>
                <b><?php echo $item['title']; ?>
                </b><br><span class="gray" style="font-size:15px">
                <?php echo $item['description'];?>
                </span></div> 
                <?php endforeach; ?>
            </div>

            <br>
            <h2 class="title-topics">Suggested Topics</h2><br>
            <span class="gray">You'll see top Tweets about these right in your Home timeline</span>

            <hr color="white">
            
            <div class="topics-list">

                <?php $div_id = 1?>
                <?php foreach($suggested_topics as $item): ?>
                    <?php if ($div_id %5 == 1){
                        echo '<div>';
                    }?>
                
                <div class="topics-item">
                <?php echo $item['title'];?>
                <a href="more.php?notinterested=<?php echo $item['id']; ?>">
                <img class="delete" src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/98/%D0%98%D0%BA%D0%BE%D0%BD%D0%BA%D0%B0_%D0%BA%D1%80%D0%B5%D1%81%D1%82%D0%B8%D0%BA%D0%B0_%28ei%29.svg/1200px-%D0%98%D0%BA%D0%BE%D0%BD%D0%BA%D0%B0_%D0%BA%D1%80%D0%B5%D1%81%D1%82%D0%B8%D0%BA%D0%B0_%28ei%29.svg.png">
                </a>
                <a href="more.php?follow_topic=<?php echo $item['id']; ?>">
                <img class="blue-img" src="https://img.icons8.com/android/344/plus.png" width="20"></a>
                </div>
                
                <?php if (($div_id %5 == 0)||($div_id == count($suggested_topics))){
                        echo '</div>';
                    }
                $div_id++;?>
                <?php endforeach; ?>
                
            </div>
            <div id="more-topics">
                <span class="blue">More Topics</span>
            </div>

            <p class="gray" style="font-size:15px"> Topics that you follow are shown here. To see all the things that Twitter thinks you’re interested in, check out <a href="" class="blue">Your Twitter data</a>. You can also <a href="" class="blue">learn more</a> about following <br>Topics.
            </p>

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

        <?php //whotofollow от сюда 
            foreach($whotofollow as $item): ?>
            <div class="follower">
            <?php echo '<img src='.$item['img'].'align="left" width="40">';?>
            
            <?php 

            $conn = mysqli_connect($servername, $username, $password, $dbname);

            $follow_id = $item['user_id'];

            $sql = mysqli_query($conn, "SELECT id FROM following WHERE user_id=$follow_id");
            $isfollowed = $sql->fetch_row();
                
            $item_id = $item['user_id'];
                //но надо в ссылках ставить текущую страницу, в этом случае more.php
                if ((bool)$isfollowed){
                    echo "<a href=\"more.php?del_following=$item_id\">";
                    echo "<button id=\"unfollow-button\">Following</button></a>";
                }
                else {
                    echo "<a href=\"more.php?del_follow=$item_id\">";
                    echo "<button id=\"follow\">Follow</button></a>";
                }
            
            $conn->close();
            //здесь ссылка должна быть userprofile.php ?>
            
            <b><a href="userprofile.php?following_id=<?php echo $item['user_id']; ?>">
            <?php echo $item['name']; ?></a>
            </b><br><span class="gray">
            <?php echo '@'.$item['username'].'';?>
            </span> </div> 
            <?php endforeach; 
            //до сюда ?>

            <div class="follower">
                <span class="show-more">Show more</span>
            </div>

    </div>

        </div>

    </body>
</html>