<?php
namespace App\Http\Controllers;
use App\Models\Discussion;
use Symfony\Component\VarDumper\VarDumper;

class DiscussionCtrl extends Controller {
    public function index() {

        $discussions = Discussion::getAllDiscussionsTitle();
        return view( 'index', [ 'discussions' => $discussions ] );
    }

    public function discussions() {

        $discussions = Discussion::getAllDiscussions();
        return view( 'discussion', [ 'discussions' => $discussions ] );

    }

    public function discussion( $fil_id ) {

        $fil = Discussion::getDiscussion( $fil_id );
        return view( 'discussion', [ 'fil' => $fil, 'fil_id' => $fil_id ] );

    }
}
