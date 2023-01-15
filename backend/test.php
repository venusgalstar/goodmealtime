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

        echo json_encode($response_data);

    } else{
        $sql = "select t1.*, t2.* from
        (select ID, post_author from wp_posts where ID = 4191) as t1
        left join
        wp_postmeta as t2
        on t1.ID = t2.post_id
        ";

        $response_data = array();
        $result_posts = $conn->query($sql);

        if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc() ) {
              // echo json_encode($row);

              $new_item["id"] = $row["ID"];
              $new_item["post_author"] = $row["post_author"];
              
              if($row["meta_key"] == "_price")
                $new_item["price"] = $row["meta_value"];
              
              if($row["meta_key"] == "_price")
                $new_item["price"] = $row["meta_value"];
          }        
        }  

    }
    
    
}



$conn->close();




?>