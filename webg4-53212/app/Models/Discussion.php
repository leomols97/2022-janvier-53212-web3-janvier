<?php
namespace App\Models;
use \Illuminate\Support\Facades\DB;
use PDO;

class Discussion {
    public static function getDiscussion( $id ) {
        $pdo = DB::getPdo();
        $discussion = $pdo->query( "SELECT Thread.id, Thread.title, Message.text
                                    FROM Thread
                                    JOIN Message ON Thread.id = Message.threadId WHERE Thread.id = $id" )
        ->fetch();
        $commits = ( Discussion::getDiscussion( $id ) );
        array_push( $discussion, $commits );
        $discussion[ 'commits' ] = $discussion[ 2 ];
        unset( $discussion[ 2 ] );
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
        $repositories = $pdo->query( "SELECT Thread.id, Thread.title, Message.text
                                    FROM Thread
                                    JOIN Message ON Thread.id = Message.threadId" )
        ->fetchAll();

        return $repositories;
    }

    public static function getAllDiscussionsTitle() {
        $pdo = DB::getPdo();
        $repositories = $pdo->query( "SELECT Thread.id, Thread.title
                                    FROM Thread" )
        ->fetchAll();

        return $repositories;
    }
}

?>

