<?php

    if (!isset($_GET['meals']) && !isset($_GET['events'])){
        exit(0);
    }

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "i7452067_wp3";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_GET['meals'])){
        $meal_id = $_GET['meals'];

        if($meal_id == -1){
            $sql = "select t9.*, t10.location from
            (select t7.*, t8.guid as image1 from
            (select t3.*, t4.guid as image from
            (select t1.ID, t1.name, t1.post_author, t2.price from
            (select ID, post_author, post_title as name
            from wp_posts
            where post_type='product' AND post_title != '') as t1
            left join 
            (select post_id, meta_value as price
            from wp_postmeta
            where meta_key='_regular_price') as t2
            on t1.ID = t2.post_id) as t3
            left join
            (select post_parent, guid
            from wp_posts
            where post_parent != 0 && post_type = 'attachment' ) as t4
            on t3.ID = t4.post_parent) as t7
            left join
            (select t6.*, t5.guid
            from 
            (select post_id, meta_value as parent_posts
            from wp_postmeta
            where meta_key='_wxr_import_parent') as t6
            left join
            wp_posts as t5
            on t5.ID = t6.post_id) as t8
            on t7.ID = t8.parent_posts
            group by t7.ID) as t9
            left join
            (select user_id, meta_value as location
            from wp_usermeta
            where meta_key = 'wcfmmp_store_name') as t10
            on t9.post_author = t10.user_id
            ORDER BY ID DESC        
            ";

            $result = $conn->query($sql);

            $response_data["category"] = array();

            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc() ) {
                    // echo json_encode($row);

                    $new_item["id"] = $row["ID"];
                    $new_item["price"] = $row["price"];
                    $new_item["image"] = $row["image"]!=''?$row["image"]:$row["image1"];
                    $new_item["location"] = $row["location"]!=''?$row["location"]:'admin';
                    array_push($response_data["category"], $new_item);
                }
            } 

            $response_final = array($response_data);

            echo json_encode($response_final);

        } else{
            $sql = "select t3.*, t4.guid as image from
            (select t1.*, t2.* from
            (select ID, post_author,post_title as name from wp_posts where ID = ".$meal_id.") as t1
            left join
            wp_postmeta as t2
            on t1.ID = t2.post_id) as t3
            left join
            (select guid,post_parent from wp_posts where post_type = 'attachment') as t4
            on t3.ID = t4.post_parent     
            ";

            $response_data = array();
            $new_item = array();
            $result_posts = $conn->query($sql);

            $new_item["uploadedBy"] = "";
            $new_item["location"] = "";
            $new_item["ingredients"] = "";
            $new_item["possibleAllergen"] = "";

            if ($result_posts->num_rows > 0) {
                // output data of each row
                while($row = $result_posts->fetch_assoc() ) {
                    // echo json_encode($row)."<br>";

                    $new_item["id"] = $row["ID"];
                    $new_item["mealNo"] = $row["ID"];
                    $new_item["post_author"] = $row["post_author"];
                    $new_item["name"] = $row["name"];
                    $new_item["available"] = true;
                    $new_item["image"] = $row["image"];
                    
                    if($row["meta_key"] == "_price")
                        $new_item["price"] = $row["meta_value"];
                    
                    if($row["meta_key"] == "_regular_price")
                        $new_item["discount"] = $row["meta_value"];

                    if($row["meta_key"] == "_price")
                        $new_item["price"] = $row["meta_value"];
                }        
            }  

            $sql = "select t1.*, t2.* from
            (select * from wp_users where ID = ". $new_item["post_author"].") as t1
            left join 
            wp_usermeta as t2
            on t1.ID = t2.user_id
            ";

            $result_user = $conn->query($sql);

            if ($result_user->num_rows > 0) {
                // output data of each row
                while($row = $result_user->fetch_assoc() ) {
                    // echo json_encode($row)."<br>";
                    if($row["meta_key"] == "nickname")
                        $new_item["uploadedBy"] = $row["meta_value"];
                    
                    if($row["meta_key"] == "store_name")
                        $new_item["location"] = $row["meta_value"];
                }        
            } 

            if( $new_item["image"] == '' ){
                $sql = "select t1.*,t2.guid as image from
                (select * from wp_postmeta where meta_key='_wxr_import_parent' and meta_value=".$meal_id.") as t1
                left join
                wp_posts as t2
                on t1.post_id = t2.ID                
                ";

                $result_user = $conn->query($sql);

                if ($result_user->num_rows > 0) {
                    // output data of each row
                    while($row = $result_user->fetch_assoc() ) {
                        // echo json_encode($row)."<br>";
                        if($row["image"] != '')
                            $new_item["image"] = $row["image"];
                    }        
                } 

            }

            echo json_encode($new_item);
        }
        
        
    }

    $conn->close();

?>