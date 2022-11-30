<?php	
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "test";
            
                $lists = array();
                $i = 0;
                $yourlists = array();
                $pinnedlists = array();
            
                $conn = mysqli_connect($servername, $username, $password, $dbname);
           
                if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
                }

                if(isset($_GET['del_follow'])){
                    $id = $_GET['del_follow'];
                    //mysqli_query($conn, "DELETE FROM whotofollow WHERE user_id='$id'");
                    mysqli_query($conn, "UPDATE usersprofile SET following_number = following_number +1 WHERE id=1");
                    mysqli_query($conn, "INSERT INTO following (user_id) VALUES ('$id')");
                    header('location: lists.php');
                }
    
                if(isset($_GET['del_following'])){
                    $id = $_GET['del_following'];
                    mysqli_query($conn, "DELETE FROM following WHERE user_id='$id'");
                    mysqli_query($conn, "UPDATE usersprofile SET following_number = following_number -1 WHERE id=1");
                    //mysqli_query($conn, "INSERT INTO whotofollow (user_id) VALUES ('$id')");
                    header('location: lists.php');
                }

                try { 
                    $query = "SELECT discovernewlists.id as id, 
                    lists.title as title, 
                    lists.img as img, 
                    lists.user as user, 
                    lists.username as username, 
                    lists.userimg as userimg
                    FROM lists 
                    INNER JOIN discovernewlists 
                    ON lists.id = discovernewlists.list_id";
                   $result = mysqli_query($conn, $query); 
                } catch (mysqli_sql_exception $e) { 
                   var_dump($e);
                   exit; 
                } 

                try { 
                    $queryy = "SELECT yourlists.id as id, 
                    lists.title as title, 
                    lists.img as img, 
                    lists.user as user, 
                    lists.username as username, 
                    lists.userimg as userimg,
                    yourlists.pinned as pinned,
                    yourlists.list_id as list_id
                    FROM lists 
                    INNER JOIN yourlists
                    ON lists.id = yourlists.list_id";
                   $resultt = mysqli_query($conn, $queryy); 
                } catch (mysqli_sql_exception $e) { 
                   var_dump($e);
                   exit; 
                }

                try { 
                    $query3 = "SELECT pinnedlists.id as id, 
                    lists.title as title, 
                    lists.img as img, 
                    lists.user as user, 
                    lists.username as username, 
                    lists.userimg as userimg,
                    pinnedlists.list_id as list_id
                    FROM lists 
                    INNER JOIN pinnedlists
                    ON lists.id = pinnedlists.list_id";
                   $result3 = mysqli_query($conn, $query3); 
                } catch (mysqli_sql_exception $e) { 
                   var_dump($e);
                   exit; 
                }

                if(isset($_GET['del_list'])){
                    $id = $_GET['del_list'];
                    mysqli_query($conn, "DELETE FROM discovernewlists WHERE id='$id'");
                    mysqli_query($conn, "INSERT INTO yourlists (list_id) VALUES ('$id')");
                    header('location: lists.php');
                }

                if(isset($_GET['pin_list'])){
                    $id = $_GET['pin_list'];
                    mysqli_query($conn, "INSERT INTO pinnedlists (list_id) VALUES ('$id')");
                    mysqli_query($conn, "UPDATE yourlists SET pinned=1 WHERE list_id='$id'");
                    header('location: lists.php');
                }

                if(isset($_GET['unpin_list'])){
                    $id = $_GET['unpin_list'];
                    mysqli_query($conn, "DELETE FROM pinnedlists WHERE list_id='$id'");
                    mysqli_query($conn, "UPDATE yourlists SET pinned=0 WHERE list_id='$id'");
                    header('location: lists.php');
                }

                while ($row = mysqli_fetch_array($result))
                    {
                        $lists[$i]['id'] = $row['id'];
                        $lists[$i]['title'] = $row['title'];
                        $lists[$i]['img'] = $row['img'];
                        $lists[$i]['user'] = $row['user'];
                        $lists[$i]['username'] = $row['username'];
                        $lists[$i]['userimg'] = $row['userimg'];
                        $i++;
                        if ($i == 3){break;}
                    }

                    while ($row = mysqli_fetch_array($resultt))
                    {
                        $yourlists[$i]['id'] = $row['id'];
                        $yourlists[$i]['title'] = $row['title'];
                        $yourlists[$i]['img'] = $row['img'];
                        $yourlists[$i]['user'] = $row['user'];
                        $yourlists[$i]['username'] = $row['username'];
                        $yourlists[$i]['userimg'] = $row['userimg'];
                        $yourlists[$i]['pinned'] = $row['pinned'];
                        $yourlists[$i]['list_id'] = $row['list_id'];
                        $i++;
                    }

                    while ($row = mysqli_fetch_array($result3))
                    {
                        $pinnedlists[$i]['id'] = $row['id'];
                        $pinnedlists[$i]['title'] = $row['title'];
                        $pinnedlists[$i]['img'] = $row['img'];
                        $pinnedlists[$i]['user'] = $row['user'];
                        $pinnedlists[$i]['username'] = $row['username'];
                        $pinnedlists[$i]['userimg'] = $row['userimg'];
                        $pinnedlists[$i]['list_id'] = $row['list_id'];
                        $i++;
                    }

                

                    $trends = array();
                    $i = 0;
                    $whotofollow = array();
                    $j = 0;

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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"/>
        <link rel="stylesheet" href="lists.css">
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
            <div class="menu-item"><a href="lists.php"><img src="https://cdn-icons-png.flaticon.com/512/2040/2040523.png" class="icons"><b>Lists</b></a></div>
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
            <div id="main-header">
                <a><img src="https://cdn-icons-png.flaticon.com/512/3114/3114883.png" width="15" id="back"></a>
                <div id="texts">
                    <h3 id="page-name">Lists</h3>
                    <span id="user-name">@User49491</span>
                </div>
                <a id="newlist"><img src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiPz4KPHN2ZyB3aWR0aD0iNzUycHQiIGhlaWdodD0iNzUycHQiIHZlcnNpb249IjEuMSIgdmlld0JveD0iMCAwIDc1MiA3NTIiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+CiA8ZGVmcz4KICA8Y2xpcFBhdGggaWQ9ImIiPgogICA8cGF0aCBkPSJtMzgwIDEzOS4yMWgyMzIuNzl2MjMyLjc5aC0yMzIuNzl6Ii8+CiAgPC9jbGlwUGF0aD4KICA8Y2xpcFBhdGggaWQ9ImEiPgogICA8cGF0aCBkPSJtMTM5LjIxIDIzOWgzNzMuNzl2MzczLjc5aC0zNzMuNzl6Ii8+CiAgPC9jbGlwUGF0aD4KIDwvZGVmcz4KIDxnIGNsaXAtcGF0aD0idXJsKCNiKSI+CiAgPHBhdGggZD0ibTQ5Ni41NSAxMzkuMjFjLTIuNTE1NiAwLTExLjAzMSAyLjAyMzQtMTEuMDMxIDQuNTM5MXYxMDAuNjdoLTEwMC42N2MtMi41MTU2IDAtNC41MzkxIDguNTE1Ni00LjUzOTEgMTEuMDMxczIuMDIzNCAxMS4wMzEgNC41MzkxIDExLjAzMWgxMDAuNjd2MTAwLjY3YzAgMi41MTU2IDguNTE1NiA0LjUzOTEgMTEuMDMxIDQuNTM5MXMxMS4wNzgtMi4wMjczIDExLjAzMS00LjUzOTF2LTEwMC42N2gxMDAuNjdjMi41MTU2IDAgNC41MzkxLTguNTE1NiA0LjUzOTEtMTEuMDMxcy0yLjAyNzMtMTEuMDc4LTQuNTM5MS0xMS4wMzFoLTEwMC42N3YtMTAwLjY3YzAtMi41MTU2LTguNTE1Ni00LjUzOTEtMTEuMDMxLTQuNTM5MXoiLz4KIDwvZz4KIDxnIGNsaXAtcGF0aD0idXJsKCNhKSI+CiAgPHBhdGggdHJhbnNmb3JtPSJtYXRyaXgoLjkyNDk2IDAgMCAuOTI0OTYgNTcuMTIxIDE3Ljc1MykiIGQ9Im0zMDQuMjMgMjU2Ljk4aC0xOTcuOTl2MzY4LjgzaDM2OC44M3YtMTk3LjY5IiBmaWxsPSJub25lIiBzdHJva2U9IiMwMDAiIHN0cm9rZS1saW5lam9pbj0icm91bmQiIHN0cm9rZS1taXRlcmxpbWl0PSIxMCIgc3Ryb2tlLXdpZHRoPSIzNSIvPgogPC9nPgogPHBhdGggdHJhbnNmb3JtPSJtYXRyaXgoLjkyNDk2IDAgMCAuOTI0OTYgMTM5LjIxIDEzOS4yMSkiIGQ9Im04MS40MjYgMjA5LjE0aDIwMi44NnptMCA2OC4wMzVoMjAyLjg2em0wIDY4LjAzOWgyMDIuODZ6bTAgNjguMDM1aDIwMi44NnoiIGZpbGw9Im5vbmUiIHN0cm9rZT0iIzAwMCIgc3Ryb2tlLXdpZHRoPSIyNSIvPgo8L3N2Zz4K" width="30"></a>
                <a id="more"><img src="https://cdn-icons-png.flaticon.com/512/2311/2311523.png" width="17"></a>
            </div>
            <div id="first">
                <h2>Pinned Lists</h2>
                <div class="pinned-lists">
                <?php foreach($pinnedlists as $item): ?>
                <div class="pinnedlist">
                    <?php echo '<img src='.$item['img'].'align="left" width="68" height="68" class="pinnedlist-photo">';?>
                    <span><?php echo $item['title']; ?></span>
                </div>
                <?php endforeach; ?>
                </div>
            </div>

            <div id="second">
                <h2>Discover new Lists</h2>
                
                <?php foreach($lists as $item): ?>
                <div class="follower-lists">
                <?php echo '<img src='.$item['img'].'align="left" width="48" height="48" class="list-photo">';?>
                    <button id="follow"><a href="lists.php?del_list=<?php echo $item['id']; ?>">Follow</a></button>
                    <b><?php echo $item['title']; ?></b>
                    <br><?php echo '<img src='.$item['userimg'].'class="user-photo">';?>
                    <b class="black-lists"><?php echo $item['user']; ?></b>
                    <span class="gray-lists"><?php echo $item['username']; ?></span>
                </div>
                <?php endforeach; ?>


                <div class="follower-lists">
                    <span class="show-more">Show more</span>
                </div>
            </div>

            <div id="third">
                <h2>Your Lists</h2>
                <?php foreach($yourlists as $item): ?>
                    <div class="follower-lists">
                    <?php echo '<img src='.$item['img'].'align="left" width="48" height="48" class="list-photo">';?>
                    <?php if($item['pinned'] == 0){ ?>
                        <a id="pin" href="lists.php?pin_list=<?php echo $item['list_id']; ?>"><i class="fa-solid fa-thumbtack" ></i></a>
                    <?php } else if($item['pinned'] == 1){ ?>
                        <a id="unpin" href="lists.php?unpin_list=<?php echo $item['list_id']; ?>"><i class="fa-solid fa-thumbtack"></i></a>
                    <?php } ?>
                    <b><?php echo $item['title']; ?></b>
                    <br><?php echo '<img src='.$item['userimg'].'class="user-photo">';?>
                    <b class="black-lists"><?php echo $item['user']; ?></b>
                    <span class="gray-lists"><?php echo $item['username']; ?></span>
                    
                    </div>
                    <?php endforeach; ?>
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
                    echo "<a href=\"lists.php?del_following=$item_id\">";
                    echo "<button id=\"unfollow-button\">Following</button></a>";
                }
                else {
                    echo "<a href=\"lists.php?del_follow=$item_id\">";
                    echo "<button id=\"follow\">Follow</button></a>";
                }
            
            $conn->close();?>
            
            <b><a href="userprofile.php?following_id=<?php echo $item['user_id']; ?>">
            <?php echo $item['name']; ?></a>
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