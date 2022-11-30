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
                header('location: explore.php');
            }

            if(isset($_GET['del_following'])){
                $id = $_GET['del_following'];
                mysqli_query($conn, "DELETE FROM following WHERE user_id='$id'");
                mysqli_query($conn, "UPDATE usersprofile SET following_number = following_number -1 WHERE id=1");
                //mysqli_query($conn, "INSERT INTO whotofollow (user_id) VALUES ('$id')");
                header('location: explore.php');
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
        <link rel="stylesheet" href="explore.css">
        <link rel="icon" href="https://pngimg.com/uploads/twitter/small/twitter_PNG3.png">
        <title>Twitter</title>
    </head>
    <body>
        <div id="menu">
            
            <div class="logo"><a href="home.php"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/4f/Twitter-logo.svg/2491px-Twitter-logo.svg.png" width="30px"></a></div>
            
            <div class="menu-item"><a href="home.php"><img src="https://raw.githubusercontent.com/monsterlessonsacademy/monsterlessonsacademy/e677aae424559c05e20f1a3f7d8f89a6680f448a/svg/home.svg" class="icons">Home</a></div>
            <div class="menu-item"><a href="explore.php"><img src="https://raw.githubusercontent.com/monsterlessonsacademy/monsterlessonsacademy/e677aae424559c05e20f1a3f7d8f89a6680f448a/svg/explore.svg" class="icons"><b>Explore</b></a></div>
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
            <div id="main-header">
                <div class="input"><img src="https://cdn-icons-png.flaticon.com/512/126/126474.png" width="15px"><input type="text" placeholder="Search Twitter" id="search"><img id="option-img" src="https://cdn-icons-png.flaticon.com/512/2099/2099058.png" width="20px"></div>
            </div>

            <div id="first">
                <h2>Trends for you</h2>

            <?php foreach($trends as $item): ?>
            <div class="follower-lists">
            <img class="content-logos more-topic" alt="more" src="https://img.icons8.com/ios-glyphs/344/more.png">
            <b class="topic"><?php echo $item['subtitle'];?></b><br>
                    <b class="black-lists"><?php echo $item['title'];?></b><br>
                    <span class="gray-lists">
                    <?php  if ($item['tweets']>0){echo ''.$item['tweets'].'  Tweets';}?>
                    </span>   
            </div>
            <?php endforeach; ?>

                <div class="follower-more">
                    <span class="show-more">Show more</span>
                </div>
            </div>

            <div id="second">
                <h2>What’s happening</h2>
                <div class="follower-lists">
                    <img class="second-img" alt="img" src="https://pbs.twimg.com/tweet_video_thumb/FfRsGtOXwAIvV7_?format=jpg&name=240x240">
                    <b class="topic-user">Financial Times</b><b class="topic">Yesterday</b><br>
                    <b class="black-lists">How Xi Jinping became China’s unrivalled leader</b><br>
                </div>
    
                <div class="follower-lists">
                    <img class="second-img" alt="img" src="https://pbs.twimg.com/semantic_core_img/1571150918896295936/7PQxWLgh?format=jpg&name=240x240">
                    <b class="topic-user">Entertaiment</b><b class="topic">LIVE</b><br>
                    <b class="black-lists">It's Freida Pinto's birthday 🎂</b><br>
                </div>
    
                <div class="follower-lists">
                    <img class="second-img" alt="img" src="https://pbs.twimg.com/media/FfM-a4LXwAAEa8P?format=jpg&name=240x240">
                    <b class="topic-user">Toronto Star</b><b class="topic">October 16, 2022</b><br>
                    <b class="black-lists">James Webb telescope pictures didn’t begin as stunning images. Here’s how they started out — and how researchers brought them to life</b><br>
                </div>

                <div class="follower-lists">
                    <img class="second-img" alt="img" src="https://pbs.twimg.com/semantic_core_img/1579454614277181440/b-ZGeQ4X?format=jpg&name=240x240">
                    <b class="topic-user">War in Ukraine</b><b class="topic">LIVE</b><br>
                    <b class="black-lists">Latest updates on the war in Ukraine</b><br>
                </div>

                <div class="follower-lists">
                    <img class="second-img" alt="img" src="https://pbs.twimg.com/semantic_core_img/1582022079561482240/1pwQMWgw?format=jpg&name=240x240">
                    <b class="topic-user">Animals</b><b class="topic">Yesterday</b><br>
                    <b class="black-lists">A 2007 video of a frilled shark has been miscaptioned, fact-checkers report</b><br>
                </div>

                <div class="follower-lists">
                    <img class="second-img" alt="img" src="https://pbs.twimg.com/media/FfTFAvTVsAA35gW?format=jpg&name=240x240">
                    <b class="topic-user">Bloomberg Crypto</b><b class="topic">Last night</b><br>
                    <b class="black-lists">US regulators probe bankrupt crypto hedge fund Three Arrows Capital</b><br>
                </div>

                <div class="follower-lists">
                    <img class="second-img" alt="img" src="https://pbs.twimg.com/semantic_core_img/1563222339365482498/iC-35hQM?format=jpg&name=240x240">
                    <b class="topic-user">US elections</b><b class="topic">LIVE</b><br>
                    <b class="black-lists">Learn how your state's voting laws may have changed</b><br>
                </div>

                <div class="follower-more">
                    <span class="show-more">Show more</span>
                </div>
            </div>

            <div id="third">
                <h2>Grammy Awards</h2>
                <div class="content">
                    <div class="ava"><img class="content-ava" alt="img" src="https://pbs.twimg.com/profile_images/1582025179269664769/RFtnla4p_400x400.jpg"></div>
                    <p class="user-content"><a href=""><span class="topic-login">Bria C. </span></a><span class="topic-span"> @bria__________</span></br></p>
                    <img class="content-logos more-topic" alt="more" src="https://img.icons8.com/ios-glyphs/344/more.png">
                    <br><p class="bottom-topic">Did the Recording Academy release a secret list of Grammy nominations a little under a month early that only TSR knows about or are they confusing submissions with nominations? 🤣</p>
                    <div class="logos"><img class="content-logos" alt="comment" src="https://img.icons8.com/ios/344/speech-bubble--v1.png">
                    <img class="content-logos repost" alt="repost" src="https://img.icons8.com/material-outlined/344/retweet.png">
                    <img class="content-logos like" alt="like" src="https://cdn-icons-png.flaticon.com/512/8182/8182897.png">
                    <img class="content-logos" alt="repost" src="https://img.icons8.com/ios-glyphs/344/share-rounded.png"></div>
                </div>

                <div class="content">
                    <div class="ava"><img class="content-ava" alt="img" src="https://pbs.twimg.com/profile_images/1551462904305750017/5G_m0JMv_400x400.jpg"></div>
                    <p class="user-content"><a href=""><span class="topic-login">єм¢σ❄️</span></a><span class="topic-span">@Onalow12</span></br></p>
                    <img class="content-logos more-topic" alt="more" src="https://img.icons8.com/ios-glyphs/344/more.png">
                    <br><p class="bottom-topic">The picture of Burna Boy reminds me of why he deserves a Grammy award for Best Song For Social Change. It's OCTOBER and we've still not forgotten ✊🦍</p>
                    <div><img class="content-image" alt="image" src="https://pbs.twimg.com/media/FfS5OOYXoAAGRK6?format=jpg&name=medium"></div>
                    <div class="logos"><img class="content-logos" alt="comment" src="https://img.icons8.com/ios/344/speech-bubble--v1.png">
                    <img class="content-logos repost" alt="repost" src="https://img.icons8.com/material-outlined/344/retweet.png">
                    <img class="content-logos like" alt="like" src="https://cdn-icons-png.flaticon.com/512/8182/8182897.png">
                    <img class="content-logos" alt="repost" src="https://img.icons8.com/ios-glyphs/344/share-rounded.png"></div>
                </div>

                <div class="content">
                    <div class="ava"><img class="content-ava" alt="img" src="https://pbs.twimg.com/profile_images/1545079718151704580/pPSvc5yi_400x400.jpg"></div>
                    <p class="user-content"><a href=""><span class="topic-login">Chris Brown Charts</span></a><span class="topic-span">@cbrowncharts</span></br></p>
                    <img class="content-logos more-topic" alt="more" src="https://img.icons8.com/ios-glyphs/344/more.png">
                    <br><p class="bottom-topic">Chris Brown Featured On 2023 Grammy Awards "Best R&B Album" Pre-Nominees.<br><br>
                        Of the 13, only 5 will be made official as nominees for that category.</p>
                    <div><img class="content-image" alt="image" src="https://pbs.twimg.com/media/FfSinz5XwAcG8YB?format=jpg&name=small"></div>
                    <div class="logos"><img class="content-logos" alt="comment" src="https://img.icons8.com/ios/344/speech-bubble--v1.png">
                    <img class="content-logos repost" alt="repost" src="https://img.icons8.com/material-outlined/344/retweet.png">
                    <img class="content-logos like" alt="like" src="https://cdn-icons-png.flaticon.com/512/8182/8182897.png">
                    <img class="content-logos" alt="repost" src="https://img.icons8.com/ios-glyphs/344/share-rounded.png"></div>
                </div>

                <div class="follow-this">
                    <img src="data:image/svg+xml;base64,PHN2ZyB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHZpZXdCb3g9IjAgMCAxNzIgMTcyIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9Im5vbnplcm8iIHN0cm9rZT0ibm9uZSIgc3Ryb2tlLXdpZHRoPSIxIiBzdHJva2UtbGluZWNhcD0iYnV0dCIgc3Ryb2tlLWxpbmVqb2luPSJtaXRlciIgc3Ryb2tlLW1pdGVybGltaXQ9IjEwIiBzdHJva2UtZGFzaGFycmF5PSIiIHN0cm9rZS1kYXNob2Zmc2V0PSIwIiBmb250LWZhbWlseT0ibm9uZSIgZm9udC13ZWlnaHQ9Im5vbmUiIGZvbnQtc2l6ZT0ibm9uZSIgdGV4dC1hbmNob3I9Im5vbmUiIHN0eWxlPSJtaXgtYmxlbmQtbW9kZTogbm9ybWFsIj48cGF0aCBkPSJNMCwxNzJ2LTE3MmgxNzJ2MTcyeiIgZmlsbD0ibm9uZSI+PC9wYXRoPjxnIGZpbGw9IiMzNDk4ZGIiPjxwYXRoIGQ9Ik04NiwwYy00My41MzE5LDAgLTc4LjgzMzMzLDMyLjA4MjAzIC03OC44MzMzMyw3MS42NjY2N2MwLDM5LjU4NDY0IDM1LjMwMTQzLDcxLjY2NjY3IDc4LjgzMzMzLDcxLjY2NjY3djI4LjY2NjY3YzAsMCA3OC44MzMzMywtMzguNDA4ODUgNzguODMzMzMsLTEwMC4zMzMzM2MwLC0zOS41ODQ2MyAtMzUuMzAxNDMsLTcxLjY2NjY3IC03OC44MzMzMywtNzEuNjY2Njd6TTk0Ljc2MjM3LDEwOC4zOTU4M2gtMTcuNTI0NzR2LTQ5LjkxNDcyaDE3LjUyNDc0ek04Ni4wMjc5OSw0NC40Mjc3NGMtOS40OTAyMywwIC05LjU0NjIyLC02Ljk5ODcgLTkuNTQ2MjIsLTguNjIyNGMwLC0xLjY1MTY5IDAsLTguNTY2NDEgOS41NDYyMiwtOC41NjY0MWM5LjU3NDIyLDAgOS41NDYyMyw2LjkxNDcyIDkuNTQ2MjMsOC41NjY0MWMwLDEuNjIzNjkgLTAuMDU1OTksOC42MjI0IC05LjU0NjIzLDguNjIyNHoiPjwvcGF0aD48L2c+PC9nPjwvc3ZnPg==" align="left" width="48" height="48" class="list-photo">
                    <button id="follow">Follow</button>
                    <b>Grammy Awards</b><br>
                    <span class="gray-lists">Music event</span>
                </div>

                <h2>Netflix</h2>
                <div class="content">
                    <div class="ava"><img class="content-ava" alt="img" src="https://pbs.twimg.com/profile_images/1043772807409229824/VkCTB2Yp_400x400.jpg"></div>
                    <p class="user-content"><a href=""><span class="topic-login">Paul Feig</span></a><span class="topic-span">@paulfeig</span></br></p>
                    <img class="content-logos more-topic" alt="more" src="https://img.icons8.com/ios-glyphs/344/more.png">
                    <br><p class="bottom-topic">The School For Good and Evil comes out this week on Netflix and I’m excited to answer all of your burning questions #AskPaulFeig</p>
                    <div class="logos"><img class="content-logos" alt="comment" src="https://img.icons8.com/ios/344/speech-bubble--v1.png">
                    <img class="content-logos repost" alt="repost" src="https://img.icons8.com/material-outlined/344/retweet.png">
                    <img class="content-logos like" alt="like" src="https://cdn-icons-png.flaticon.com/512/8182/8182897.png">
                    <img class="content-logos" alt="repost" src="https://img.icons8.com/ios-glyphs/344/share-rounded.png"></div>
                </div>
                
                <div class="content">
                    <div class="ava"><img class="content-ava" alt="img" src="https://pbs.twimg.com/profile_images/1559498498537623553/iDnHlRRp_400x400.jpg"></div>
                    <p class="user-content"><a href=""><span class="topic-login">irene || #RenewSandman</span></a><span class="topic-span">@jesperfection</span></br></p>
                    <img class="content-logos more-topic" alt="more" src="https://img.icons8.com/ios-glyphs/344/more.png">
                    <br><p class="bottom-topic">it makes me very very sad that there is no sandman merch, no profile icons on netflix, no bloopers, no deleted scenes and most importantly, no renewal</p>
                    <div class="logos"><img class="content-logos" alt="comment" src="https://img.icons8.com/ios/344/speech-bubble--v1.png">
                    <img class="content-logos repost" alt="repost" src="https://img.icons8.com/material-outlined/344/retweet.png">
                    <img class="content-logos like" alt="like" src="https://cdn-icons-png.flaticon.com/512/8182/8182897.png">
                    <img class="content-logos" alt="repost" src="https://img.icons8.com/ios-glyphs/344/share-rounded.png"></div>
                </div>

                <div class="content">
                    <div class="ava"><img class="content-ava" alt="img" src="https://pbs.twimg.com/profile_images/1514282754053226500/4XQa7-04_400x400.jpg"></div>
                    <p class="user-content"><a href=""><span class="topic-login">Stranger Things 4</span></a><span class="topic-span">@StrangerNews11</span></br></p>
                    <img class="content-logos more-topic" alt="more" src="https://img.icons8.com/ios-glyphs/344/more.png">
                    <br><p class="bottom-topic">Enola Holmes 2 behind the scenes...❤️📺✨ #NETFLIX</p>
                    <div><img class="content-image" alt="image" src="https://pbs.twimg.com/media/FfWbEfbWQAANNB7?format=jpg&name=small"></div>
                    <div class="logos"><img class="content-logos" alt="comment" src="https://img.icons8.com/ios/344/speech-bubble--v1.png">
                    <img class="content-logos repost" alt="repost" src="https://img.icons8.com/material-outlined/344/retweet.png">
                    <img class="content-logos like" alt="like" src="https://cdn-icons-png.flaticon.com/512/8182/8182897.png">
                    <img class="content-logos" alt="repost" src="https://img.icons8.com/ios-glyphs/344/share-rounded.png"></div>
                </div>

                <div class="content">
                    <div class="ava"><img class="content-ava" alt="img" src="https://pbs.twimg.com/profile_images/1487084007825326084/9ZaC35fG_400x400.jpg"></div>
                    <p class="user-content"><a href=""><span class="topic-login">Netflix UK & Ireland</span></a><span class="topic-span">@Netflix</span></br></p>
                    <img class="content-logos more-topic" alt="more" src="https://img.icons8.com/ios-glyphs/344/more.png">
                    <br><p class="bottom-topic">Imelda Staunton is Queen Elizabeth II.</p>
                    <div><img class="content-image" alt="image" src="https://pbs.twimg.com/media/FfSiIWvXEAANlhJ?format=jpg&name=small"></div>
                    <div class="logos"><img class="content-logos" alt="comment" src="https://img.icons8.com/ios/344/speech-bubble--v1.png">
                    <img class="content-logos repost" alt="repost" src="https://img.icons8.com/material-outlined/344/retweet.png">
                    <img class="content-logos like" alt="like" src="https://cdn-icons-png.flaticon.com/512/8182/8182897.png">
                    <img class="content-logos" alt="repost" src="https://img.icons8.com/ios-glyphs/344/share-rounded.png"></div>
                </div>

                <div class="follow-this">
                    <img src="data:image/svg+xml;base64,PHN2ZyB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHZpZXdCb3g9IjAgMCAxNzIgMTcyIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9Im5vbnplcm8iIHN0cm9rZT0ibm9uZSIgc3Ryb2tlLXdpZHRoPSIxIiBzdHJva2UtbGluZWNhcD0iYnV0dCIgc3Ryb2tlLWxpbmVqb2luPSJtaXRlciIgc3Ryb2tlLW1pdGVybGltaXQ9IjEwIiBzdHJva2UtZGFzaGFycmF5PSIiIHN0cm9rZS1kYXNob2Zmc2V0PSIwIiBmb250LWZhbWlseT0ibm9uZSIgZm9udC13ZWlnaHQ9Im5vbmUiIGZvbnQtc2l6ZT0ibm9uZSIgdGV4dC1hbmNob3I9Im5vbmUiIHN0eWxlPSJtaXgtYmxlbmQtbW9kZTogbm9ybWFsIj48cGF0aCBkPSJNMCwxNzJ2LTE3MmgxNzJ2MTcyeiIgZmlsbD0ibm9uZSI+PC9wYXRoPjxnIGZpbGw9IiMzNDk4ZGIiPjxwYXRoIGQ9Ik04NiwwYy00My41MzE5LDAgLTc4LjgzMzMzLDMyLjA4MjAzIC03OC44MzMzMyw3MS42NjY2N2MwLDM5LjU4NDY0IDM1LjMwMTQzLDcxLjY2NjY3IDc4LjgzMzMzLDcxLjY2NjY3djI4LjY2NjY3YzAsMCA3OC44MzMzMywtMzguNDA4ODUgNzguODMzMzMsLTEwMC4zMzMzM2MwLC0zOS41ODQ2MyAtMzUuMzAxNDMsLTcxLjY2NjY3IC03OC44MzMzMywtNzEuNjY2Njd6TTk0Ljc2MjM3LDEwOC4zOTU4M2gtMTcuNTI0NzR2LTQ5LjkxNDcyaDE3LjUyNDc0ek04Ni4wMjc5OSw0NC40Mjc3NGMtOS40OTAyMywwIC05LjU0NjIyLC02Ljk5ODcgLTkuNTQ2MjIsLTguNjIyNGMwLC0xLjY1MTY5IDAsLTguNTY2NDEgOS41NDYyMiwtOC41NjY0MWM5LjU3NDIyLDAgOS41NDYyMyw2LjkxNDcyIDkuNTQ2MjMsOC41NjY0MWMwLDEuNjIzNjkgLTAuMDU1OTksOC42MjI0IC05LjU0NjIzLDguNjIyNHoiPjwvcGF0aD48L2c+PC9nPjwvc3ZnPg==" align="left" width="48" height="48" class="list-photo">
                    <button id="follow">Follow</button>
                    <b>Netflix</b><br>
                    <span class="gray-lists">Films</span>
                </div>
            </div>
        </div>


    <div id="right">
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
                    echo "<a href=\"explore.php?del_following=$item_id\">";
                    echo "<button id=\"unfollow-button\">Following</button></a>";
                }
                else {
                    echo "<a href=\"explore.php?del_follow=$item_id\">";
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