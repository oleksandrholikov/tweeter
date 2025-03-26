<?php

class CreatePostModel {
    private $db;

    public function __construct($dbh){
        $this->db = $dbh;
    }

    public function createPost($post){
        echo"inModel\n";
        print_r($post);
        $int = intval($post['id_user']);
        $sql = "INSERT INTO tweet (id_user, content, media1, media2, media3, media4) VALUES (:id_user, :content, :media1, :media2, :media3, :media4)";
        $stmt = $this->db->prepare($sql);
        // $stmt->bindParam(':id_user', $post['id_user']);
        // $stmt->bindParam(':content', $post['content']);
        // for($i = 1; $i<=4; $i++){
        //     $media = isset($post['media'][$i])? $post['media'][$i]: "NULL";
        //     $stmt->bindParam(":" . "media" . $i, $media);
        // }
        $stmt->execute([
          'id_user' => $post['id_user'],
          'content' => $post['content'],
          'media1' => isset($post['media'][1])? $post['media'][1]:NULL,
          'media2' => isset($post['media'][2])? $post['media'][2]:NULL,
          'media3' => isset($post['media'][3])? $post['media'][3]:NULL,
          'media4' => isset($post['media'][4])? $post['media'][4]:NULL
        ]);
        if($stmt){
            echo"Post create\n";
        }else{
            echo"ERROR\n";
        }

    }
}