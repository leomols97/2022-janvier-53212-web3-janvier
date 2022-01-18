<?php
namespace App\Models;
use \Illuminate\Support\Facades\DB;
use PDO;
class Discussion {
    public static function getDiscussion( $id ) {
        $pdo = DB::getPdo();
        $discussion = $pdo->query( "SELECT Thread.id, Thread.title, Message.text, Message.author, Message.date
                                    FROM Thread
                                    JOIN Message ON Thread.id = Message.threadId WHERE Thread.id = $id" )
        ->fetchAll();
        return $discussion;
    }

    public static function getMessage( $id ) {
        $pdo = DB::getPdo();
        $discussions = $pdo->query( "SELECT text FROM Message WHERE id = '$id'" )
        ->fetchAll();
        return $discussions;
    }

    public static function getAllDiscussions() {
        $pdo = DB::getPdo();
        $discussions = $pdo->query( "SELECT Thread.id, Thread.title, Message.text, Message.author, Message.date
                                    FROM Thread
                                    JOIN Message ON Thread.id = Message.threadId" )
        ->fetchAll();

        return $discussions;
    }

    public static function getAllDiscussionsTitle() {
        $pdo = DB::getPdo();
        $discussions = $pdo->query( "SELECT Thread.id, Thread.title
                                    FROM Thread" )
        ->fetchAll();

        return $discussions;
    }
}

?>

