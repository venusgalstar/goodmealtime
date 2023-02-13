<?php

    if ( !isset($_GET['meals']) && !isset($_GET['events']) && !isset($_GET['eventbooking'])){
        exit(0);
    }

    // $servername = "localhost";
    // $username = "dev_Alek";
    // $password = "_6X;$7,Cl!}G";
    // $dbname = "i7452067_wp3";

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
	
	function utf8ize($d) {
	    if (is_array($d)) {
	        foreach ($d as $k => $v) {
	            $d[$k] = utf8ize($v);
	        }
	    } else if (is_string ($d)) {
	        return utf8_encode($d);
	    }
	    return $d;
	}

    function getMeals(){
        global $conn;
        
        $meal_id = $_GET['meals'];

        if($meal_id == -1){

            $sql = "select t18.event_start_date, t17.* from
            (select * from wp_em_events where event_start_date >= CURRENT_DATE ) as t18
            left join
            (select t15.*, t16.lat from
            (select t13.*, t14.lng from 
            (select t11.*, t12.location from
            (select t9.*, t10.restaurant from
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
            (select user_id, meta_value as restaurant
            from wp_usermeta
            where meta_key = 'wcfmmp_store_name') as t10
            on t9.post_author = t10.user_id
            ORDER BY restaurant DESC, ID DESC) as t11        
            left join
            (select user_id, meta_value as location
            from wp_usermeta
            where meta_key = '_wcfm_city') as t12
            on t11.post_author = t12.user_id) as t13
            left join
            (select user_id, meta_value as lng
            from wp_usermeta
            where meta_key = '_wcfm_store_lng') as t14
            on t13.post_author = t14.user_id) as t15
            left join
            (select user_id, meta_value as lat
            from wp_usermeta
            where meta_key = '_wcfm_store_lat') as t16
            on t15.post_author = t16.user_id
            where !ISNULL(restaurant)
            ORDER BY restaurant) as t17
            on t17.post_author = t18.event_owner
            where !ISNULL(ID)
            ";

            $result = $conn->query($sql);

            $response_data = array();

            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc() ) {
                    // echo json_encode($row);

                    $new_item["id"] = $row["ID"];
                    $new_item["event_start_date"] = $row["event_start_date"];
                    $new_item["price"] = $row["price"];
                    $new_item["image"] = $row["image"]!=''?$row["image"]:$row["image1"];
                    $new_item["location"] = $row["location"]!=''?$row["location"]:'admin';
                    $new_item["restaurant"] = $row["restaurant"]!=''?$row["restaurant"]:'admin';
                    $new_item["available"] = 1;
                    $new_item["lng"] = $row["lng"];
                    $new_item["lat"] = $row["lat"];
                    $new_item["author"] = $row["post_author"];
                    array_push($response_data, $new_item);
                }
            } 
			
            echo json_encode(utf8ize($response_data));

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

            echo json_encode(utf8ize($new_item));
        }
    }

    function getEvents(){

        global $conn;
        $event_id = $_GET["events"];

        if( $event_id == -1 ){
            // $sql = "select t1.*, t2.* from 
            // (select ticket_id as id, event_id, ticket_description as description, ticket_price as fee, ticket_members as attendees from wp_em_tickets) as t1
            // left join
            // (select event_id as eid,post_id,event_owner, event_status, event_name as name, event_start_date as date, event_start_time as time ,event_all_day, post_content,location_id  from wp_em_events) as t2
            // on t1.event_id = t2.eid
            // order by t1.id desc
            // ";

            $sql = "select t5.*, t6.location_latitude, t6.location_longitude from
            (select t3.*, t4.display_name as name from 
            (select t1.*,t2.* from
            (select event_id as id, event_name as title, post_id, post_content, event_owner, event_status, event_start_date, event_end_date, event_start_time as time from wp_em_events) as t1
            left join
            (select event_id, count(booking_id) as peopleAttending, sum(booking_spaces) as ticket from wp_em_bookings group by event_id) as t2
            on t1.id = t2.event_id) as t3
            left join
            wp_users t4
            on t3.event_owner = t4.ID) as t5
            left join 
            wp_em_locations as t6
            on t5.post_id = t6.post_id";

            if( isset($_GET['author']) ){
                if( $_GET['author'] != -1 )
                $sql .= " where t5.event_owner = ".$_GET['author'];
            }

            $result = $conn->query($sql);

            $response_data = array();

            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc() ) {
                    $new_item["id"] = $row["id"];
                    $new_item["title"] = $row["title"];
                    $new_item["liveNow"] = $row["event_status"]==1?true:false;
                    $new_item["peopleAttending"] = $row["peopleAttending"]!=''?$row["peopleAttending"]:0;
                    $new_item["ticket"] = $row["ticket"]!=''?$row["ticket"]:0;
                    $new_item["event_start_date"] = $row["event_start_date"];
                    $new_item["event_end_date"] = $row["event_end_date"];
                    $new_item["event_owner"] = $row["event_owner"];
                    $new_item["time"] = $row["time"];
                    $new_item["name"] = $row["name"];
                    $new_item["description"] = strip_tags(preg_replace('#(\[(.*)\](.*)\[/.*\])#Us','',$row["post_content"]));
                    $new_item["description"] = str_replace("&nbsp;",' ',$new_item["description"]);
                    $new_item["description"] = str_replace("\r\n",' ',$new_item["description"]);
                    $new_item["location_latitude"] = $row["location_latitude"];
                    $new_item["location_longitude"] = $row["location_longitude"];

                    //adding picture
                    preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $row["post_content"], $match);
                    
                    foreach($match[0] as $url){
                        if( strpos($url, "upload") )
                        {
                            $new_item["images"] = $url;
                            break;
                        }    
                    }                   
                    
                    array_push($response_data, $new_item);
                }
            }
            echo json_encode(utf8ize($response_data));
        }else{

            $sql = "select t5.*, t6.liveStreamUrl from
            (select t3.*, t4.display_name as eventManager from 
            (select t1.*,t2.* from
            (select event_id as id, event_name as name, post_id, post_content, event_owner, event_status, event_start_date as date, event_start_time as time from wp_em_events where event_id = ".$event_id.") as t1
            left join
            (select event_id, count(booking_id) as peopleAttending, sum(booking_spaces) as ticket from wp_em_bookings group by event_id) as t2
            on t1.id = t2.event_id) as t3
            left join
            wp_users t4
            on t3.event_owner = t4.ID) as t5
            left join
            (select post_id, meta_value as liveStreamUrl from wp_postmeta where meta_key = '_event_location_url') as t6
            on t5.post_id = t6.post_id
            ";

            $result = $conn->query($sql);

            $new_item = array();

            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc() ) {
                    $new_item["id"] = $row["id"];
                    $new_item["liveNow"] = $row["event_status"]==1?true:false;
                    $new_item["peopleAttending"] = $row["peopleAttending"]!=''?$row["peopleAttending"]:0;
                    $new_item["ticket"] = $row["ticket"]!=''?$row["ticket"]:0;
                    $new_item["date"] = $row["date"];
                    $new_item["time"] = $row["time"];
                    $new_item["name"] = $row["name"];
                    $new_item["eventManager"] = $row["eventManager"];
                    $new_item["host"] = $row["eventManager"];
                    
                    $new_item["liveStreamUrl"] = $row["liveStreamUrl"];
                    $new_item["googleCalendarUrl"] = "";//$row["googleCalendarUrl"];
                    // $new_item["gate"] = 6;
                    // $new_item["seating"] = "free";
                    // $new_item["accessRestrictions"] = "Staff, VIPs, Executive Members, All Executives of DDCMS";

                    $new_item["gate"] = "";
                    $new_item["seating"] = "";
                    $new_item["accessRestrictions"] = "";
                    
                    $new_item["presenters"] = array();
                    $presenter1["name"] = $row["eventManager"];
                    $presenter1["starPresenter"] = true;
                    $presenter1["createdBy"] = "Dept for Digital Culture, Media & Sport";
                    array_push($new_item["presenters"], $presenter1);

                    $new_item["description"] = strip_tags(preg_replace('#(\[(.*)\](.*)\[/.*\])#Us','',$row["post_content"]));
                    $new_item["description"] = str_replace("&nbsp;",' ',$new_item["description"]);
                    $new_item["description"] = str_replace("\r\n",' ',$new_item["description"]);

                    //adding picture
                    preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $row["post_content"], $match);
                    
                    $new_item["images"] = array();

                    foreach($match[0] as $url){
                        if( strpos($url, "upload") )
                            array_push($new_item["images"], $url);
                    }                   
                    
                }
            }
            echo json_encode(utf8ize($new_item));

        }
    }

    function getBooking(){
        global $conn;
        $event_id = $_GET["eventbooking"];

        if( $event_id != -1 ){
            $sql = "select t1.*, t2.* from 
            (select ticket_id as id, event_id, ticket_description as description, ticket_price as fee, ticket_members as attendees from wp_em_tickets) as t1
            right join
            (select event_id as eid,post_id,event_owner, event_status, event_name as name, event_start_date as date, event_start_time as time ,event_all_day, post_content,location_id  from wp_em_events where event_id = ".$event_id.") as t2
            on t1.event_id = t2.eid
            ";

            $result = $conn->query($sql);

            $new_item = array();

            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc() ) {
                    $new_item["id"] = $row["id"];
                    $new_item["attendees"] = $row["attendees"]!=''?$row["attendees"]:0;
                    $new_item["date"] = $row["date"];
                    $new_item["time"] = $row["time"];
                    $new_item["name"] = $row["name"];

                    $new_item["description"] = strip_tags(preg_replace('#(\[(.*)\](.*)\[/.*\])#Us','',$row["post_content"]));
                    $new_item["description"] = str_replace("&nbsp;",' ',$new_item["description"]);
                    $new_item["description"] = str_replace("\r\n",' ',$new_item["description"]);

                    //adding picture
                    preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $row["post_content"], $match);
                    
                    $new_item["images"] = array();

                    foreach($match[0] as $url){
                        if( strpos($url, "upload") )
                            array_push($new_item["images"], $url);
                    }                   
                    
                }
            }
            echo json_encode(utf8ize($new_item));
        }
    }

    if (isset($_GET['meals'])){
        getMeals();
    }
    else if( isset($_GET['events'])){
        getEvents();
    }
    else if( isset($_GET['eventbooking'])){
        getBooking();
    }

    $conn->close();

?>